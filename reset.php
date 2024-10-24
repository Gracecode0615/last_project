<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!--Bootstrap Stylesheet -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css
     ">
     <link rel="stylesheet" href="css/style.css">
    <title>Reset password-page</title>
</head>
<body>
    <?php 
    include "header.html";
    ?>
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="title px-5"><span class="px-2">Reset password here</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-5  ">
                <img src="img/cat-2.jpg" alt="">
            </div>
            <div class="col-lg-7 mb-5">
                <form action="" method="post">
                <?php if (isset($error_message)) echo $error_message; ?>
                    <div class="form-floating">
                        <input type="email" placeholder="New password*" name="password1" class="form-control mb-3">
                        <label for="floatingInput" class="px-4">New password*</label>
                        <i class="bi bi-eye" onclick="togglePassword('password')"></i>
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password2" class="form-control mb-3 w-100" placeholder="Confirm password*">
                        <label for="floatingPassword" class="px-4">Confirm password*</label>
                        <i class="bi bi-eye" onclick="togglePassword('password')"></i>
                    </div>
                    <div class="form-floating">
                        <input type="submit" name="reg" class="submit form-control mb-3 w-100 px-4">
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