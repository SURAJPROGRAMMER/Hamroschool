<?php
include 'db.php';

// Fetch top-level boards (those with no parent)
$boards_stmt = $conn->prepare("SELECT id, name FROM boards WHERE parent_id IS NULL ORDER BY name");
$boards_stmt->execute();
$boards = $boards_stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Upload Study Material</title>
  <style>
    body {font-family: system-ui; padding:30px; background:#f0f4f8;}
    .box {max-width:700px; margin:auto; background:#fff; padding:24px; border-radius:10px; box-shadow:0 12px 30px rgba(0,0,0,0.08);}
    label {display:block; margin-top:12px; font-weight:600;}
    select, input[type=text], input[type=file] {width:100%; padding:10px; margin-top:6px; border:1px solid #ccc; border-radius:6px;}
    button {margin-top:16px; padding:12px 20px; background:#2563eb; color:#fff; border:none; border-radius:6px; cursor:pointer;}
    .small {font-size:12px; color:#555;}
  </style>
</head>
<body>
  <div class="box">
    <h2>Upload Study Material</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data" id="uploadForm">
      <label for="board">Board / Category</label>
      <select name="board_id" id="board" required>
        <option value="">-- Select Board --</option>
        <?php while ($b = $boards->fetch_assoc()): ?>
          <option value="<?= intval($b['id']) ?>"><?= htmlspecialchars($b['name']) ?></option>
        <?php endwhile; ?>
      </select>

      <div id="level-wrapper" style="display:none;">
        <label for="level">Subcategory / Faculty / Program</label>
        <select name="level_id" id="level" required>
          <option value="">-- Select --</option>
        </select>
      </div>

      <div id="sublevel-wrapper" style="display:none;">
        <label for="sublevel">Further (e.g., Year / Semester)</label>
        <select name="sub_level_id" id="sublevel">
          <option value="">-- Optional --</option>
        </select>
      </div>

      <label for="content_type">Content Type</label>
      <select name="content_type" id="content_type" required>
        <option value="Book">Book</option>
        <option value="Solutions">Solutions</option>
        <option value="Note">Note</option>
        <option value="Old Question">Old Question</option>
        <option value="Syllabus">Syllabus</option>
      </select>

      <label for="subject_name">Subject Name</label>
      <input type="text" name="subject_name" id="subject_name" required placeholder="e.g., Mathematics">

      <label for="file">Upload File</label>
      <input type="file" name="file" id="file" required>

      <button type="submit">Upload</button>
    </form>
    <p class="small">Hierarchy is stored by IDs; you can later list materials with their full path.</p>
  </div>

  <script>
    async function fetchLevels(parentId, targetSelect, placeholder) {
      targetSelect.innerHTML = `<option value="">-- ${placeholder} --</option>`;
      if (!parentId) return;
      const resp = await fetch(`fetch_levels.php?parent_id=${parentId}`);
      const data = await resp.json();
      data.forEach(r => {
        const opt = document.createElement('option');
        opt.value = r.id;
        opt.textContent = r.name;
        targetSelect.appendChild(opt);
      });
    }

    document.getElementById('board').addEventListener('change', async function() {
      const boardId = this.value;
      if (!boardId) {
        document.getElementById('level-wrapper').style.display = 'none';
        document.getElementById('sublevel-wrapper').style.display = 'none';
        return;
      }
      await fetchLevels(boardId, document.getElementById('level'), 'Select Subcategory');
      document.getElementById('level-wrapper').style.display = 'block';
      document.getElementById('sublevel-wrapper').style.display = 'none';
    });

    document.getElementById('level').addEventListener('change', async function() {
      const levelId = this.value;
      if (!levelId) {
        document.getElementById('sublevel-wrapper').style.display = 'none';
        return;
      }
      await fetchLevels(levelId, document.getElementById('sublevel'), 'Select Further');
      document.getElementById('sublevel-wrapper').style.display = 'block';
    });
  </script>
</body>
</html>

