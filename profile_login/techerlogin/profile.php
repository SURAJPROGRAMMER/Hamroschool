<?php
session_start();
require_once 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute([':id' => $_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <style>

:root {
            --primary-color: #4CAF50;
            --sidebar-width: 250px;
        }
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
            background-color: #f5f5f5;
        }
        .sidebar {
            width: var(--sidebar-width);
            background-color: #2c3e50;
            color: white;
            padding: 1rem;
            height: 100vh;
            position: fixed;
        }
        .sidebar-header {
            text-align: center;
            padding: 1rem 0;
            border-bottom: 1px solid #34495e;
        }
        .sidebar-nav {
            margin-top: 1rem;
        }
        .nav-item {
            padding: 0.75rem;
            border-radius: 4px;
            margin-bottom: 0.5rem;
            cursor: pointer;
        }
        .nav-item:hover {
            background-color: #34495e;
        }
        .nav-item.active {
            background-color: var(--primary-color);
        }
        .main-content {
            margin-left: var(--sidebar-width);
            flex: 1;
            padding: 2rem;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        .profile-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 800px;
            margin: 0 auto;
        }
        .profile-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #f5f5f5;
            margin: 0 auto 1rem;
            display: block;
            background-color: #ddd;
            position: relative;
            overflow: hidden;
        }
        .profile-picture-upload {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }
        .upload-icon {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: var(--primary-color);
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }
        .profile-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }
        .detail-group {
            margin-bottom: 1rem;
        }
        .detail-label {
            font-weight: bold;
            color: #555;
            margin-bottom: 0.5rem;
            display: block;
        }
        .detail-value {
            padding: 0.75rem;
            background:rgb(246, 242, 242);
            border-radius: 4px;
            border: 1px solid #eee;
        }
        .details-value {
            padding: 0.75rem;
            margin-right:400px;
            background:rgb(245, 243, 243);
            border-radius: 4px;
            border: 1px solid #eee;
        }
        .edit-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 3
            margin-right: 15px;
            margin-bottom: 40px;
            margin-left: 25px;
            float: right;
        }
        .edit-btn:hover {
            background-color:rgb(67, 88, 246);
        }
</style>

</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>Dashboard</h2>
        </div>
        <div class="sidebar-nav">
            <div class="nav-item active" onclick="window.location.href='profile.php'">Profile</div>
            <div class="nav-item" onclick="window.location.href='../uploading/upload_form.html'">
                Upload</div>
            <div class="nav-item">Settings</div>
            <div class="nav-item">Messages</div>
            <div class="nav-item" onclick="window.location.href='logout.php'">Logout</div>
            
        </div>
    </div>

    
<div class="main-content">
   
    <div class="profile-container">
        <div class="profile-header">
            <div style="position: relative; display: inline-block;">
                <img src="<?php echo htmlspecialchars($user['profile_pic']); ?>" alt="Profile Picture" class="profile-picture" id="profile-picture" width="150">
                <input type="file" id="profile-upload" class="profile-picture-upload" accept="image/*">
                <div class="upload-icon">+</div>
            </div>
            <h2 id="user-name"> <?php echo htmlspecialchars($user['fullname']); ?>&nbsp;&nbsp;</h2>
            
        </div>

        <div class="profile-details">
            <div class="detail-group">
                <span class="detail-label">Full Name</span>
                <div class="detail-value" id="detail-fullname"><?php echo htmlspecialchars($user['fullname']); ?></div>
            </div>
            <div class="detail-group">
                <span class="detail-label">Email</span>
                <div class="detail-value" id="detail-email"><?php echo htmlspecialchars($user['email']); ?></div>
            </div>
            <div class="detail-group">
                <span class="detail-label">Level of Education</span>
                <div class="detail-value" id="detail-education"><?php echo htmlspecialchars($user['education']); ?></div>
            </div>
            <div class="detail-group">
                <span class="detail-label">School Name</span>
                <div class="detail-value" id="detail-school"><?php echo htmlspecialchars($user['school']); ?></div>
            </div>
            <div class="detail-group">
                <span class="detail-label">Phone Number</span>
                <div class="detail-value" id="detail-phone"><?php echo htmlspecialchars($user['phone']); ?></div>
            </div>
            <div class="detail-group" style="grid-column: span 2;">
                <span class="details-label">Address</span>
                <div class="details-value" id="detail-address"><?php echo htmlspecialchars($user['address']); ?></div>
            </div>
            <div class="detail-group" style="grid-column: span 2;">
                <span class="details-label">Date of Birth</span>
                <div class="details-value" id="detail-address"><?php echo htmlspecialchars($user['address']); ?></div>
            </div>
        </div>

        <button class="edit-btn" id="edit-profile">Edit Profile</button>
       
</div>


<script src="profile.js"></script>

</body>
</html>
