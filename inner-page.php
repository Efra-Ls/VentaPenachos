<!DOCTYPE html>
<html lang="en">
<head>
<style>
    .product-image {
      max-width: 300px; /* Cambia este valor al ancho máximo que desees */
      max-height: 300px; /* Cambia este valor a la altura máxima que desees */
      object-fit: cover;
      object-position: center;
    }    
</style>
  <?php
    include('encabezado.php');
    ?>
    <!-- Template Main CSS File -->
 
    


</head>

<body>

  <!-- ======= Top Bar ======= -->
  

  <!-- ======= Header ======= -->
	<?php
  include('menu.php');
  ?>
	<!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Productos&nbsp;</h2>
          <ol>
            <li><a href="index.php">Página Principal</a></li>
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
  

    <!-- FOOTER -->
    <?php
    include('footer.php');
    ?>
   <script src="assets/js/cargarproductos.js"></script>


</body>

</html>