<?php
include 'db.php'; // assumes $conn is a mysqli connection

// Handle actions: add / edit / delete
$action = $_POST['action'] ?? null;

if ($action === 'add' || $action === 'edit') {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $image = $_POST['image'] ?? '';
    $link = $_POST['link'] ?? '';
    $background_color = $_POST['background_color'] ?? '';
    $level = 'faculty';

    if ($action === 'add') {
        $stmt = $conn->prepare("INSERT INTO boards (name, description, image, link, background_color, level) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $description, $image, $link, $background_color, $level);
        $stmt->execute();
        $stmt->close();
    } else { // edit
        $id = intval($_POST['id']);
        $stmt = $conn->prepare("UPDATE boards SET name = ?, description = ?, image = ?, link = ?, background_color = ? WHERE id = ? AND level = 'faculty'");
        $stmt->bind_param("sssssi", $name, $description, $image, $link, $background_color, $id);
        $stmt->execute();
        $stmt->close();
    }
} elseif ($action === 'delete') {
    $id = intval($_POST['id']);
    $stmt = $conn->prepare("DELETE FROM boards WHERE id = ? AND level = 'faculty'");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Fetch current faculty entries
$sql = "SELECT id, name, description, image, link, background_color FROM boards WHERE level = 'faculty' ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Faculty Cards</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    :root {
      --radius: 12px;
      --shadow: 0 12px 40px rgba(0,0,0,0.08);
      --gap: 16px;
    }
    *{box-sizing:border-box;}
    body {margin:0; font-family: system-ui,-apple-system,BlinkMacSystemFont,sans-serif; background:#f2f7fc; color:#1f2d3d;}
    .container {max-width:1100px; margin:60px auto 100px; padding:0 16px;}
    .header {display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;}
    .title {font-size:1.8rem; font-weight:700; margin:0;}
    .grid {display:grid; grid-template-columns:repeat(auto-fill,minmax(220px,1fr)); gap:var(--gap);}
    .course-card {
      position:relative;
      padding:18px 14px 14px;
      border-radius:16px;
      color:#1f2d3d;
      display:flex;
      flex-direction:column;
      gap:6px;
      min-height:220px;
      overflow:hidden;
      box-shadow: var(--shadow);
      transition:transform .15s;
      text-decoration:none;
    }
    .course-card:hover {transform:translateY(-3px);}
    .corner-label {
      position:absolute;
      top:12px;
      left:12px;
      background:rgba(255,255,255,0.8);
      padding:4px 10px;
      border-radius:8px;
      font-size:12px;
      font-weight:600;
      backdrop-filter:blur(6px);
    }
    .corner-labelll {
      position:absolute;
      top:12px;
      right:12px;
    }
    .course-card h3 {margin:40px 0 6px; font-size:1rem; line-height:1.2;}
    .card-title {font-weight:700; margin:0; font-size:1.1rem;}
    .small-link {margin-top:auto; font-size:13px; text-decoration:none; color:#0f62fe;}
    .actions {display:flex; gap:6px; margin-top:8px; flex-wrap:wrap;}
    .btn {padding:8px 12px; border:none; border-radius:8px; cursor:pointer; font-size:12px; font-weight:600;}
    .btn-edit {background:#facc15; color:#1f2937;}
    .btn-delete {background:#ef4444; color:#fff;}
    .floating {position:fixed; bottom:30px; right:30px; background:linear-gradient(135deg,#6366f1,#a78bfa); color:#fff; border:none; padding:16px 24px; border-radius:999px; font-size:16px; cursor:pointer; box-shadow:0 25px 50px -12px rgba(99,102,241,0.6); display:flex; align-items:center; gap:8px; z-index:50;}
    .footer-text {margin-top:50px; text-align:center; font-style:italic; color:#555;}
    /* Modal */
    .overlay {position:fixed; inset:0; background:rgba(0,0,0,0.45); display:none; align-items:center; justify-content:center; padding:12px; z-index:100;}
    .modal {background:#fff; border-radius:16px; max-width:500px; width:100%; padding:24px; position:relative; box-shadow:0 40px 80px rgba(0,0,0,0.15);}
    .modal h2 {margin-top:0; font-size:1.4rem;}
    .field {margin-bottom:14px;}
    .field label {display:block; font-size:13px; margin-bottom:4px; font-weight:600;}
    .field input {width:100%; padding:10px 14px; border:1px solid #d1d5db; border-radius:8px; font-size:14px;}
    .modal-footer {display:flex; justify-content:flex-end; gap:10px; margin-top:12px;}
    .btn-primary {background:#10b981; color:#fff; padding:10px 16px; border:none; border-radius:8px; cursor:pointer; font-weight:600;}
    .btn-secondary {background:#6b7280; color:#fff; padding:10px 16px; border:none; border-radius:8px; cursor:pointer; font-weight:600;}
    .close-btn {position:absolute; top:12px; right:12px; background:none; border:none; font-size:22px; cursor:pointer; line-height:1;}
    .card-wrapper {position:relative; display:flex; flex-direction:column; height:100%;}
  </style>
</head>
<body>

  <div class="container">
    <div class="header">
      <div class="title">Diploma Engineering Faculty</div>
    </div>

    <div class="grid" id="cardsWrapper">
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <div class="course-card" style="background-color: <?= htmlspecialchars($row['background_color']) ?>;">
            <div class="corner-label"><?= htmlspecialchars($row['name']) ?></div>
            <div class="corner-labelll">
              <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>" width="32" height="32" style="border-radius:50%;">
            </div>
            <h3><?= htmlspecialchars($row['description']) ?></h3>
            <p class="card-title"><?= htmlspecialchars($row['name']) ?></p>
            <div class="actions">
              <button class="btn btn-edit" onclick='openForm(<?= json_encode($row, JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT) ?>)'>Edit</button>
              <form method="post" style="display:inline;" onsubmit="return confirm('Delete this faculty?');">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="<?= intval($row['id']) ?>">
                <button type="submit" class="btn btn-delete">Delete</button>
              </form>
            </div>
            <a href="<?= htmlspecialchars($row['link']) ?>" target="_blank" class="small-link">Visit Link</a>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p>No faculty data found.</p>
      <?php endif; ?>
    </div>

    <p class="footer-text">To the great minds of engineering – the ones who shape the future with vision, precision, and innovation.</p>
  </div>

  <!-- single floating button -->
  <button class="floating" onclick="openForm()">+ Manage Faculty</button>

  <!-- Modal add/edit -->
  <div class="overlay" id="overlay">
    <div class="modal" aria-label="Faculty form">
      <button class="close-btn" onclick="closeForm()">×</button>
      <h2 id="modalTitle">Add Faculty</h2>
      <form method="post" id="facultyForm">
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
          <label for="image">Image URL</label>
          <input type="url" name="image" id="image" placeholder="https://.../icon.png">
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
    document.getElementById('image').value = row.image;
    document.getElementById('background_color').value = row.background_color;
  } else {
    document.getElementById('modalTitle').innerText = 'Add Faculty';
    document.getElementById('formAction').value = 'add';
    document.getElementById('facultyId').value = '';
    document.getElementById('name').value = '';
    document.getElementById('description').value = '';
    document.getElementById('link').value = '';
    document.getElementById('image').value = '';
    document.getElementById('background_color').value = '';
  }
}

function closeForm() {
  document.getElementById('overlay').style.display = 'none';
}
</script>

</body>
</html>

<?php
$result->free();
$conn->close();
?>
