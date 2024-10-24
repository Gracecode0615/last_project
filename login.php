<?php
include 'config.php';
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);

if (isset($_POST['reg'])) {
    session_start(); // Start the session at the beginning

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $error_message = '';
    // Ensure SQL query is properly formatted
    $sql = "SELECT * FROM `user` WHERE `email` = '$email'";
    $query = mysqli_query($con, $sql);

    if (!$query) {
        // Handle query error
        $error_message = "<div class='alert alert-danger'>Query failed: " . mysqli_error($con) . "</div>";
    } else {
        $count = mysqli_num_rows($query);

        if ($count == 1) {
            $row = mysqli_fetch_assoc($query);
            $pass = $row['password'];
            $check = password_verify($password, $pass);

            if ($check) {
                $_SESSION['log'] = $email;
                header('Location:index.php'); // Use proper capitalization and ensure no output before this
                exit(); // Ensure script stops execution after redirect
            } else {
                $error_message= "<div class='alert alert-danger'>Login failed</div>";
            }
        	} else {
            $error_message= "<div class='alert alert-danger'>User not found</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!--Bootstrap Stylesheet -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css
     ">
     <link rel="stylesheet" href="css/style.css">
    <title>Register-page</title>
</head>
<body>
    <?php 
    include "header.html";
    ?>
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="title px-5"><span class="px-2">Kindly login here</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-5  ">
                <img src="img/cat-2.jpg" alt="">
            </div>
            <div class="col-lg-7 mb-5">
                <form action="" method="post">
                <?php if (isset($error_message)) echo $error_message; ?>
                    <div class="form-floating">
                        <input type="email" placeholder="Email Address*" name="email" class="form-control mb-3">
                        <label for="floatingInput" class="px-4">Email Address*</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control mb-3 w-100" placeholder="Enter password*">
                        <label for="floatingPassword" class="px-4">Enter password*</label>
                        <i class="bi bi-eye" onclick="togglePassword('password')"></i>
                    </div>
                    <div class="form-floating">
                        <input type="submit" name="reg" class="submit form-control mb-3 w-100 px-4">
                    </div>
                    <span><a href="forgot.php">Forgot password?</a></span>
                    <span>Don't have an already? <a href="register.php">Register here</a></span>
                </form>
            </div>
            <!-- <div class="col-md-3"></div> -->
        </div>
    </div>
    <?php include "footer.html" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js
    "></script>
</body>
</html>