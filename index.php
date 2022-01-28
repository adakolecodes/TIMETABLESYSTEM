<?php
session_start();

if (isset($_GET['generated']) && $_GET['generated'] == "false") {
    unset($_GET['generated']);
    echo '<script>alert("Timetable not generated yet!!");</script>';
}
?>

<!DOCTYPE html>
<html  >
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/uniabuja-logo.jpg" type="image/x-icon">
  <meta name="description" content="">
  
  
  <title>Login</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/socicon/css/styles.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,400;0,700;1,400;1,700&display=swap&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,400;0,700;1,400;1,700&display=swap&display=swap"></noscript>
  <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  
  
  
  
</head>
<body>
  
  <section data-bs-version="5.1" class="menu menu2 cid-sSmm2DC6ND" once="menu" id="menu2-0">
    
    <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
        <div class="container">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    
                        <img src="assets/images/uniabuja-logo.jpg" alt="" style="height: 3rem;">
                    
                </span>
                
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-toggle="collapse" data-target="#navbarSupportedContent" data-bs-target="#navbarSupportedContent" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true"><li class="nav-item"><a class="nav-link link text-black text-primary display-4" href="https://www.uniabuja.edu.ng/" target="_blank">Home</a></li>
                    <li class="nav-item"><a class="nav-link link text-black text-primary display-4" href="">Courses</a></li>
                    <li class="nav-item"><a class="nav-link link text-black text-primary display-4" href="">About</a>
                    </li></ul>
                
                <div class="navbar-buttons mbr-section-btn"><a class="btn btn-danger display-4" href="">Contact Us</a></div>
            </div>
        </div>
    </nav>
</section>

<section data-bs-version="5.1" class="form4 cid-sSmm6UD4PO mbr-fullscreen" id="form4-1">

    

    

    <div class="container-fluid">
        <div class="row content-wrapper justify-content-center">
            <div class="col-lg-3 offset-lg-1 mbr-form">
                <form action="adminFormvalidation.php" method="POST" class="mbr-form form-with-styler">
                    <div class="dragArea row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h1 class="mbr-section-title mb-4 display-2"><strong>Timetable System</strong></h1>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <p class="mbr-text mbr-fonts-style mb-4 display-7">Computer Science Department, University of Abuja</p>
                        </div>
                        <?php
                            if(isset($_SESSION['error'])){
                                echo "<p style='color:red'>".$_SESSION['error']."</p>";
                                unset($_SESSION["error"]);
                            }
                        ?>
                        <div class="col-lg-12 col-md col-12 form-group mb-3">
                            <input type="text" name="UN" placeholder="Username" class="form-control" id="adminname" maxlength="10" required>
                        </div>
                        <div class="col-lg-12 col-md col-12 form-group mb-3">
                            <input type="password" name="PASS" placeholder="Password"class="form-control" id="password" maxlength="10" required>
                        </div>
                        <div class="col-12 col-md-auto mbr-section-btn"><button type="submit" name="LOGIN" class="btn btn-danger display-4">Login to dashboard</button></div>
                    </div>
                </form>
            </div>
            <div class="col-lg-7 offset-lg-1 col-12">
                <div class="image-wrapper">
                    <img class="w-100" src="assets/images/header-img.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
    </section><section style="background-color: #fff; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif; color:#aaa; font-size:12px; padding: 0; align-items: center; display: flex;"><a href="" style="flex: 1 1; height: 3rem; padding-left: 1rem;"></a><p style="flex: 0 0 auto; margin:0; padding-right:1rem;"><a href="https://mobirise.site/r" style="color:#aaa;"></a></p></section><script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>  <script src="assets/smoothscroll/smooth-scroll.js"></script>  <script src="assets/ytplayer/index.js"></script>  <script src="assets/dropdown/js/navbar-dropdown.js"></script>  <script src="assets/theme/js/script.js"></script>  

  
</body>
</html>