<?php
include('encabezado.php');
?>

<body>
<!-- ======= Top Bar ======= -->
<section id="topbar" class="d-flex align-items-center"> <!-- Ordenar todo en fila---->
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:lugas2@hotmail.com">lugas2@hotmail.com</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+52 1 951 309 4891</span></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>   Bienvenido : <?php if (!empty($_SESSION['cname'])) { echo $_SESSION['cname']; }?></span></i>  <!-- span ordena todo en linea---->
      </div>
      <div class="social-links d-none d-md-flex align-items-center">  <!--  Alinear iconos sociales de la derecha  -->
        <a href="https://www.facebook.com/pablo.senashernandez" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="https://www.instagram.com/pablosernas/" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
       
      </div>
    </div>
  </section><!-- End Top Bar-->
  
    

  <!-- ======= hero Section ======= -->
       <!-- ======= hero Section ======= -->
  <section id="hero">
          
    <div class="hero-slider swiper">
      <div class="swiper-wrapper">
      <div class="swiper-slide" style="background-image: url('assets/img/hero-carousel/img2.jpeg');"></div>
        <div class="swiper-slide" style="background-image: url('assets/img/hero-carousel/img11.jpeg');"></div>              
        <div class="swiper-slide" style="background-image: url('assets/img/hero-carousel/img4.jpeg');"></div>    
        <div class="swiper-slide" style="background-image: url('assets/img/hero-carousel/img5.jpeg');"></div>  
        <div class="swiper-slide" style="background-image: url('assets/img/hero-carousel/img6.jpeg');"></div> 
        <div class="swiper-slide" style="background-image: url('assets/img/hero-carousel/img7.jpeg');"></div> 
        <div class="swiper-slide" style="background-image: url('assets/img/hero-carousel/img8.jpeg');"></div> 
        <div class="swiper-slide" style="background-image: url('assets/img/hero-carousel/img9.jpeg');"></div>  
        <div class="swiper-slide" style="background-image: url('assets/img/hero-carousel/img10.jpeg');"></div>    
      </div>
    </div>
  </section><!-- End Hero Section -->
  


  <?php
    include('menu.php');
    ?>
    <section id="portfolio" class="portfolio" style="padding: 1px; margin: 1px;">
      <div class="container" data-aos="fade-up" style="padding: 1px; ">
        <div class="section-header" style="padding: 1px; margin: 1px;">
          <div id="hero" style="padding: 1px;">
            <blockquote   class="hero-content" id="hero-content" style="padding: 1px; margin: 1px;">    
              <h2 >Elaboracion de <span >Penachos</span> para Danza de la Pluma</h2>
            </blockquote>
          </div>
         </div>
      </div>
    </section>
  <main id="main">

    <!-- ======= About Section ======= -->    <!-- End About Section -->

    <!-- ======= Services Section ======= --><!-- End Services Section -->

    <!-- ======= Clients Section ======= -->    <!-- End Clients Section -->

    <!-- ======= Portfolio Section ======= -->    <!-- End Portfolio Section -->

    <!-- ======= Testimonials Section ======= -->    <!-- End Testimonials Section -->

    <!-- ======= Call To Action Section ======= -->
    
    <section id="portfolio" class="portfolio">
      <div class="container" data-aos="fade-up">
        <div class="section-header">

      <div>
  
          <blockquote>
            <h2>lo más vendido&nbsp; &nbsp;</h2>
          </blockquote>
			
        </div>
		  
<div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
  <div class="col-lg-4 col-md-6 portfolio-item filter-app"> <img src="assets/img/portfolio/producto2.jpeg" class="img-fluid" alt="">
    <div class="portfolio-info">
      <h4>Penacho Nacional</h4>
      <p>Penachos</p>
      <a href="assets/img/portfolio/producto2.jpeg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 2"><i class="bx bx-plus"></i></a> <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a></div>
  </div>
  <div class="col-lg-4 col-md-6 portfolio-item filter-web"> <img src="assets/img/portfolio/producto5.jpeg" class="img-fluid" alt="">
          <div class="portfolio-info">
              <h4>Penachitos Decorativos</h4>
              <p>Accesorios</p>
              <a href="assets/img/portfolio/producto5.jpeg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3"><i class="bx bx-plus"></i></a> <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a></div>
          </div>
	<div class="col-lg-4 col-md-6 portfolio-item filter-app"> <img src="assets/img/portfolio/producto3.jpeg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Penacho 3</h4>
              <p>Penachos</p>
              <a href="assets/img/portfolio/producto3.jpeg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 3"><i class="bx bx-plus"></i></a> <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a></div>
        </div>
