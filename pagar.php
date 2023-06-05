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
                    <h2>Pagar</h2>
                    <h2>&nbsp;</h2>
                    <ol>
                        <li><a href="index.php">Página Principal</a></li>
                        <li>Checkout</li>
                    </ol>
                </div>
            </div>
        </section><!-- End Breadcrumbs Section -->


        <section id="portfolio" class="portfolio">

    <div class="checkout-area pt-95 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="billing-info-wrap">
                        <h3>Detalles de Facturación</h3>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-20">
                                    <label>Nombre</label>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-20">
                                    <label>Apellidos</label>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="billing-info mb-20">
                                    <label>Nombre de la Empresa</label>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="billing-select mb-20">
                                    <label>País</label>
                                    <select>
                                        <option>Selecciona un país</option>
                                        <option>México</option>
                                        <option>Estados unidos</option>
                                        <option>España</option>
                                        <option>Comlombia</option>
                                        <option>Argentina</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="billing-info mb-20">
                                    <label>Dirección</label>
                                    <input class="billing-address" placeholder="Número de casa y nombre de la calle"
                                        type="text">
                                    <input placeholder="Apartamento, suite, unidad, etc." type="text">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="billing-info mb-20">
                                    <label>Ciudad</label>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-20">
                                    <label>Estado / Condado</label>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-20">
                                    <label>Código Postal</label>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-20">
                                    <label>Teléfono</label>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-20">
                                    <label>Correo Electrónico</label>
                                    <input type="text">
                                </div>
                            </div>
                        </div>
                        <div class="checkout-account mb-50">
                            <input class="checkout-toggle2" type="checkbox">
                            <span>¿Crear una cuenta?</span>
                        </div>
                        <div class="checkout-account-toggle open-toggle2 mb-30">
                            <input placeholder="Correo Electrónico" type="email">
                            <input placeholder="Contraseña" type="password">
                            <button class="btn-hover checkout-btn" type="submit">REGISTRAR</button>
                        </div>
                        <div class="additional-info-wrap">
                            <h4>Información adicional</h4>
                            <div class="additional-info">
                                <label>Notas del pedido</label>
                                <textarea placeholder="Notas adicionales sobre tu pedido, por ejemplo, notas especiales para la entrega. "
                                    name="message"></textarea>
                            </div>
                        </div>
                        <div class="checkout-account mt-25">
                            <input class="checkout-toggle" type="checkbox">
                            <span>¿Enviar a una dirección existente?</span>
                        </div>
                        <div class="different-address open-toggle mt-30">
                            <div class="row">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="your-order-area">
                        <h3>Tu pedido</h3>
                        <div class="your-order-wrap gray-bg-4">
                            <div class="your-order-product-info">
                                <div class="your-order-top">
                                    <ul>
                                        <li>Producto</li>
                                        <li>Total</li>
                                    </ul>
                                </div>
                                <div class="your-order-middle">
                                    <ul>
                                        <li><span class="order-middle-left">Nombre del Producto X 1</span> <span
                                                class="order-price">$329 </span></li>
                                        <li><span class="order-middle-left">Nombre del Producto X 1</span> <span
                                                class="order-price">$329 </span></li>
                                    </ul>
                                </div>
                                <div class="your-order-bottom">
                                    <ul>
                                        <li class="your-order-shipping">Envío</li>
                                        <li>Express</li>
                                    </ul>
                                </div>
                                <div class="your-order-total">
                                    <ul>
                                        <li class="order-total">Total</li>
                                        <li>$329</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="payment-method">
                                <div class="payment-accordion element-mrg">
                                    <div class="panel-group" id="accordion">
                                        <div class="panel payment-accordion">
                                            <div class="panel-heading" id="method-one">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#method1">
                                                    Transferencia bancaria directa
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="method1" class="panel-collapse collapse show">
                                                <div class="panel-body">
                                                    <p>Por favor, comunícate con nosotros para realizar este método de pago
</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel payment-accordion">
                                            <div class="panel-heading" id="method-two">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                                        href="#method2">
                                                        Pago por cheque.
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="method2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <p>Método de pago no disponible</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel payment-accordion">
                                            <div class="panel-heading" id="method-three">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                                        href="#method3">
                                                        Cobro a la entrega.
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="method3" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <p>Método de pago no disponible</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Place-order mt-25">
                            <a class="btn-hover" href="#">REALIZAR PEDIDO</a>
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