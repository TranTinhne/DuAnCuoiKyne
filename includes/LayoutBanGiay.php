<?php
include 'db_bangiay.inc';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>H&T PARSNEIT SHOSES</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    

    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
        rel="stylesheet">
      
    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/demo.css" rel="stylesheet" type="text/css" >
    <link href="css/jquery.gScrollingCarousel.css" rel="stylesheet" type="text/css" >
    
    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner -->
    <?php include "spinner.php"; ?>

    <!-- Navbar -->
    <?php include "header.php"; ?>
    
    <!-- Main Content -->
    <?php echo $content ?>
    
    <!-- Footer -->
     
    <?php include "footer.php"; ?>
    <div class="script">
        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="path/to/owl.carousel.min.js"></script>
       
        <script type="text/javascript" src="js/kinetic.js"></script>
        <script type="text/javascript" src="js/jquery.final-countdown.js"></script>
        <script type="text/javascript" src="js/unlazy.with-hashing.iife.js"></script>
        <script type="text/javascript" src="js/jquery.gScrollingCarousel.js"></script>

        <!-- Template Javascript -->
        
       <script src="js/script.js"></script>
    </div>
</body>

</html>