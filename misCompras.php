<!DOCTYPE html>
<html lang="es">

<head>
    <?php
    include('encabezado.php');
    ?>
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
    <script src="adm/js/jquery.dataTables.min.js"></script>
<script src="adm/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="adm/scss/dataTables.bootstrap.min.css" />
<script src="assets/js/misCompras.js"></script>
    
    <script>
    var userid = '<?php echo $_SESSION['id_cliente']; ?>';
    var correoU ='<?php echo $_SESSION['userid']; ?>';
</script>


    
    
<style>
    .product-image {
      max-width: 100px; /* Cambia este valor al ancho máximo que desees */
      max-height: 100px; /* Cambia este valor a la altura máxima que desees */
    }
    </style>
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
     

        <section id="portfolio" class="portfolio">
            <div class="cart-main-area pt-90 pb-100">
                <div class="container">
                    <h3 class="cart-page-title">Historial de compras</h3>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            
                                <div class="table-content table-responsive cart-table-content">
                                    <table id="misComprasList" >
                                        <thead>
                                            <tr>
                                                <th>Imagen</th>
                                                <th>Nombre del producto</th>
                                                <th>Precio unitario</th>
                                                <th>Cantidad</th>
                                                <th>Subtotal</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>                                        
                                    </table>
                                </div>

                        </div>
                    </div>
                </div>
            </div>

        </section>


    </main><!-- End #main -->


    <!-- FOOTER -->
    <?php
    include('footer.php');
    ?>

</body>

</html>