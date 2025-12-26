<?php
if (isset($_GET['file'])) {
    $file = $_GET['file'];

    // Security check (allow only PDFs inside "uploads" folder)
    if (preg_match('/\.pdf$/i', $file) && file_exists($file)) {
        header("Content-type: application/pdf");
        header("Content-Disposition: inline; filename='" . basename($file) . "'");
        readfile($file);
    } else {
        echo "File not found or not a PDF.";
    }
} else {
    echo "No file specified.";
}
?>
