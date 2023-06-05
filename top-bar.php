<!DOCTYPE html>
<html lang="en">

<!-- ======= Top Bar ======= -->
<section id="topbar" class="d-flex align-items-center"> <!-- Ordenar todo en fila---->
    <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
            <i class="bi bi-envelope d-flex align-items-center"><a
                    href="mailto:lugas2@hotmail.com">lugas2@hotmail.com</a></i>
            <i class="bi bi-phone d-flex align-items-center ms-4"><span>+52 1 951 309 4891</span></i>
        </div>
        <div class="contact-info d-flex align-items-center">
            <i class="bi bi-person-circle d-flex align-items-center ms-4"><span>Bienvenido:
                    <?php if (!empty($_SESSION['cname'])) {
                        echo $_SESSION['cname'] ;
                    } ?>
                </span></i> <!-- span ordena todo en linea---->
        </div>
        <div class="social-links d-none d-md-flex align-items-center"> <!--  Alinear iconos sociales de la derecha  -->
            <a href="https://www.facebook.com/pablo.senashernandez" target="_blank" class="facebook"><i
                    class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/pablosernas/" target="_blank" class="instagram"><i
                    class="bi bi-instagram"></i></a>
        </div>
    </div>
</section><!-- End Top Bar-->
</head>

</html>