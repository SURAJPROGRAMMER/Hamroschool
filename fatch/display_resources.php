<?php
include 'db.php';

function get_name($conn, $table, $id) {
    if (!$id) return '';
    $stmt = $conn->prepare("SELECT name FROM {$table} WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $name = $res->fetch_assoc()['name'] ?? '';
    $stmt->close();
    return $name;
}

// Fetch all resources with their level and board relationships
$sql = "
SELECT 
  r.*,
  l.id AS level_id, l.name AS level_name, l.boards_id AS level_board_id,
  b_child.id AS category_id, b_child.name AS category_name,
  b_parent.id AS board_id, b_parent.name AS board_name
FROM resources r
LEFT JOIN levels l ON r.levels_id = l.id
LEFT JOIN boards b_child ON l.boards_id = b_child.id
LEFT JOIN boards b_parent ON b_child.parent_id = b_parent.id
ORDER BY r.id DESC
";
$res = $conn->query($sql);
if (!$res) { echo "Error: ".$conn->error; exit; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Resources</title>
  <style>
    body {font-family: system-ui; padding:30px; background:#eef2f7;}
    .card {background:#fff; border-radius:10px; padding:16px; margin-bottom:14px; box-shadow:0 12px 30px rgba(0,0,0,0.05);}
    .path {font-size:13px; color:#555; margin-bottom:6px;}
    .title {font-weight:700; margin:0;}
    .meta {margin-top:4px; font-size:13px;}
    img.thumb {width:80px; height:auto; border-radius:6px; margin-top:6px;}
    a.download {display:inline-block; margin-top:8px; background:#2563eb; color:#fff; padding:6px 12px; border-radius:6px; text-decoration:none;}
  </style>
</head>
<body>
  <h2>All Uploaded Resources</h2>
  <?php while ($row = $res->fetch_assoc()): ?>
    <?php
      $parts = [];
      if ($row['board_name']) $parts[] = $row['board_name'];
      if ($row['category_name']) $parts[] = $row['category_name'];
      if ($row['level_name']) $parts[] = $row['level_name'];
      $full_path = implode(' / ', array_filter($parts));
    ?>
    <div class="card">
      <div class="path"><strong>Hierarchy:</strong> <?= htmlspecialchars($full_path) ?></div>
      <div class="title"><?= htmlspecialchars($row['name']) ?> (<?= htmlspecialchars($row['type']) ?>)</div>
      <div class="meta">
        Uploaded at: <?= htmlspecialchars($row['created_at'] ?? '') ?>
      </div>
      <?php if ($row['file_path']): ?>
        <div>
          <a class="download" href="<?= htmlspecialchars($row['file_path']) ?>" download>Download File</a>
        </div>
      <?php endif; ?>
      <?php if ($row['image']): ?>
        <img class="thumb" src="<?= htmlspecialchars($row['image']) ?>" alt="thumb">
      <?php endif; ?>
    </div>
  <?php endwhile; ?>
</body>
</html>
