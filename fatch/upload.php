<?php
include 'db.php';

// Retrieve inputs
$board_id = intval($_POST['board_id'] ?? 0);
$level_id = intval($_POST['level_id'] ?? 0);
$sub_level_id = intval($_POST['sub_level_id'] ?? 0);
$content_type = $_POST['content_type'] ?? '';
$subject_name = $_POST['subject_name'] ?? '';

// Validate minimal
if (!$board_id || !$level_id || empty($content_type) || empty($subject_name) || empty($_FILES['file'])) {
    die("Missing required fields.");
}

// Handle upload
$targetDir = "uploads/resources/";
if (!is_dir($targetDir)) mkdir($targetDir, 0755, true);

$file_path = '';
if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $original = basename($_FILES['file']['name']);
    $ext = pathinfo($original, PATHINFO_EXTENSION);
    $safeName = time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
    $dest = $targetDir . $safeName;
    if (move_uploaded_file($_FILES['file']['tmp_name'], $dest)) {
        $file_path = $dest;
    } else {
        die("Failed to move uploaded file.");
    }
} else {
    die("Upload error.");
}

// Insert into resources
$stmt = $conn->prepare("INSERT INTO resources (levels_id, type, name, link, image, file_path) VALUES (?, ?, ?, ?, ?, ?)");
$type = $content_type;
$name = $subject_name;
$link = ''; // if you want separate link, leave empty or set
$image = ''; // optional thumbnail
$stmt->bind_param("isssss", $level_id, $type, $name, $link, $image, $file_path);
if ($stmt->execute()) {
    echo "Upload successful. <a href='display_resources.php'>View resources</a>";
} else {
    echo "DB error: " . $stmt->error;
}
$stmt->close();
?>
