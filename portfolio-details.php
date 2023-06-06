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

  <title>Portfolio Details - Reveal Bootstrap Template</title>
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

  <!-- =======================================================
  * Template Name: Reveal - v4.9.1
  * Template URL: https://bootstrapmade.com/reveal-bootstrap-corporate-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
</head>

<body>

<?php
    include('top-bar.php');
    ?>

  <!-- ======= Header ======= -->
	<?php
  include('menu.php');
  ?>

<script>
    var userid = '<?php echo $_SESSION['id_cliente']; ?>';
    var correoU ='<?php echo $_SESSION['userid']; ?>';
</script>
	<!-- End Header -->
  <script src="assets/js/verMasDetallesProducto.js"></script>
  <main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Detalles del Producto</h2>
          <ol>
            <li><a href="index.php">Página Principal</a></li>
            <li><a href="portfolio.php">Productos</a></li>
            <li>Detalles de Productos</li>
          </ol>
        </div>

      </div>
    </section><!-- Breadcrumbs Section -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-6">

          <div class="col-lg-8">
            <div class="portfolio-details-slider swiper">
                <div  class="swiper-wrapper align-items-center" id="verMasImagenes">                               
                </div>
                <div class="swiper-pagination"></div>
            </div>
          </div>
          

          <div class="col-lg-4">
            <div class="portfolio-info" id="verMasDetalleProductos">
              
            </div>

            <form method="post" id="datosProductoForm">
                <input type="hidden" name="id_producto" id="id_producto" /> 
                <input type="hidden" name="id_carrito" id="id_carrito" />  
                <label class="control-label">Cantidad</label>   
                <input type="number" name="cantidad" id="cantidad" min="1" max="100" required/>           
                <input type="hidden" name="btn_action" id="btn_action" />						
						 </form>
             <input type="submit" name="action" id="action" class="btn btn-primary rounded-0 btn-sm" value="+Agregar al carrito" form="datosProductoForm" 
             <?php
            if (!empty($_SESSION['cname'])) {
              ?>
              
              <?php
            } else {
              ?>
                disabled
              <?php
            }
            ?>
             
             />

            <div class="portfolio-description">
              <h2>Acerca de la elaboracion de nuestros Penachos</h2>
              <p>
                Todos nuestros penachos son elaborados de forma 100% artesanal.
              </p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

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

</body>

</html>