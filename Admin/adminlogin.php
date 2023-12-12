<?php
include '../assets/connection.php';

if (isset($_POST['admin'])) {
    //username and password from the form
    $adminid = $_POST['admin_id'];
    $adminpassword= $_POST['admin_password'];

    // Query for checking 
    $query = "SELECT * FROM `admin` WHERE `admin_id`='$adminid' AND `admin_password`='$adminpassword'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
       
        header("Location:dashboard.php");
        exit();
    } else {
        
        $error = "Invalid username or password";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../assets/astyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>
<body>
    <div class="login-form">
        <h2>Admin Login</h2>
        <form method="POST">
            <div class="input-field">
            <i class="bi bi-person-circle"></i>
                
                <input type="text" placeholder="Username" name="adminid" required>
            </div>
            <div class="input-field">
            <i class="bi bi-shield-lock"></i>
                
                <input type="password" placeholder="Password" name="adminpassword" required>
            </div>
            <div class="error"><?php if (isset($error)) echo $error; ?></div>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>