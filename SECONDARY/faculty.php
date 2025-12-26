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
        <div class="container">
            <h2>OUR FACULTY </h2>
        </div>          
<?php
include 'db.php';

$parentName = 'Secondary'; // Top-level category

// Fetch the parent ID for 'Secondary'
$getParent = $conn->prepare("SELECT id FROM boards WHERE name = ?");
$getParent->bind_param("s", $parentName);
$getParent->execute();
$parentResult = $getParent->get_result();

if ($parentRow = $parentResult->fetch_assoc()) {
    $parent_id = $parentRow['id'];

    // Fetch child entries (grades) under 'Secondary'
    $stmt = $conn->prepare("SELECT * FROM boards WHERE parent_id = ? ORDER BY id ASC");
    $stmt->bind_param("i", $parent_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<div class="faculty-container">';

        while ($row = $result->fetch_assoc()) {
            echo '<div class="faculty-card">';
            echo '<img src="' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['name']) . '">';
            echo '<a href="' . htmlspecialchars($row['link']) . '">' . htmlspecialchars($row['name']) . '</a>';
            echo '<p>' . htmlspecialchars($row['description']) . '</p>';
            echo '</div>';
        }

        echo '</div>';
    } else {
        echo "<p>No grades found under Secondary.</p>";
    }
} else {
    echo "<p>Secondary category not found in database.</p>";
}
?>

 
<!--<section class="faculty-section">
        <div class="container">
            <h2>OUR FACULTY </h2>
            <div class="faculty-container">
                <div class="faculty-card">
                    <img src="Photo/grade_1.png" alt="Faculty 1">
                     <a href="Grade_1/grade1/grade001.html">Grade 1</a>
                    <p></p>
                </div>
                <div class="faculty-card">
                    <img src="Photo/grade_2.png" alt="Faculty 2">

                    <a href="Grade_2/grade2/grade02.html">Grade 2</a>
                    <p></p>
                </div>
                 <div class="faculty-card">
                    <img src="Photo/grade_3.png" alt="Faculty 1">
                     <a href="Grade_3/grade3/grade03.html">Grade 3</a>
                    <p></p>
                     </div> 
                     <div class="faculty-card">
                        <img src="Photo/grade_4.png" alt="Faculty 2">
    
                        <a href="Grade_4/grade2/grade04.html">Grade 4</a>
                        <p></p>
                    </div>
                    <div class="faculty-card">
                        <img src="Photo/grade_5.png" alt="Faculty 2">
    
                        <a href="Grade_5/grade2/grade05.html">Grade 5</a>
                        <p></p>
                    </div>
                    <div class="faculty-card">
                        <img src="Photo/grade_6.png" alt="Faculty 2">
    
                        <a href="Grade_6/grade2/grade06.html">Grade 6</a>
                        <p></p>
                    </div>
                    <div class="faculty-card">
                        <img src="Photo/grade_7.png" alt="Faculty 2">
    
                        <a href="Grade_7/grade2/grade07.html">Grade 7</a>
                        <p></p>
                    </div>
                    <div class="faculty-card">
                        <img src="Photo/grade_8.png" alt="Faculty 2">
    
                        <a href="Grade_8/grade2/grade08.html">Grade 8</a>
                        <p></p>
                    </div>
                    <div class="faculty-card">
                        <img src="Photo/grade_9.png" alt="Faculty 2">
    
                        <a href="Grade_9/grade2/grade09.html">Grade 9</a>
                        <p></p>
                    </div>
                    <div class="faculty-card">
                        <img src="Photo/SEE.png" alt="Faculty 2">
    
                        <a href="SEE/grade2/SEE.html">Secondary Education Examination (SEE) </a>
                        <p></p>
                    </div>
            </div>
                    
    </section> -->

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