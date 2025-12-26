<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hamro School</title>
    <link rel="stylesheet" href="faculty.css">
</head>
<body>

    <div class="main">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">HaMo ScHooL</h2>
            </div>

            <div class="menu">
                <ul>
                    <li><a href="../HOME/home.html">HOME</a></li>
                    <li><a href="../../ABOUT/ABOUT.html">ABOUT</a></li>
                    <li>
                        <a href="#">SERVICE</a>
                         <ul class="dropdown">
                <li><a href="#">Seondary</a></li>
                <li><a href="#">NEB</a></li>
                <li><a href="CTEVT.html">CTEVT</a></li>
                <li><a href="#">Becholore</a></li>
            </ul>
                    </li>
                    <li><a href="../../DESING/DESING.html">DESIGN</a></li>
                    <li><a href="../../CONTACT/CONTACT.html">CONTACT</a></li>
                </ul>
            </div>
            <div class="search">
                <input class="srch" type="search" name="" placeholder="Type To text">
                <a href="#"> <button class="btn">Search</button></a>
            </div>

        </div> 
<!---------- Popular Courses HTML Starts --------->
<section class="faculty-section">
        <div class="container">
            <h2>OUR FACULTY </h2>
        </div>
    </section>

<?php
include 'db.php';

$parentName = 'CTEVT';

// Get CTEVT parent ID
$getParent = $conn->prepare("SELECT id FROM boards WHERE name = ?");
$getParent->bind_param("s", $parentName);
$getParent->execute();
$parentResult = $getParent->get_result();

if ($parentRow = $parentResult->fetch_assoc()) {
    $parent_id = $parentRow['id'];

    // Get all faculties under CTEVT
    $stmt = $conn->prepare("SELECT * FROM boards WHERE parent_id = ?");
    $stmt->bind_param("i", $parent_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<div class="faculty-container">'; // Open grid wrapper
        while ($row = $result->fetch_assoc()) {
            echo '<div class="faculty-card">';
            echo '<img src="' . $row['image'] . '" alt="' . htmlspecialchars($row['name']) . '">';
            echo '<a href="' . $row['link'] . '">' . strtoupper(htmlspecialchars($row['name'])) . '</a>';
            echo '<p>' . htmlspecialchars($row['description']) . '</p>';
            echo '</div>';
        }
        echo '</div>'; // Close grid wrapper
    } else {
        echo "<p>No faculty found under CTEVT (parent_id = $parent_id).</p>";
    }
} else {
    echo "<p>CTEVT category not found in boards table.</p>";
}
?>




<!--
 <section class="faculty-section">
        <div class="container">
            <h2>OUR FACULTY </h2>
            <div class="faculty-container">
                <div class="faculty-card">
                    <img src="Photo/Medical.jpeg" alt="Faculty 1">
                     <a href="Medical/Medical.html">MEDICAL</a>
                    <p></p>
                </div>
                <div class="faculty-card">
                    <img src="Photo/engineering.png" alt="Faculty 2">

                    <a href="Enginering/Engineering.html">ENGINEERING</a>
                    <p></p>
                </div>

                <div class="faculty-card">
                    <img src="Photo/other.jpeg" alt="Faculty 1">
                     <a href="Other/other.html">OTHER ENGINEERING</a>
                    <p></p>
            </div>
        </div>
    </section>
-->

<!---------- Popular Courses HTML Ends --------->



 <footer class="footer-distributed">

        <div class="footer-left">
            <h3>

       Hamro  <span>School</span></h3>
            <p class="footer-links">
                <a href="../HOME/home.html">Home</a>
                |
                <a href="../../ABOUT/ABOUT.html">About</a>
                |
                <a href="#">service</a>
                |
                <a href="../../DESING/DESING.html">Design
                |
                 <a href="../../CONTACT/CONTACT.html">Contact</a>
                |
                <a href="#"></a>
            </p>

            <p class="footer-company-name">Copyright © 2024<strong>Hamroschool </span> all right recived </p>
        </div>

        <div class="footer-center">
            <div>
                <i class="fa fa-map-marker"></i>
                <p><span>kathamandu</span>
                Nepal</p>
            </div>

            <div>
                <i class="fa fa-phone"></i>
                <p>+9779807728498</p>
            </div>
            <div>
                <i class="fa fa-envelope"></i>
                <p><a href="mailto:sagar00001.co@gmail.com">hamroschool.np@gmail.com</a>
            </div>
        </div>
        <div class="footer-right">
            <p class="footer-company-about">
                <span>About the company</span>
               <strong>HaMro ScHool</strong> "Our school’s website is  a solution provider. We do can offer answers to exam questions or materials intended to give direct solutions. Our goal is to provide students with educational resources, information, and inspiration to help them enhance their learning experience. We aim to simplify the learning process and contribute to the overall development of students."
            </p>
            <div class="footer-icons">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-youtube"></i></a>
            </div>
        </div>
    </footer>


</body>
</html>