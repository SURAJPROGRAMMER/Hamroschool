<?php 
include 'db.php';

$result = $conn->query("SELECT * FROM files ORDER BY uploaded_at DESC");

echo "<h2>Uploaded Files</h2>";
echo "<table border='1' cellpadding='5'>";
echo "<tr>
        <th>ID</th>
        <th>Category</th>
        <th>Grade</th>
        <th>Faculty</th>
        <th>Year/Sem</th>
        <th>Content</th>
        <th>Subject</th>
        <th>Actions</th>
      </tr>";

while ($row = $result->fetch_assoc()) {
    $filePath = $row['file_path'];
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['category']}</td>
            <td>{$row['grade']}</td>
            <td>{$row['faculty_name']}</td>
            <td>{$row['year_sem']}</td>
            <td>{$row['content_type']}</td>
            <td>{$row['subject_name']}</td>
            <td>
                <a href='view_file.php?file={$filePath}' target='_blank'>
                    <button>View</button>
                </a>
                <a href='{$filePath}' download>
                    <button>Download</button>
                </a>
            </td>
          </tr>";
}
echo "</table>";

$conn->close();
?>
