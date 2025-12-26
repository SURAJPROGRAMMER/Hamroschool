<?php include 'db.php'; ?>
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
<?php
include 'db.php'; // Ensure this connects properly to your database

// Step 1: Get the parent ID of NEB
$nebCategory = 'NEB';
$level = 'program';

$stmt = $conn->prepare("SELECT * FROM boards WHERE category = ? AND level = ?");
$stmt->bind_param("ss", $nebCategory, $level);
$stmt->execute();
$result = $stmt->get_result();
?>

<section class="faculty-section">
  <div class="container">
    <h2>NEB Faculty</h2>
    <div class="faculty-container">

      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="faculty-card">
          <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
          <a href="<?php echo htmlspecialchars($row['link']); ?>">
           <?php echo htmlspecialchars($row['name']); ?> 
          </a>
          <p><?php echo htmlspecialchars($row['description']); ?></p>
        </div>
      <?php endwhile; ?>

    </div>
  </div>
</section>


<!--
 <section class="faculty-section">
        <div class="container">
            <h2>NEB Faculty </h2>
            <div class="faculty-container">
                <div class="faculty-card">
                    <img src="Photo/science.jpg" alt="Faculty 1">
                     <a href="science/science.html">Science</a>
                    <p></p>
                </div>
                <div class="faculty-card">
                    <img src="Photo/mangenet.jpeg" alt="Faculty 2">

                    <a href="Mangement/mangement.html">Management</a>
                    <p></p>
                </div>
                 <div class="faculty-card">
                    <img src="Photo/law.png" alt="Faculty 1">
                     <a href="law/law.html">Law</a>
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