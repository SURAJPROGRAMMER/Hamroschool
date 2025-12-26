<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hamro School</title>
    <link rel="stylesheet" href="other.css">
</head>
<body>

    <div class="main">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">HaMo ScHooL</h2>
            </div>

            <div class="menu">
                <ul>
                    <li><a href="../../HOME/home.html">HOME</a></li>
                    <li><a href="../../../ABOUT/ABOUT.html">ABOUT</a></li>
                    <li>
                        <a href="#">SERVICE</a>
                         <ul class="dropdown">
                <li><a href="#">Seondary</a></li>
                <li><a href="#">NEB</a></li>
                <li><a href="CTEVT.html">CTEVT</a></li>
                <li><a href="#">Becholore</a></li>
            </ul>
                    </li>
                    <li><a href="../../../DESING/DESING.html">DESIGN</a></li>
                    <li><a href="../../../CONTACT/CONTACT.html">CONTACT</a></li>
                </ul>
            </div>
            <div class="search">
                <input class="srch" type="search" name="" placeholder="Type To text">
                <a href="#"> <button class="btn">Search</button></a>
            </div>

        </div> 
<!---------- Popular Courses HTML Starts --------->
<?php
include 'db.php'; // Make sure this file connects to your MySQL database properly

$sql = "SELECT * FROM levels WHERE boards_id = 7 ORDER BY id ASC";
$result = $conn->query($sql);
?>

<section class="faculty-section">
    <div class="container">
        <!-- Logo -->
        <div class="logo-container">
            <img src="photo/Hamroschool.logo.png" alt="Semester Logo" class="logo">
        </div>

        <h1>All Diploma of Other Engineering</h1>

        <!-- Programs -->
        <div class="program-horizontal">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="program-item" style="background-color: <?= htmlspecialchars($row['background_color']) ?>;">
                    <img src="<?= htmlspecialchars($row['image']) ?>" alt="Icon" class="icon">
                    <a href="<?= htmlspecialchars($row['link']) ?>"><?= htmlspecialchars($row['name']) ?></a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>


<!--
 <section class="faculty-section">
         <div class="container">
        <!-- Semester Logo -->
         <!--
        <div class="logo-container">
         <img src="photo/Hamroschool.logo.png" alt="Semester Logo" class="logo">
        </div>
        <h1>All Diploma of other Engineering</h1>
        <div class="program-horizontal">
            <div class="program-item" style="background-color: #34c3b2;">
                <img src="photo/garicuture.jpeg" alt="Note Icon" class="icon"> 
                <a href="Agriculture Engineering/civilengineering.html">Agriculture Engineering </a>
            </div>
            <div class="program-item" style="background-color: #34a4c3;">
                <img src="photo/amial.png" alt="Note Icon" class="icon">
                <a href="Animal Science/civilengineering.html">Animal Science</a>
            </div>
            <div class="program-item" style="background-color: #ffc107;">
                <img src="photo/food nad dairy.jpeg" alt="Note Icon" class="icon">
                <a href="Food & Dairy Technology/civilengineering.html">Food & Dairy Technology</a>
            </div>
            <div class="program-item" style="background-color: #ff5722;">
                <img src="photo/hotel.png" alt="Note Icon" class="icon">
                <a href="Hotel Management/civilengineering.html">Hotel Management  </a>
            </div>
            <div class="program-item" style="background-color: #e91e63;">
                <img src="photo/tourim.jpg" alt="Note Icon" class="icon">
                <a href="Tourism/civilengineering.html">Tourism</a>
            </div>
            <div class="program-item" style="background-color: #673ab7;">
                <img src="photo/agro engineering.jpg" alt="Note Icon" class="icon">
                <a href="Agro Engineering/civilengineering.html">Agro Engineering</a>
            </div>
    </section>
-->


   
<!---------- Popular Courses HTML Ends --------->



 <footer class="footer-distributed">

        <div class="footer-left">
            <h3>

       Hamro   <span>School</span></h3>
            <p class="footer-links">
                <a href="../../HOME/home.html">Home</a>
                |
                <a href="../../../ABOUT/ABOUT.html">About</a>
                |
                <a href="#">service</a>
                |
                <a href="../../../DESING/DESING.html">Design
                |
                 <a href="../../../CONTACT/CONTACT.html">Contact</a>
                |
                <a href="#"></a>
            </p>

            <p class="footer-company-name">Copyright © 2024<strong>uniquDeveloper </span> all right recived </p>
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