<!DOCTYPE html>
<html lang="es">

<head>
    <?php
    ob_start();
    session_start();
    include 'adm/Inventory.php';
    $inventory = new Inventory();
    ?>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Usuario</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/icons.min.css">
  
</head>
    

<body>

<?php
  include('top-bar.php');
  ?>

    <!-- ======= Header ======= -->
    <?php
    include('menu.php');
    ?>
    <!-- End Header -->
    <script>
    var userid = '<?php echo $_SESSION['id_cliente']; ?>';
    var correoU ='<?php echo $_SESSION['userid']; ?>';
</script>
    <main id="main">
    
        <!-- ======= Breadcrumbs Section ======= -->
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Cuenta</h2>
                    <h2>&nbsp;</h2>
                    <ol>
                        <li><a href="index.php">Página Principal</a></li>
                        <li>Cuenta</li>
                    </ol>
                </div>
            </div>
        </section><!-- End Breadcrumbs Section -->

        <div id="successMessage" class="modal">
		
        <div class="modal-dialog modal-dialog-centered  rounded-0">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <button type="button" class="btn-close text-xs" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                    <div class="container-fluid">
                        <div class="mb-3">
                                <label class="control-label">Registrado correctamente</label>
                                
                            </div>
                        
                    </div>
                    </div>

                    <div class="modal-footer">							
                    </div>					
                </div>
        </div>
  
    </div>
        <!-- ======= Team Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="container">
                <div class="row">
                    <div class="ml-auto mr-auto col-lg-9 offset-xl-2">
                        <div class="checkout-wrapper">
                            <div id="faq" class="panel-group">
                                <div class="panel panel-default single-my-account">
                                    <div class="panel-heading my-account-title">
                                        <h3 class="panel-title"><span>1 .</span> <a data-toggle="collapse"
                                                data-parent="#faq" href="#my-account-1">EDITE LA INFORMACIÓN DE sU
                                                CUENTA&nbsp; </a></h3>
                                    </div>
                                    <div id="my-account-1" class="panel-collapse collapse show">
                                        <div class="panel-body">
                                            <div class="myaccount-info-wrapper">
                                                <div class="account-info-wrapper">
                                                    <h4>INFORMACIÓN DE MI CUENTA</h4>
                                                    <h5>Sus detalles personales</h5>
                                                </div>
                                                <div class="row">                                               
                                                    <form method="post" id="datosPersonalesForm">
                                                        <input type="hidden" name="userid" id="userid" />
                                                        <input type="hidden" name="btn_action" id="btn_action" />
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="billing-info">
                                                                <label >Nombre<label class="camposRojos">*</label>&nbsp;</label>
                                                                <input type="text"  name="cnombre" id="cnombre" class="form-control rounded-0" required pattern="[A-Za-z ]+" title="Este solo acepta letras y espacios." />
									                            <div id="nombreError" class="error-message" style="display: none;"> <label class="camposRojos">Complete este campo.</label></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="billing-info">
                                                                <label>Domicilio<label class="camposRojos">*</label>&nbsp;</label>
                                                                <input type="text" name="domicilio" id="domicilio" class="form-control rounded-0" required />
									                            <div id="domicilioError" class="error-message" style="display: none;"> <label class="camposRojos">Complete este campo.</label></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="billing-info">
                                                                <label>Dirección De Correo Electrónico<label class="camposRojos">*</label>&nbsp;</label>
                                                                <input type="email" name="correo" id="correo" class="form-control rounded-0" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Por favor ingrese una dirección de correo válida." ></input>
									                            <div id="correoError" class="error-message" style="display: none;"> <label class="camposRojos">Complete este campo.</label></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="billing-info">
                                                                <label>Teléfono<label class="camposRojos">*</label></label>
                                                                <input type="text" name="telefono" id="telefono" class="form-control rounded-0" required pattern="[0-9]{10}" maxlength="10" title="Este campo no acepta letras."/>
									                            <div id="telefonoError" class="error-message" style="display: none;"> <label class="camposRojos">Complete este campo.</label></div>
									                            <div id="telefonoErrorCorto" class="error-message" style="display: none;"><label class="camposRojos">El telefono no es correcto</label></div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                
                                                </div>
                                                <div class="billing-back-btn">
                                                    <div class="billing-back">
                                                        <a href="#"><i class="fa fa-arrow-up"></i> ATRÁS</a>
                                                    </div>
                                                    <label class="camposRojos">* Campos obligatorios</label>
                                                    <div class="billing-btn">
                                                    <button type="submit" name="action" id="action" class="btn btn-sm rounded-0 btn-primary" form="datosPersonalesForm">Guardar</button>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default single-my-account">
                                    <div class="panel-heading my-account-title">
                                        <h3 class="panel-title"><span>2 .</span> <a data-toggle="collapse"
                                                data-parent="#faq" href="#my-account-2">CAMBIAR CONTRASEÑA </a></h3>
                                    </div>
                                    <div id="my-account-2" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="myaccount-info-wrapper">
                                                <div class="account-info-wrapper">
                                                    <h4>CAMBIAR CONTRASEÑA</h4>
                                                    <h5>Tu contraseña</h5>
                                                </div>
                                                <div class="row">
                                                    <form method="post" id="datosContrasenaForm">
                                                            <input type="hidden" name="contrasenia" id="contrasenia" />
                                                            <input type="hidden" name="correoU" id="correoU" />
                                                            <input type="hidden" name="btn_actionC" id="btn_actionC" />
                                                            <div class="col-lg-6 col-md-6">
                                                                <div class="billing-info">
                                                                    <label>Contraseña anterior<label class="camposRojos">*</label></label>
                                                                    <input type="password" class="form-control rounded-0" id="passwordAnt" name="passwordAnt" placeholder="Contraseña anterior" required>
									                                <div id="antcontraError" class="error-message" style="display: none;"> <label class="camposRojos">Complete este campo.</label></div>

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6">
                                                                <div class="billing-info">
                                                                    <label>Nueva contraseña<label class="camposRojos">*</label></label>
                                                                    <input type="password" class="form-control rounded-0" id="passwordR" name="passwordR" placeholder="Contraseña nueva" required>
									                                <div id="contraError" class="error-message" style="display: none;"> <label class="camposRojos">Complete este campo.</label></div>
									                                <div id="contraSeguridad" class="password-strength" style="display: none;"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6">
                                                                <div class="billing-info">
                                                                    <label>Confirmar Contraseña<label class="camposRojos">*</label></label>
                                                                    <input type="password" class="form-control rounded-0" id="confirmPassword" name="confirmPassword" placeholder="Confirmar contraseña" required>
									                                <div id="ccontraError" class="error-message" style="display: none;"> <label class="camposRojos">Complete este campo.</label></div>
                                                                </div>
                                                            </div>
                                                    </form>
                                                </div>
                                                <div class="billing-back-btn">
                                                    <div class="billing-back">
                                                        <a href="#"><i class="fa fa-arrow-up"></i> ATRÁS</a>
                                                    </div>
                                                    <label class="camposRojos">* Campos obligatorios</label>
                                                    <div class="billing-btn">
                                                    <button type="submit" name="action" id="action" class="btn btn-sm rounded-0 btn-primary" form="datosContrasenaForm">Guardar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default single-my-account">
                                    <div class="panel-heading my-account-title">
                                        <h3 class="panel-title"><span>3 .</span> <a data-toggle="collapse"
                                                data-parent="#faq" href="#my-account-3">Modifique su direccion para sus
                                                pedidos </a></h3>
                                    </div>
                                    <div id="my-account-3" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="myaccount-info-wrapper">
                                                <div class="account-info-wrapper">
                                                    <h4>Mi direccion</h4>
                                                </div>
                                                <div class="entries-wrapper">
                                                    <div class="row">

                                                        <div
                                                            class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center">
                                                            <div >
                                                                <form method="post" id="domicilioForm">
                                                                    <input type="hidden" name="id_clienteD" id="id_clienteD" />
                                                                    <input type="hidden" name="btn_actionD" id="btn_actionD" />
                                                                <label>Escriba su domicilio<label class="camposRojos">*</label></label>
                                                                    <textarea class="entries-info text-center" name="domicilio2" id="domicilio2" required ></textarea>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center">
                                                            <div class="entries-edit-delete text-center">
                                                           
                                                                 <div class="billing-btn">
                                                                    <button type="submit" name="action" id="action" class="btn btn-sm rounded-0 btn-primary" form="domicilioForm">Guardar</button>
                                                                 </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="billing-back-btn">
                                                    <div class="billing-back">
                                                        <a href="#"><i class="fa fa-arrow-up"></i> ATRÁS</a>
                                                    </div>
                                                    <label class="camposRojos">* Campos obligatorios</label>
                                                    <div class="billing-btn">
                                                    <button id="btnGoogleMaps">Abrir Google Maps</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default single-my-account">
                                    <div class="panel-heading my-account-title">
                                    <h3 class="panel-title"><span>4 .</span> <a href="javascript:void(0);" onclick="abrirMisCompras()">HISTORIAL DE COMPRAS</a></h3>
                                    </div>
                                </div>
                                <script>
                                    function abrirMisCompras() {
                                        window.location.href = 'misCompras.php';
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main><!-- End #main -->
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
    <?php
    include('footer.php');
    ?>
    
    <script src="assets/js/usuarioCliente.js"></script>
    <script src="assets/js/usuarioContras.js"></script>
    <script src="assets/js/usuarioDomicilio.js"></script>

    
</body>

</html>