<?php
header('Content-Type: application/json');
include 'db.php';

$parent_id = intval($_GET['parent_id'] ?? 0);
$out = [];

// First try: children in levels where parent_id = ?
$stmt = $conn->prepare("SELECT id, name FROM levels WHERE parent_id = ?");
$stmt->bind_param("i", $parent_id);
$stmt->execute();
$res = $stmt->get_result();
while ($r = $res->fetch_assoc()) {
    $out[] = ['id' => intval($r['id']), 'name' => $r['name']];
}
$stmt->close();

// Fallback: if none and parent is a board, get levels under that board (top-level faculties/programs)
if (empty($out)) {
    $stmt2 = $conn->prepare("SELECT id, name FROM levels WHERE boards_id = ? AND parent_id = 0");
    $stmt2->bind_param("i", $parent_id);
    $stmt2->execute();
    $res2 = $stmt2->get_result();
    while ($r2 = $res2->fetch_assoc()) {
        $out[] = ['id' => intval($r2['id']), 'name' => $r2['name']];
    }
    $stmt2->close();
}

echo json_encode($out);
