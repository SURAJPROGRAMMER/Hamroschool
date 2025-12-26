<?php
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $education = $_POST['education'];
    $school = $_POST['school'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Handle file upload
    $profile_pic = "";
    if (!empty($_FILES["profile_pic"]["name"])) {
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        $file_name = basename($_FILES["profile_pic"]["name"]);
        $target_file = $target_dir . time() . "_" . $file_name;

        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
            $profile_pic = $target_file;
        } else {
            die("Error uploading file.");
        }
    }

    // Insert into database
    $sql = "INSERT INTO users (fullname, email, education, school, phone, address, profile_pic, password) 
            VALUES (:fullname, :email, :education, :school, :phone, :address, :profile_pic, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':fullname' => $fullname,
        ':email' => $email,
        ':education' => $education,
        ':school' => $school,
        ':phone' => $phone,
        ':address' => $address,
        ':profile_pic' => $profile_pic,
        ':password' => $password
    ]);

    echo "Registration successful! Redirecting to login page in 3 seconds...";
    echo '<meta http-equiv="refresh" content="3;url=login.html">';

}
?>
