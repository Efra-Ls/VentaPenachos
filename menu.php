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
			
          <li><a class="nav-link scrollto active" href="#hero">Principal</a></li>
          <li><a class="nav-link scrollto" href="#about">Quienes Somos</a></li>          
          <li><a class="nav-link scrollto" href="#team">Equipo</a></li>
          <li><a class="nav-link scrollto" href="#testimonials">Testimonios&nbsp;</a></li>          
          <li><a class="nav-link scrollto " href="inner-page.php">Productos</a></li>   
          <li><a class="nav-link scrollto" href="#contact">Contactanos</a></li>
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
    
  </header><!-- End Header -->
  
