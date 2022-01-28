<?php
session_start();
if(!isset($_SESSION['lecturer'])){
    header("location: ../login");
}else{?>
<!DOCTYPE html>
<html  >
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/uniabuja-logo.jpg" type="image/x-icon">
  <meta name="description" content="">
  
  
  <title>Lecturer Dashboard</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons2/mobirise2.css">
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
  
  <section data-bs-version="5.1" class="menu menu2 cid-sSmm2DC6ND" once="menu" id="menu2-3">
    
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
                    <li class="nav-item"><a class="nav-link link text-black text-primary display-4" href="">News</a></li>
                    <li class="nav-item"><a class="nav-link link text-black text-primary display-4" href="">About</a>
                    </li></ul>
                <?php
                    if(isset($_SESSION['lecturer'])){?>
                        <div class="navbar-buttons mbr-section-btn"><a class="btn btn-danger display-4" href="signout">Logout</a></div>
                    <?php }else{ ?>
                        <div class="navbar-buttons mbr-section-btn"><a class="btn btn-danger display-4" href="">Contact Us</a></div>
                    <?php }
                ?>
            </div>
        </div>
    </nav>
</section>

<section data-bs-version="5.1" class="info3 cid-sSmOFFJJ19" id="info3-7">

    

    <div class="mbr-overlay" style="opacity: 0.8; background-color: rgb(0, 166, 80);">
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-12 col-lg-10">
                <div class="card-wrapper">
                    <div class="card-box align-center">
                        <h4 class="card-title mbr-fonts-style align-center mb-4 display-1">
                            <strong>Lecturer Dashboard</strong></h4>
                        <h3><strong>Welcome <?php if(isset($_SESSION['lecturer'])){echo "".$_SESSION['name']."";} ?></strong></h3>
                        <p class="mbr-text mbr-fonts-style mb-4 display-7">Manage profile, manage courses, view timetable</p>
                        <div class="mbr-section-btn mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="features1 cid-sSmR6vt9Df" id="features1-e">
    

    
    <div class="container">
        <div class="row">
            
        </div>
        <div class="row">
            <div class="card col-12 col-md-6 col-lg-3">
                <div class="card-wrapper">
                    <div class="card-box align-center">
                        <div class="iconfont-wrapper">
                            <span class="mbr-iconfont mobi-mbri-users mobi-mbri"></span>
                        </div>
                        <h5 class="card-title mbr-fonts-style display-7"><strong>Profile</strong></h5>
                        <p class="card-text mbr-fonts-style display-7">
                            View and edit your profile.
                        </p>
                        <div class="mbr-section-btn mt-3"><a class="btn btn-black display-4" href="profile">Manage</a></div>
                    </div>
                </div>
            </div>
            <div class="card col-12 col-md-6 col-lg-3">
                <div class="card-wrapper">
                    <div class="card-box align-center">
                        <div class="iconfont-wrapper">
                            <span class="mbr-iconfont mobi-mbri-bulleted-list mobi-mbri"></span>
                        </div>
                        <h5 class="card-title mbr-fonts-style display-7"><strong>Courses</strong></h5>
                        <p class="card-text mbr-fonts-style display-7">
                            View and add list of courses offered by 300 and 400 level for first and second semester.
                        </p>
                        <div class="mbr-section-btn mt-3"><a class="btn btn-black display-4" href="courses">View</a><a class="btn btn-danger display-4" href="add-courses">Add</a></div>
                    </div>
                </div>
            </div>
            <div class="card col-12 col-md-6 col-lg-3">
                <div class="card-wrapper">
                    <div class="card-box align-center">
                        <div class="iconfont-wrapper">
                            <span class="mbr-iconfont mobi-mbri-calendar mobi-mbri"></span>
                        </div>
                        <h5 class="card-title mbr-fonts-style display-7"><strong>View timetable</strong></h5>
                        <p class="card-text mbr-fonts-style display-7">
                            Allot courses to teachers
                        </p>
                        <div class="mbr-section-btn mt-3"><a class="btn btn-black display-4" href="generate-timetable">Enter</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><section style="background-color: #fff; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif; color:#aaa; font-size:12px; padding: 0; align-items: center; display: flex;"><a href="" style="flex: 1 1; height: 3rem; padding-left: 1rem;"></a><p style="flex: 0 0 auto; margin:0; padding-right:1rem;"><a href="https://mobirise.site/s" style="color:#aaa;"></a></p></section><script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>  <script src="assets/smoothscroll/smooth-scroll.js"></script>  <script src="assets/ytplayer/index.js"></script>  <script src="assets/dropdown/js/navbar-dropdown.js"></script>  <script src="assets/theme/js/script.js"></script>  
  
  
</body>
</html>
<?php }?>