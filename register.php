<?php
include 'config.php';
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);

if(isset($_POST['reg'])){
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $last = mysqli_real_escape_string($con,$_POST['last']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $date = mysqli_real_escape_string($con, $_POST['date']);
    $gender = isset($_POST['gender']) ? mysqli_real_escape_string($con, $_POST['gender']) : '';
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirm = mysqli_real_escape_string($con, $_POST['confirm']);
    $passwordh = password_hash($password, PASSWORD_DEFAULT);
    
    $error_message = "";

    // check for empty fields
    if(empty($name) || empty($last) || empty($email) || empty($gender) || 
    empty($password) || empty($confirm)){
        $error_message = "<div class='alert alert-danger'>Fields can't be empty!</div>";
        //  validate email pattern
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "<div class='alert alert-danger'>Invalid email format!</div>";
    } elseif (!preg_match('/^[\w\.-]+@([\w-]+\.)+com$/', $email) && !preg_match('/^[\w\.-]+@gmail\.com$/', $email)) {
        $error_message = "<div class='alert alert-danger'>Email must end in .com or @gmail.com!</div>";
    }
    else{
         // Check if email already exists
         $email_check_query = "SELECT * FROM `user` WHERE `email` = '$email' LIMIT 1";
         $result = mysqli_query($con, $email_check_query);
         $email_exists = mysqli_num_rows($result) > 0;
 
         if ($email_exists) {
             $error_message = "<div class='alert alert-danger'>Email is already registered!</div>";
         } elseif ($password !== $confirm) {
             $error_message = "<div class='alert alert-danger'>Passwords do not match!</div>";
         } else{
            $sql = "INSERT INTO `user` (`name`,`last`,`email`,`date`,`gender`,`password`) VALUES
             ('$name', '$last', '$email', '$date','$gender,'$passwordh')";

             $sql = "INSERT INTO `user` (`name`, `last`, `email`, `date`, `gender`, `password`) 
             VALUES ('$name', '$last', '$email', '$date', '$gender', '$passwordh')";
     
            $query = mysqli_query($con, $sql);
            if($query){
                // echo"<div class='alert alert-success'>Registration Successful</div>";
                $_SESSION['success_message']= "Register Successful";
                header('Location:login.php');
                exit();
            } else{
                $error_message = "<div class='alert alert-danger'>Registration failed!</div>";
            }
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
            <h2 class="title px-5"><span class="px-2">Kindly register with us</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-5  ">
                <img src="img/cat-2.jpg" alt="">
            </div>
            <div class="col-lg-7 mb-5">
                <form action="" method="post">
                <?php if (isset($error_message)) echo $error_message; ?>
                    <div class="form-floating">
                        <input type="text" name="name" placeholder="First Name*" class="form-control mb-3">
                        <label for="floatingInput" class="px-4">First Name*</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" placeholder="last name*" name="last" class="form-control mb-3">
                        <label for="floatingInput" class="px-4">last name*</label>
                    </div>
                    <div class="form-floating">
                        <input type="email" placeholder="Email Address*" name="email" class="form-control mb-3">
                        <label for="floatingInput" class="px-4">Email Address*</label>
                    </div>
                    <div class="form-floating">
                        <input type="date" name="date" class="form-control mb-3 w-100 px-4">
                    </div>
                    <div class="form-floating">
                       <select name="gender" class="form-control w-100 px-4 mb-3" id="">
                        <option value="" selected disabled>Select your gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">others</option>
                       </select>
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control mb-3 w-100" placeholder="Enter password*">
                        <label for="floatingPassword" class="px-4">Enter password*</label>
                        <i class="bi bi-eye" onclick="togglePassword('password')"></i>
                    </div>
                    <div class="form-floating">
                        <input type="password" name="confirm" class="form-control mb-3 w-100" placeholder="Enter confirm*">
                        <label for="floatingPassword" class="px-4">Enter confirm*</label>
                        <i class="bi bi-eye" onclick="togglePassword('password')"></i>
                    </div>
                   
                    <div class="form-floating">
                        <input type="submit" name="reg" class="submit form-control mb-3 w-100 px-4">
                    </div>
    
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