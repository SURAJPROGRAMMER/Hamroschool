<?php
include 'db.php'; // make sure db.php connects to your hamro_school DB

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = $_POST['category'];
    $grade = $_POST['grade'];
    $faculty_category = $_POST['faculty_category'];
    $faculty_name = $_POST['faculty_name'];
    $year_sem = $_POST['year_sem'];
    $content_type = $_POST['content_type'];
    $subject_name = $_POST['subject_name'];

    // File upload location
    $uploadDir = "../files";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = basename($_FILES['file']['name']);
    $targetFilePath = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
        // Save into database
        $stmt = $conn->prepare("INSERT INTO files 
            (category, grade, faculty_category, faculty_name, year_sem, content_type, subject_name, file_path) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $category, $grade, $faculty_category, $faculty_name, $year_sem, $content_type, $subject_name, $targetFilePath);

        if ($stmt->execute()) {
            echo "✅ File uploaded successfully!<br>";
            echo "<a href='../Hamroschool/CTEVT/Enginering/CiVil Engineering/Semester-1/list.php'>View Uploaded Files</a>";
        } else {
            echo "❌ Database Error: " . $stmt->error;
        }
    } else {
        echo "❌ File upload failed.";
    }
}
?>
