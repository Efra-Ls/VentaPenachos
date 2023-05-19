<!DOCTYPE html>
<html lang="en">
<head>
<?php
ob_start();
session_start();
include 'adm/Inventory.php';
$inventory = new Inventory();
?>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Inner Page - Reveal Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  
  
  <!-- =======================================================
  * Template Name: Reveal - v4.9.1
  * Template URL: https://bootstrapmade.com/reveal-bootstrap-corporate-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
    .product-image {
      max-width: 300px; /* Cambia este valor al ancho máximo que desees */
      max-height: 300px; /* Cambia este valor a la altura máxima que desees */
      object-fit: cover;
      object-position: center;
    }
</style>
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-flex align-items-center"> <!-- Ordenar todo en fila---->
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"> <a href="mailto:lugas2@hotmail.com"> lugas2@hotmail.com</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+52 1 951 309 4891</span></i>  <!-- span ordena todo en linea---->
      </div>
      <div class="social-links d-none d-md-flex align-items-center">  <!--  Alinear iconos sociales de la derecha  -->
        <a href="https://www.facebook.com/pablo.senashernandez" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="https://www.instagram.com/pablosernas/" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
       
      </div>
    </div>
  </section><!-- End Top Bar-->

  <!-- ======= Header ======= -->
	
<header id="header" class="d-flex align-items-center">
    <div class="container d-flex justify-content-between">

      <div id="logo">
        <h1><a href="index.php">Arte<span>Plumario</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt=""></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="index.php">Principal</a></li>
          <li><a class="nav-link scrollto" href="index.php#about">Quienes Somos</a></li>
          <li><a class="nav-link scrollto " href="index.php#portfolio">Productos</a></li>
          
          <li><a class="nav-link scrollto" href="index.php#team">Equipo</a></li>
          <li><a class="nav-link scrollto" href="index.php#testimonials">Testimonios&nbsp;</a></li>
          
          
          <li><a class="nav-link scrollto" href="index.php#contact">Contactanos</a></li>
          <?php
          if (!empty($_SESSION['name'])) {
        ?>
            <li><a class="nav-link scrollto" href="adm/login.php">Salir</a></li>
          <?php
             }else{              
          ?>
          <li><a class="nav-link scrollto" href="adm/login.php">Ingresar</a></li>
          <?php
             }
          ?>
         
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header>
	<!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Productos&nbsp;</h2>
          <ol>
            <li><a href="index.php">Pagina Principal</a></li>
            <li>Productos</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs Section -->

    
    <!-- ======= Team Section ======= -->
	  <section id="portfolio" class="portfolio">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Nuestra Colección</h2>
          <p>Productos elaborados a mano 100% de manera artesanal.</p>
        </div>
        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">Todos</li>
              <li data-filter=".filter-app">Penachos</li>
              <li data-filter=".filter-card">Accesorio</li>
              <li data-filter=".filter-web">Decoración</li>
            </ul>
          </div>
        </div>        
        <div id="viewproductList" class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

        </div>        
      </div>    
    </section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>Reveal</strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
        All the links in the footer should remain intact.
        You can delete the links only if you purchased the pro version.
        Licensing information: https://bootstrapmade.com/license/
        Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Reveal
      -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  


  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/cargarproductos.js"></script>

</body>

</html>