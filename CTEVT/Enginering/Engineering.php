<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hamro School</title>
    <link rel="stylesheet" href="Engineering.css">
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
include 'db.php';

$result = $conn->query("SELECT * FROM levels WHERE boards_id = 6");

echo '<section class="faculty-section">';
echo '<div class="container">';
echo '<h1>All Diploma Engineering Faculty</h1>';
echo '<div class="program-horizontal">';

while ($row = $result->fetch_assoc()) {
    echo '<a href="' . $row['link'] . '" class="program-item" style="background-color: ' . $row['background_color'] . '; text-decoration: none; color: inherit;">';
    echo '<img src="' . $row['image'] . '" alt="Icon" class="icon">';
    echo '<div class="program-name">' . $row['name'] . '</div>';
    echo '</a>';
}

echo '</div>';
echo '<p class="footer-text">"To the great minds of engineering – the ones who shape the future with vision, precision, and innovation."</p>';
echo '</div>';
echo '</section>';
?>




<!----

 <section class="faculty-section">
         <div class="container"> -->
        <!-- Semester Logo -->
         <!----
        <div class="logo-container">
         <img src="photo/Hamroschool.logo.png" alt="Semester Logo" class="logo">
        </div>
        <h1>All Diploma Engineering Faculty</h1>
        <div class="program-horizontal">
            <div class="program-item" style="background-color: #34c3b2;">
                <img src="photo/Civil Engineering.jpg" alt="Note Icon" class="icon"> 
                <a href="CiVil Engineering/civilengineering.html">Civil Engineering</a>
            </div>
            <div class="program-item" style="background-color: #34a4c3;">
                <img src="photo/Geometrics.png" alt="Note Icon" class="icon">
                <a href="Geomatics Engineering/civilengineering.html">Geomatics Engineering</a>
            </div>
            <div class="program-item" style="background-color: #ffc107;">
                <img src="photo/Computer.jpeg" alt="Note Icon" class="icon">
                <a href="Computer Engineering/civilengineering.html">Computer Engineering</a>
            </div>
            <div class="program-item" style="background-color: #ff5722;">
                <img src="photo/IT Engineering.png" alt="Note Icon" class="icon">
                <a href="IT Engineering/civilengineering.html">IT Engineering</a>
            </div>
            <div class="program-item" style="background-color: #e91e63;">
                <img src="photo/electrical.png" alt="Note Icon" class="icon">
                <a href="Electrical Engineering/civilengineering.html">Electrical Engineering</a>
            </div>
            <div class="program-item" style="background-color: #673ab7;">
                <img src="photo/Electronic-engineering.png" alt="Note Icon" class="icon">
                <a href="Electronic Engineering/civilengineering.html">Electronic Engineering</a>
            </div>
            <div class="program-item" style="background-color: #673ab7;">
                <img src="photo/elctric&elctronic.jpg" alt="Note Icon" class="icon">
                <a href="Electrical & Electronic Engineering/civilengineering.html">Electrical & Electronic Engineering</a>
            </div>
            <div class="program-item" style="background-color: #ffc107;">
                <img src="photo/Artichutre.jpeg" alt="Note Icon" class="icon">
                <a href="Architectural Engineering/civilengineering.html">Architectural Engineering</a>
            </div>
            <div class="program-item" style="background-color: #34c3b2;">
                <img src="photo/Mechanical.png" alt="Note Icon" class="icon"> 
                <a href="Mechanical Engineering/civilengineering.html">Mechanical Engineering</a>
            </div>
            <div class="program-item" style="background-color: #e91e63;">
                <img src="photo/mechatronics.jpeg" alt="Note Icon" class="icon">
                <a href="mechatronics Engineering/civilengineering.html">mechatronics Engineering</a>
            </div>
             <div class="program-item" style="background-color: #34a4c3;">
                <img src="photo/automobile.jpeg" alt="Note Icon" class="icon">
                <a href="Automobile Engineering/civilengineering.html">Automobile Engineering</a>
            </div>
             <div class="program-item" style="background-color: #ff5722;">
                <img src="photo/ref&Ac.jpg" alt="Note Icon" class="icon">
                <a href="Ref And AC Engineering/civilengineering.html">Ref And AC Engineering</a>
            </div>
            <div class="program-item" style="background-color: #34c3b2;">
                <img src="photo/Cicil Special.png" alt="Note Icon" class="icon"> 
                <a href="Civil Special Engineering/civilengineering.html">Civil Special Engineering</a>
            </div>
             <div class="program-item" style="background-color: #ffc107;">
                <img src="photo/Biomedical.jpg" alt="Note Icon" class="icon">
                <a href="Biomedical Engineering/civilengineering.html">Biomedical Engineering</a>
            </div>
            <div class="program-item" style="background-color: #ffc107;">
                <img src="photo/Hydropower.jpeg" alt="Note Icon" class="icon">
                <a href="Hydropower Engineering/civilengineering.html">Hydropower Engineering</a>
            </div>
        </div>
        <p class="footer-text">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis lacus in est mollis eleifend.
        </p>
    </div>
       
    </section>
-->

     
<!---------- Popular Courses HTML Ends --------->



 <footer class="footer-distributed">

        <div class="footer-left">
            <h3>

       Hamro  <span>School</span></h3>
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
                <p>+9779800000000</p>
            </div>
            <div>
                <i class="fa fa-envelope"></i>
                <p><a href="mailto:sagar00001.co@gmail.com">hamroschool@gmail.com</a>
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