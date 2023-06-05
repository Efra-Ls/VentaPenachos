<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center">
  <div class="container d-flex justify-content-between">

    <div id="logo">
      <h1><a href="index.php">Arte<span>Plumario</span> </a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html"><img src="assets/img/logo.png" alt=""></a>-->
    </div>

    <nav id="navbar" class="navbar">
      <ul>
        <li><a class="nav-link scrollto" href="index.php#hero">Principal</a></li>
        <li><a class="nav-link scrollto" href="index.php#about">Quiénes Somos</a></li>
        <li><a class="nav-link scrollto" href="index.php#team">Equipo</a></li>
        <li><a class="nav-link scrollto" href="index.php#testimonials">Testimonios&nbsp;</a></li>        
        <li><a class="nav-link scrollto" href="index.php#contact">Contáctanos</a></li>
        <li><a class="nav-link scrollto" href="inner-page.php">Productos</a></li>
        <li><a class="nav-link scrollto" href="carrito.php"><span></span> <i class="bi bi-cart3"></i></a></li>

        

        <li class="dropdown"><a href="#"><span></span> <i class="bi bi-person-circle"></i></a>
          <ul>
            <li><a class="nav-link scrollto" href="usuario.php">Mi cuenta</a></li>
            <li><a class="nav-link scrollto" href="carrito.php">Carrito</a></li>
            <li><a class="nav-link scrollto" href="pagar.php">Pagar</a></li>
            <li><a class="nav-link scrollto" href="misCompras.php">Mis compras</a></li>
            <?php
            if (!empty($_SESSION['cname'])) {
              ?>
              <li><a class="nav-link scrollto" href="adm/login.php">Salir</a></li>
              <?php
            } else {
              ?>
              <li><a class="nav-link scrollto" href="adm/login.php">Ingresar</a></li>
              <?php
            }
            ?>
          </ul>
      </ul>
      
    </nav><!-- .navbar -->

  </div>

</header><!-- End Header -->