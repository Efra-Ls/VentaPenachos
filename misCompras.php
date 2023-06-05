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
                            <form action="#">
                                <div class="table-content table-responsive cart-table-content">
                                    <table>
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
                                        <tbody>
                                            <tr>
                                                <td class="product-thumbnail">
                                                    <a href="#"><img src="assets/img/cart/cart-1.png" alt=""></a>
                                                </td>
                                                <td class="product-name"><a href="#">Nombre del producto</a></td>
                                                <td class="product-price-cart"><span class="amount">$100.00</span></td>
                                                <td class="product-quantity">
                                                    <div class="cart-plus-minus">
                                                        <input class="cart-plus-minus-box" type="text" name="qtybutton"
                                                            value="2">
                                                    </div>
                                                </td>
                                                <td class="product-subtotal">$200.00</td>
                                                <td class="product-wishlist-cart">
                                                    <a href="#">++ carrito</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="product-thumbnail">
                                                    <a href="#"><img src="assets/img/cart/cart-2.png" alt=""></a>
                                                </td>
                                                <td class="product-name"><a href="#">Nombre del producto</a></td>
                                                <td class="product-price-cart"><span class="amount">$150.00</span></td>
                                                <td class="product-quantity">
                                                    <div class="cart-plus-minus">
                                                        <input class="cart-plus-minus-box" type="text" name="qtybutton"
                                                            value="2">
                                                    </div>
                                                </td>
                                                <td class="product-subtotal">$300.00</td>
                                                <td class="product-wishlist-cart">
                                                    <a href="#">++ carrito</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="product-thumbnail">
                                                    <a href="#"><img src="assets/img/cart/cart-1.png" alt=""></a>
                                                </td>
                                                <td class="product-name"><a href="#">Nombre del producto</a></td>
                                                <td class="product-price-cart"><span class="amount">$170.00</span></td>
                                                <td class="product-quantity">
                                                    <div class="cart-plus-minus">
                                                        <input class="cart-plus-minus-box" type="text" name="qtybutton"
                                                            value="2">
                                                    </div>
                                                </td>
                                                <td class="product-subtotal">$340.00</td>
                                                <td class="product-wishlist-cart">
                                                    <a href="#">++ carrito</a>
                                                </td>
                                            </tr>
                                        </tbody>
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