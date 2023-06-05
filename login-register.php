<!DOCTYPE html>
<html lang="es">

<head>
    <?php
    include('encabezado.php');
    ?>
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex justify-content-between">

            <div id="logo">
                <h1><a href="index.php">Arte<span>Plumario</span> </a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html"><img src="assets/img/logo.png" alt=""></a>-->
            </div>
            <nav id="navbar" class="navbar">
            </nav><!-- .navbar -->

        </div>

    </header><!-- End Header -->


    <!-- End Header -->



    <main id="main">


        <section id="portfolio" class="portfolio">

            <div class="login-register-area pt-100 pb-100">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                            <div class="login-register-wrapper">
                                <div class="login-register-tab-list nav">
                                    <a class="active" data-toggle="tab" href="#lg1">
                                        <h4> Iniciar sesión </h4>
                                    </a>
                                    <a data-toggle="tab" href="#lg2">
                                        <h4> Regístrate </h4>
                                    </a>
                                </div>
                                <div class="tab-content">
                                    <div id="lg1" class="tab-pane active">
                                        <div class="login-form-container">
                                            <div class="login-register-form">
                                                <form action="#" method="post">
                                                    <input type="text" name="user-name" placeholder="Usuario">
                                                    <input type="password" name="user-password" placeholder="Contraseña">
                                                    <div class="button-box">
                                                        <div class="login-toggle-btn">
                                                            <input type="checkbox">
                                                            <label>Recordarme</label>
                                                            <a href="#">¿Olvido su contraseña?</a>
                                                        </div>
                                                        <button type="submit"><span>Iniciar sesión</span></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="lg2" class="tab-pane">
                                        <div class="login-form-container">
                                            <div class="login-register-form">
                                                <form action="#" method="post">
                                                    <input type="text" name="user-name" placeholder="Usuario">
                                                    <input type="password" name="user-password" placeholder="Contraseña">
                                                    <input name="user-email" placeholder="Email" type="email">
                                                    <div class="button-box">
                                                        <button type="submit"><span>Registrar</span></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container d-flex justify-content-between">

            <div id="logo">
                <h10>.</h10>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html"><img src="assets/img/logo.png" alt=""></a>-->
            </div>
            <nav id="navbar" class="navbar">
            </nav><!-- .navbar -->

        </div>
    </main><!-- End #main -->


    <!-- FOOTER -->
    <?php
    include('footer.php');
    ?>

</body>

</html>