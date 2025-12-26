<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "hamroschool";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php
// ===============================
// DATABASE CONNECTION
// ===============================
$conn = new mysqli("localhost", "root", "", "hamroschool");

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// ===============================
// CREATE TABLE (IF NOT EXISTS)
// ===============================
$conn->query("
CREATE TABLE IF NOT EXISTS boards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255) NOT NULL,
    link VARCHAR(255) NOT NULL,
    background_color VARCHAR(20) NOT NULL,
    level ENUM('category','faculty','program') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)
");

// ===============================
// INSERT DEFAULT DATA (ONLY ONCE)
// ===============================
$check = $conn->query("SELECT id FROM boards LIMIT 1");
if ($check->num_rows == 0) {
    $conn->query("
    INSERT INTO boards (name, description, image, link, background_color, level) VALUES
    ('UNIVERSITY',
     'विश्वविद्यालय स्तरको शिक्षा नेपालको शैक्षिक प्रणालीमा महत्वपूर्ण भूमिका खेल्छ',
     'Photo/University_logo.svg.png',
     'UNIVERSITY/faculty.php',
     '#f2f4f7ff',
     'faculty'),

    ('CTEVT',
     'Council for Technical Education and Vocational Training',
     'Photo/ctevt.png',
     'CTEVT/faculty.php',
     '#f2f1f3ff',
     'faculty'),

    ('NEB',
     'NEB (राष्ट्रिय परीक्षा बोर्ड) नेपालमा माध्यमिक र उच्च माध्यमिक शिक्षा',
     'Photo/NEB.jpeg',
     'NEB/faculty.php',
     '#eef3f2ff',
     'faculty'),

    ('SECONDARY',
     'माध्यमिक स्तरको शिक्षा नेपालको शैक्षिक प्रणालीमा एक महत्वपूर्ण चरण हो',
     'Photo/secondary.png',
     'SECONDARY/faculty.php',
     '#f8f7f6ff',
     'faculty')
    ");
}
?>
