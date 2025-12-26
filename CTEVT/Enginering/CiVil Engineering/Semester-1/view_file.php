<?php
include 'db.php';

if (isset($_GET['file_id'])) {   // Use file ID instead of raw path
    $fileId = intval($_GET['file_id']); // sanitize input

    // Get file info from database
    $stmt = $conn->prepare("SELECT file_path FROM files WHERE id = 1");
    $stmt->bind_param("i", $fileId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $filePath = $row['file_path'];
        $safeFile = basename($filePath);

        if (file_exists($filePath)) {
            $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

            if ($ext === "pdf") {
                header("Content-type: application/pdf");
                header("Content-Disposition: inline; filename=\"$safeFile\"");
                readfile($filePath);
            } elseif (in_array($ext, ["jpg","jpeg","png","gif"])) {
                header("Content-type: image/" . $ext);
                readfile($filePath);
            } else {
                echo "Cannot view this file type. Use Download.";
            }
        } else {
            echo "File not found on server!";
        }

    } else {
        echo "File not found in database!";
    }

} else {
    echo "No file specified!";
}
?>