</div>
		  
		  <a href="inner-page.php"  class="button button1">VER TODOS LOS PRODUCTOS</a>
      </div>
    </section>
    <section id="call-to-action"> 	
  <section id="about">
      <div class="container" data-aos="fade-up">
          <div class="row">
            <div class="col-lg-6 about-img"> <img src="assets/img/about2.jpeg" alt=""> </div>
            <div class="col-lg-6 content">
            <div class="colorb">
              <h2 class="colorb">Nuestra Historia y Filosofia</h2>
              <div class="col-lg-6 content">
              <h3>Somos un grupo de Artesanos originarios del estado de Oaxaca,Mex. de un pueblo magico llamado San Jeronimo Tlacochahuaya, con mas de 20 años de experiencia realizando penachos para los danzantes de nuestro estado con la finalidad de conservar nuestras bellas costrumbres y tradiciones heredadas por nuestros ancestros de pueblos Zapotecos indigenas.Expandimos nuestra cultura a paises como lo son: </h3>
              <ul>
                <li><i class="bi bi-check-circle"></i> (USA) Estados Unidos </li>
                <li><i class="bi bi-check-circle"></i> España</li>
                <li><i class="bi bi-check-circle"></i> Colombia</li>
              </ul>
            </div>
          </div>
        </div>
      </section>
      <div class="container" data-aos="zoom-out">
        <div class="row">
          <div class="col-lg-9 text-center text-lg-start"> </div>
          <div class="col-lg-3 cta-btn-container text-center"> </div>
        </div>
      </div>
  </section><!-- End Call To Action Section -->

    <!-- ======= Team Section ======= -->   
	  <section id="team">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Nuestro Equipo</h2>
        </div>
