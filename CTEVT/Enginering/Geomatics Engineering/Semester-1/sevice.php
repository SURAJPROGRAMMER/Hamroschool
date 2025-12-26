<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hamro School</title>
    <link rel="stylesheet" href="sevice.css">
</head>
<body>

    <div class="main">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">HaMo ScHooL</h2>
            </div>

            <div class="menu">
                <ul>
                    <li><a href="../../../HOME/home.html">HOME</a></li>
                    <li><a href="../../../../ABOUT/ABOUT.html">ABOUT</a></li>
                    <li>
                        <a href="#">SERVICE</a>
                         <ul class="dropdown">
                <li><a href="#">Seondary</a></li>
                <li><a href="#">NEB</a></li>
                <li><a href="CTEVT.html">CTEVT</a></li>
                <li><a href="#">Becholore</a></li>
            </ul>
                    </li>
                    <li><a href="../../../../DESING/DESING.html">DESIGN</a></li>
                    <li><a href="../../../../CONTACT/CONTACT.html">CONTACT</a></li>
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

// Set your level ID
$level_id = 65;

// Define resource types to fetch once each
$types = ['Book', 'Solution', 'Note', 'Question Bank', 'Question Solution', 'Syllabus'];

echo '<section class="books-section">';
echo '  <div class="container">';
echo '    <h2>Featured Resources</h2>';
echo '    <div class="book-container">';

foreach ($types as $type) {
    $stmt = $conn->prepare("SELECT * FROM resources WHERE levels_id = ? AND type = ? LIMIT 1");
    if ($stmt) {
        $stmt->bind_param("is", $level_id, $type);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            echo '      <div class="book-card" data-tooltip="' . htmlspecialchars($row['name']) . '">';
            echo '        <div class="logo">';
            echo '          <img src="' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['type']) . ' Logo">';
            echo '        </div>';
            echo '        <h3>' . strtoupper(htmlspecialchars($row['type'])) . '</h3>';
            echo '        <a href="' . htmlspecialchars($row['link']) . '" class="btn">Get ' . htmlspecialchars($row['type']) . '</a>';
            echo '      </div>';
        }

        $stmt->close();
    }
}

echo '    </div>'; // .book-container
echo '  </div>';   // .container
echo '</section>';
?>




    <!-- Books Section 
    <section class="books-section">
       <section class="books-section">
        <div class="container">
            <h2>Featured Resources</h2>
            <div class="book-container">
                <!-- Book Card --
                <div class="book-card" data-tooltip="Get various books here">
                    <div class="logo">
                        <img src="photo/book.jpeg" alt="Book Logo">
                    </div>
                    <h3>BOOK</h3>
                    <a href="BOOK.html" class="btn">Get Book</a>
                </div>

                <!-- Solution Card --
                <div class="book-card" data-tooltip="Find solutions to your problems">
                    <div class="logo">
                        <img src="photo/solution.jpeg" alt="Solution Logo">
                    </div>
                    <h3>SOLUTION</h3>
                    <a href="SOLUTION.html" class="btn">Get Solution</a>
                </div>

                <!-- Note Card --
                <div class="book-card" data-tooltip="Detailed notes for better learning">
                    <div class="logo">
                        <img src="photo/note.jpeg" alt="Note Logo">
                    </div>
                    <h3>NOTE</h3>
                    <a href="NOTE.html" class="btn">Get Note</a>
                </div>

                <!-- Question Bank Card --
                <div class="book-card" data-tooltip="Practice with question banks">
                    <div class="logo">
                        <img src="photo/qbank.jpeg" alt="Question Bank Logo">
                    </div>
                    <h3>QUESTION BANK</h3>
                    <a href="QUESTION.html" class="btn">Get Question Bank</a>
                </div>

                <!-- Question Solution Card --
                <div class="book-card" data-tooltip="Step-by-step question solutions">
                    <div class="logo">
                        <img src="photo/q.solution.jpeg" alt="Question Solution Logo">
                    </div>
                    <h3>QUESTION SOLUTION</h3>
                    <a href="QSOLUTION.html" class="btn">Get Q. Solution</a>
                </div>

                <!-- Syllabus Card --
                <div class="book-card" data-tooltip="Up-to-date syllabus">
                    <div class="logo">
                        <img src="photo/syllabus.jpeg" alt="Syllabus Logo">
                    </div>
                    <h3>SYLLABUS</h3>
                    <a href="SYLLABUS.html" class="btn">Get Syllabus</a>
                </div>
            </div>
        </div>
    </section> -->

   <!--- <script src="script.js"></script> 
    </section>
<!---------- Popular Courses HTML Ends --------->


 <footer class="footer-distributed">

        <div class="footer-left">
            <h3>

       Hamro  <span>School</span></h3>
            <p class="footer-links">
                <a href="../../../HOME/home.html">Home</a>
                |
                <a href="../../../../ABOUT/ABOUT.html">About</a>
                |
                <a href="#">service</a>
                |
                <a href="../../../../DESING/DESING.html">Design
                |
                 <a href="../../../../CONTACT/CONTACT.html">Contact</a>
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
                <strong>Hamro School</strong> "Our school’s website is  a solution provider. We do can offer answers to exam questions or materials intended to give direct solutions. Our goal is to provide students with educational resources, information, and inspiration to help them enhance their learning experience. We aim to simplify the learning process and contribute to the overall development of students.
            </p>
            <div class="icons">
                <a href="#"><i class="logo-facebook"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-youtube"></i></a>
            </div>
        </div>
    </footer>
</body>
</html>