<?php
include 'db.php'; // expects $conn as mysqli connection

// Ensure upload directory exists
$uploadDir = 'CTEVT/Photo/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// ---- Handle form actions: add / edit / delete ----
$action = $_POST['action'] ?? null;
$parentName = 'CTEVT';

// Utility: get parent_id for CTEVT
function get_parent_id($conn, $parentName) {
    $pstmt = $conn->prepare("SELECT id FROM boards WHERE name = ?");
    $pstmt->bind_param("s", $parentName);
    $pstmt->execute();
    $pres = $pstmt->get_result();
    $parent_id = 0;
    if ($prow = $pres->fetch_assoc()) {
        $parent_id = intval($prow['id']);
    }
    $pstmt->close();
    return $parent_id;
}

$parent_id = get_parent_id($conn, $parentName);

if ($action === 'add' || $action === 'edit') {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $link = trim($_POST['link'] ?? '');
    $background_color = trim($_POST['background_color'] ?? '');
    $image_path = ''; // final path

    // Image upload
    if (!empty($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
        $tmpName = $_FILES['image_file']['tmp_name'];
        $origName = basename($_FILES['image_file']['name']);
        $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg'];

        if (in_array($ext, $allowed)) {
            $newName = time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
            $target = $uploadDir . $newName;
            if (move_uploaded_file($tmpName, $target)) {
                $image_path = $target;
            }
        }
    }

    if ($action === 'add') {
        // Use uploaded image if any; else empty
        $stmt = $conn->prepare("INSERT INTO boards (name, description, image, link, background_color, parent_id, level) VALUES (?, ?, ?, ?, ?, ?, 'faculty')");
        $stmt->bind_param("sssssi", $name, $description, $image_path, $link, $background_color, $parent_id);
        $stmt->execute();
        $stmt->close();
    } elseif ($action === 'edit') {
        $id = intval($_POST['id']);
        // If no new upload, preserve existing
        if (empty($image_path)) {
            $q = $conn->prepare("SELECT image FROM boards WHERE id = ? AND parent_id = ?");
            $q->bind_param("ii", $id, $parent_id);
            $q->execute();
            $res = $q->get_result();
            if ($r = $res->fetch_assoc()) {
                $image_path = $r['image'];
            }
            $q->close();
        }
        $stmt = $conn->prepare("UPDATE boards SET name = ?, description = ?, image = ?, link = ?, background_color = ? WHERE id = ? AND parent_id = ?");
        $stmt->bind_param("ssssiii", $name, $description, $image_path, $link, $background_color, $id, $parent_id);
        $stmt->execute();
        $stmt->close();
    }
} elseif ($action === 'delete') {
    $id = intval($_POST['id']);
    // Only delete if child of CTEVT
    $del = $conn->prepare("DELETE b FROM boards b JOIN boards p ON b.parent_id = p.id WHERE b.id = ? AND p.name = ?");
    $del->bind_param("is", $id, $parentName);
    $del->execute();
    $del->close();
}

// ---- Fetch current faculties ----
$faculties = [];
if ($parent_id) {
    $stmt = $conn->prepare("SELECT id, name, description, image, link, background_color FROM boards WHERE parent_id = ?");
    $stmt->bind_param("i", $parent_id);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($r = $res->fetch_assoc()) {
        $faculties[] = $r;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CTEVT Faculties Management</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    :root {
      --radius:12px;
      --shadow:0 16px 50px rgba(0,0,0,0.08);
      --gap:16px;
    }
    *{box-sizing:border-box;}
    body{margin:0;font-family:system-ui,-apple-system,BlinkMacSystemFont,sans-serif;background:#f4f8fc;color:#1f2d3d;}
    .faculty-section{padding:28px 16px;background:#fff;text-align:center;}
    .faculty-section h2{margin:0;font-size:2rem;letter-spacing:0.5px;}
    .container{max-width:1100px;margin:30px auto;padding:0 12px;}
    .grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:var(--gap);}
    .faculty-card{
      position:relative;
      padding:16px 14px 18px;
      border-radius:16px;
      display:flex;
      flex-direction:column;
      gap:8px;
      background:#fff;
      box-shadow: var(--shadow);
      transition:transform .15s;
      overflow:hidden;
    }
    .faculty-card img{width:60px;height:60px;border-radius:50%;object-fit:cover;background:#e8edf3;}
    .faculty-card a.title{font-weight:700;font-size:1.1rem;text-decoration:none;color:#0f4dbb;margin:0;}
    .faculty-card p{margin:4px 0;font-size:0.9rem;flex:1;}
    .card-footer{display:flex;justify-content:space-between;align-items:center;margin-top:8px;gap:6px;flex-wrap:wrap;}
    .small-link{font-size:12px;text-decoration:none;color:#2563eb;}
    .actions{display:flex;gap:6px;margin-top:6px;}
    .btn{padding:8px 12px;border:none;cursor:pointer;border-radius:8px;font-size:12px;font-weight:600;display:inline-flex;align-items:center;gap:4px;}
    .btn-edit{background:#facc15;color:#1f2937;}
    .btn-delete{background:#ef4444;color:#fff;}
    .floating{position:fixed;bottom:30px;right:30px;background:linear-gradient(135deg,#6366f1,#a78bfa);color:#fff;border:none;padding:16px 22px;border-radius:999px;font-size:16px;cursor:pointer;box-shadow:0 25px 50px -12px rgba(99,102,241,0.6);display:flex;align-items:center;gap:8px;z-index:60;}
    .footer-text{margin:50px 0 30px;text-align:center;font-style:italic;color:#555;}
    .no-data{padding:40px;background:#fff;border-radius:12px;box-shadow:var(--shadow);text-align:center;}
    /* Modal */
    .overlay{position:fixed;inset:0;background:rgba(0,0,0,0.4);display:none;align-items:center;justify-content:center;padding:12px;z-index:100;}
    .modal{background:#fff;border-radius:14px;max-width:500px;width:100%;padding:22px;position:relative;box-shadow:0 40px 80px rgba(0,0,0,0.15);}
    .modal h2{margin-top:0;font-size:1.4rem;}
    .field{margin-bottom:14px;}
    .field label{display:block;font-size:12px;margin-bottom:4px;font-weight:600;}
    .field input{width:100%;padding:10px 14px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;}
    .modal-footer{display:flex;justify-content:flex-end;gap:10px;margin-top:12px;}
    .btn-primary{background:#10b981;color:#fff;padding:10px 16px;border:none;border-radius:8px;cursor:pointer;font-weight:600;}
    .btn-secondary{background:#6b7280;color:#fff;padding:10px 16px;border:none;border-radius:8px;cursor:pointer;font-weight:600;}
    .close-btn{position:absolute;top:12px;right:12px;background:none;border:none;font-size:22px;cursor:pointer;line-height:1;}
    .preview-img{max-width:80px;display:block;margin-top:6px;border-radius:6px;border:1px solid #d1d5db;}
  </style>
</head>
<body>

  <section class="faculty-section">
    <div class="container">
      <h2>OUR FACULTY</h2>
    </div>
  </section>

  <div class="container">
    <?php if (!$parent_id): ?>
      <div class="no-data"><p>CTEVT parent category not found.</p></div>
    <?php else: ?>
      <?php if (count($faculties) === 0): ?>
        <div class="no-data"><p>No faculty found under CTEVT.</p></div>
      <?php else: ?>
        <div class="grid" id="cardsWrapper">
          <?php foreach ($faculties as $row): ?>
            <div class="faculty-card" style="background: <?= htmlspecialchars($row['background_color']) ?>;">
              <div style="display:flex;gap:12px;align-items:center;">
                <img src="<?= htmlspecialchars($row['image'] ?: 'placeholder.png') ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                <div style="flex:1;">
                  <a href="<?= htmlspecialchars($row['link']) ?>" class="title" target="_blank"><?= strtoupper(htmlspecialchars($row['name'])) ?></a>
                  <p style="margin:4px 0 0;font-size:12px;"><?= htmlspecialchars($row['description']) ?></p>
                </div>
              </div>
              <div class="card-footer">
                <div class="small-link"><a href="<?= htmlspecialchars($row['link']) ?>" target="_blank" style="text-decoration:none;color:inherit;">Visit</a></div>
                <div class="actions">
                  <button class="btn btn-edit" onclick='openForm(<?= json_encode($row, JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT) ?>)'>Edit</button>
                  <form method="post" style="display:inline;" onsubmit="return confirm('Delete this faculty?');">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?= intval($row['id']) ?>">
                    <button type="submit" class="btn btn-delete">Delete</button>
                  </form>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    <?php endif; ?>

    <p class="footer-text">To the great minds of engineering – the ones who shape the future with vision, precision, and innovation.</p>
  </div>

  <!-- Single floating action button -->
  <button class="floating" onclick="openForm()">+ Manage Faculties</button>

  <!-- Modal Add/Edit -->
  <div class="overlay" id="overlay">
    <div class="modal" aria-label="Faculty form">
      <button class="close-btn" onclick="closeForm()">×</button>
      <h2 id="modalTitle">Add Faculty</h2>
      <form method="post" id="facultyForm" enctype="multipart/form-data">
        <input type="hidden" name="action" id="formAction" value="add">
        <input type="hidden" name="id" id="facultyId" value="">

        <div class="field">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" required placeholder="Faculty name">
        </div>
        <div class="field">
          <label for="description">Description</label>
          <input type="text" name="description" id="description" required placeholder="Short description">
        </div>
        <div class="field">
          <label for="link">Link (URL)</label>
          <input type="url" name="link" id="link" required placeholder="https://example.com">
        </div>
        <div class="field">
          <label for="image_file">Upload Image</label>
          <input type="file" name="image_file" id="image_file" accept="image/*">
          <div id="currentImageWrapper" style="margin-top:6px; display:none;">
            <small>Current:</small>
            <img id="currentImage" src="" class="preview-img" alt="current image">
          </div>
        </div>
        <div class="field">
          <label for="background_color">Background Color</label>
          <input type="text" name="background_color" id="background_color" placeholder="#f0f0f0 or rgba(...)">
        </div>

        <div class="modal-footer">
          <button type="button" class="btn-secondary" onclick="closeForm()">Cancel</button>
          <button type="submit" class="btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>

<script>
function openForm(row = null) {
  document.getElementById('overlay').style.display = 'flex';
  if (row) {
    document.getElementById('modalTitle').innerText = 'Edit Faculty';
    document.getElementById('formAction').value = 'edit';
    document.getElementById('facultyId').value = row.id;
    document.getElementById('name').value = row.name;
    document.getElementById('description').value = row.description;
    document.getElementById('link').value = row.link;
    document.getElementById('background_color').value = row.background_color;
    // current image preview
    if (row.image) {
      document.getElementById('currentImageWrapper').style.display = 'block';
      document.getElementById('currentImage').src = row.image;
    } else {
      document.getElementById('currentImageWrapper').style.display = 'none';
    }
  } else {
    document.getElementById('modalTitle').innerText = 'Add Faculty';
    document.getElementById('formAction').value = 'add';
    document.getElementById('facultyId').value = '';
    document.getElementById('name').value = '';
    document.getElementById('description').value = '';
    document.getElementById('link').value = '';
    document.getElementById('background_color').value = '';
    document.getElementById('currentImageWrapper').style.display = 'none';
  }
}

function closeForm() {
  document.getElementById('overlay').style.display = 'none';
}
</script>

</body>
</html>

<?php
// cleanup
$conn->close();
?>
