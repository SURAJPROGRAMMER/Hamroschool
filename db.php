<?php
// 1. Database connection
$conn = new mysqli("localhost", "root", "", "hamroschool");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. Create table if not exists
$createTableSQL = "
CREATE TABLE IF NOT EXISTS boards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255) NOT NULL,
    link VARCHAR(255) NOT NULL,
    background_color VARCHAR(20) NOT NULL,
    level ENUM('category','faculty','program') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($createTableSQL);

// 3. Insert default data (only if table is empty)
$check = $conn->query("SELECT id FROM boards LIMIT 1");

if ($check->num_rows == 0) {
    $insertSQL = "
    INSERT INTO boards (name, description, image, link, background_color, level) VALUES
    ('UNIVERSITY',
     'विश्वविद्यालय स्तरको शिक्षा नेपालको शैक्षिक प्रणालीमा महत्वपूर्ण भूमिका खेल्छ',
     'Photo/University_logo.svg.png',
     'UNIVERSITY/faculty.php',
     '#f9fbfdff',
     'faculty'),
     
    ('CTEVT',
     'Council for Technical Education and Vocational Training',
     'Photo/ctevt.png',
     'CTEVT/faculty.php',
     '#f7f3f8ff',
     'faculty'),
     
    ('NEB',
     'NEB (राष्ट्रिय परीक्षा बोर्ड) नेपालमा माध्यमिक र उच्च माध्यमिक शिक्षा',
     'Photo/NEB.jpeg',
     'NEB/faculty.php',
     '#f5f8f7ff',
     'faculty'),
     
    ('SECONDARY',
     'माध्यमिक स्तरको शिक्षा नेपालको शैक्षिक प्रणालीमा एक महत्वपूर्ण चरण हो',
     'Photo/secondary.png',
     'SECONDARY/faculty.php',
     '#f8f5f3ff',
     'faculty')
    ";
    $conn->query($insertSQL);
}
?>
