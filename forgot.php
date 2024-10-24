<?php
    include 'config.php';
    if(isset($_POST['reg'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
         $error_message ="";
         if($email == ""){
            $error_message = "<div class='alert alert-danger'>Field can't be empty</div>";
         }else{
            $sql = "SELECT * FROM `user` WHERE (`email` = '$email')";
            $query = mysqli_query($con, $sql);
            $count = mysqli_num_rows($query);
            if ($count == 1){
                session_start();
                $_SESSION['log']= $email;
                header('Location:reset.php');
                exit();
            }else{
                 $error_message = "<div class='alert alert-danger'>Email is not recognised!</div>";
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
    <title>forgot password-page</title>
</head>
<body>
    <?php 
    include "header.html";
    ?>
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="title px-5"><span class="px-2">forgot password here</span></h2>
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
                        <input type="submit" value="proceed" name="reg" class="submit form-control mb-3 w-100 px-4">
                    </div>
                  <span><a href="login.php">Go back to login page</a></span>
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