<div class="row">
          <div class="col-lg-3 col-md-6">
            <div class="member"> 	
              <div class="pic"><img src="assets/img/pablo.jpeg" alt=""></div>
              <div class="details">
                <h4>Pablo Sernas</h4>
                <span>Artesano Administrador</span>
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href="https://www.facebook.com/pablo.senashernandez/map" target="_blank"><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                </div>
              </div>
            </div>
          </div>

  <div class="col-lg-3 col-md-6">
            <div class="member">
              <div class="pic"><img src="assets/img/carlos.jpeg" alt=""></div>
              <div class="details">
                <h4>Carlos Sernas</h4>
                <span>Artesano</span>
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href="https://www.facebook.com/photo/?fbid=564500705367067&set=a.113524210464721"><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>
</div>
  
    <!-- =======  Section ======= -->
    <section id="testimonials">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Testimonios</h2>
          <p>He aqui algunas referencias de nuestros clientes respecto a nuestro trabajo:</p>
        </div>
        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="testimonial-item">
                <p> <img src="assets/img/quote-sign-left.png" class="quote-sign-left" alt=""> Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper. <img src="assets/img/quote-sign-right.png" class="quote-sign-right" alt=""> </p>
                <img src="assets/img/testimonial-1.jpg" class="testimonial-img" alt="">
                +
              </div>
            </div>
            <!-- End testimonial item -->
            <div class="swiper-slide">
              <div class="testimonial-item">
                <p> <img src="assets/img/quote-sign-left.png" class="quote-sign-left" alt=""> Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa. <img src="assets/img/quote-sign-right.png" class="quote-sign-right" alt=""> </p>
                <img src="assets/img/testimonial-2.jpg" class="testimonial-img" alt="">
                <h3>Sara Wilsson</h3>
                <h4>Designer</h4>
              </div>
            </div>
            <!-- End testimonial item -->
            <div class="swiper-slide">
              <div class="testimonial-item">
                <p> <img src="assets/img/quote-sign-left.png" class="quote-sign-left" alt=""> Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim. <img src="assets/img/quote-sign-right.png" class="quote-sign-right" alt=""> </p>
                <img src="assets/img/testimonial-3.jpg" class="testimonial-img" alt="">
                <h3>Jena Karlis</h3>
                <h4>Store Owner</h4>
              </div>
            </div>
            <!-- End testimonial item -->
            <div class="swiper-slide">
              <div class="testimonial-item">
                <p> <img src="assets/img/quote-sign-left.png" class="quote-sign-left" alt=""> Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam. <img src="assets/img/quote-sign-right.png" class="quote-sign-right" alt=""> </p>
                <img src="assets/img/testimonial-4.jpg" class="testimonial-img" alt="">
                <h3>Matt Brandon</h3>
                <h4>Freelancer</h4>
              </div>
            </div>
            <!-- End testimonial item -->
            <div class="swiper-slide">
              <div class="testimonial-item">
                <p> <img src="assets/img/quote-sign-left.png" class="quote-sign-left" alt=""> Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid. <img src="assets/img/quote-sign-right.png" class="quote-sign-right" alt=""> </p>
                <img src="assets/img/testimonial-5.jpg" class="testimonial-img" alt="">
                <h3>John Larson</h3>
                <h4>Entrepreneur</h4>
              </div>
            </div>
            <!-- End testimonial item -->
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </section>
    <section id="contact">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Contactanos</h2>
          <p>Para una comunicacion mas directa puede encontrarnos mediante los medios:</p>
        </div>

        <div class="row contact-info">

          <div class="col-md-4">
            <div class="contact-address">
              <i class="bi bi-geo-alt"></i>
              <h3>Direccion</h3>
              <address>
              Benito Juarez, Hidalgo, Tlacochahuaya, Oax.
              </address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="bi bi-phone"></i>
              <h3>Telefono</h3>
              <p><a href="tel:+155895548855">+52 1 951 309 4891</a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="bi bi-envelope"></i>
              <h3>Email</h3>
              <p><a href="mailto:lugas2@hotmail.com">lugas2@hotmail.com</a></p>
            </div>
          </div>

        </div>
      </div>

      <div class="container mb-4">
		  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6478.523719162664!2d-96.58835750105007!3d17.006960075249836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85c725576eb4996f%3A0xab705efc5fadd0fe!2sTortiller%C3%ADa%20El%20milagro!5e0!3m2!1ses-419!2smx!4v1668025727193!5m2!1ses-419!2smx"  width="100%" height="380" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>

      <div class="container">
        <div class="form">
          <form action="forms/contact.php" method="post" role="form" class="php-email-form">
            <div class="row">
              <div class="form-group col-md-6">
                <input type="text" name="name" class="form-control" id="name" placeholder="Nombre" required>
              </div>
              <div class="form-group col-md-6 mt-3 mt-md-0">
                <input type="email" class="form-control" name="email" id="email" placeholder="Direccion de Correo" required>
              </div>
            </div>
            <div class="form-group mt-3">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Asunto" required>
            </div>
            <div class="form-group mt-3">
              <textarea class="form-control" name="message" rows="5" placeholder="Escribir mensaje" required></textarea>
            </div>

            <div class="my-3">
              <div class="loading">Espere un momento...</div>
              <div class="error-message"></div>
              <div class="sent-message">Su mensaje ha sido enviado, espere la respuesta de nuestro encargado. ¡Gracias!</div>
            </div>
</form>
        </div>

      </div>
    </section><!-- End Contact Section -->
</div>
    </section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>Arte Plumario</strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
        All the links in the footer should remain intact.
        You can delete the links only if you purchased the pro version.
        Licensing information: https://bootstrapmade.com/license/
        Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Reveal
      -->
        Designed by <a href="">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->
<div class="container">
		<!-- (p>lorem)*20 (código a usar si tienes instalada la extensión emmet)-->
	</div>

	<div class= "back-to-top">
		<a href="https://www.facebook.com/pablo.senashernandez"><img src="assets/img/facebook.svg" alt="facebook"></a>
		<a href="https://www.instagram.com/pablosernas/"><img src="assets/img/instagram-custom.svg" alt="instagram"> 	</a>	  
		<a href="https://wa.me/5219514709685?text=Informes+de+penacho"><img src="assets/img/whatsapp-custom.svg" alt="whatsapp"></a>
		<a href="#"><img src="assets/img/line-dotted.png" alt="line"></a>
		<a href="#"><img src="assets/img/arrow-up-circle-fill-custom.svg" alt="flecha"></a>
	  </div>
	  
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