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
    <script src="assets/js/carrito.js"></script>

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
                    <h2>Carrito</h2>
                    <h2>&nbsp;</h2>
                    <ol>
                        <li><a href="index.php">Página Principal</a></li>
                        <li>Carrito</li>
                    </ol>
                </div>
            </div>
        </section><!-- End Breadcrumbs Section -->


        <section id="portfolio" class="portfolio">

            <div class="cart-main-area pt-90 pb-100">
                <div class="container">
                    <h3 class="cart-page-title">Tu carrito de artículos</h3>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <form action="#">
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
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="cart-shiping-update-wrapper">
                                            <div class="cart-shiping-update">
                                                <a href="#">Continuar comprando</a>
                                            </div>
                                            <div class="cart-clear">
                                                <button>Actualizar carrito de compras</button>
                                                <a href="#">Vaciar carrito de compras</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <!--<div class="cart-tax">
                            <div class="title-wrap">
                                <h4 class="cart-bottom-title section-bg-gray">Estimate Shipping And Tax</h4>
                            </div>
                            <div class="tax-wrapper">
                                <p>Enter your destination to get a shipping estimate.</p>
                                <div class="tax-select-wrapper">
                                    <div class="tax-select">
                                        <label>
                                            * Country
                                        </label>
                                        <select class="email s-email s-wid">
                                            <option>Bangladesh</option>
                                            <option>Albania</option>
                                            <option>Åland Islands</option>
                                            <option>Afghanistan</option>
                                            <option>Belgium</option>
                                        </select>
                                    </div>
                                    <div class="tax-select">
                                        <label>
                                            * Region / State
                                        </label>
                                        <select class="email s-email s-wid">
                                            <option>Bangladesh</option>
                                            <option>Albania</option>
                                            <option>Åland Islands</option>
                                            <option>Afghanistan</option>
                                            <option>Belgium</option>
                                        </select>
                                    </div>
                                    <div class="tax-select">
                                        <label>
                                            * Zip/Postal Code
                                        </label>
                                        <input type="text">
                                    </div>
                                    <button class="cart-btn-2" type="submit">Get A Quote</button>
                                </div>
                            </div>
                        </div>-->
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="discount-code-wrapper">
                                        <div class="title-wrap">
                                            <h4 class="cart-bottom-title section-bg-gray">Usar código de cupón</h4>
                                        </div>
                                        <div class="discount-code">
                                            <p>Ingrese su código de cupón si tiene uno.</p>
                                            <form>
                                                <input type="text" required="" name="name">
                                                <button class="cart-btn-2" type="submit">Aplicar cupón</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="grand-totall">
                                        <div class="title-wrap">
                                            <h4 class="cart-bottom-title section-bg-gary-cart">Total del carrito</h4>
                                        </div>
                                        <h5>Precio total de productos <span>$260.00</span></h5>
                                        <div class="total-shipping">
                                            <h5>Consto de envío</h5>
                                            <ul>
                                                <li><input type="checkbox"> Estandar <span>$20.00</span></li>
                                                <li><input type="checkbox"> Express <span>$30.00</span></li>
                                            </ul>
                                        </div>
                                        <h4 class="grand-totall-title">Total <span>$260.00</span></h4>
                                        <a href="#">Proceder con el pago</a>
                                    </div>
                                </div>
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