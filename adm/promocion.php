<?php
ob_start();
session_start();
include('inc/header.php');
include 'Inventory.php';
$inventory = new Inventory();
$inventory->checkLogin();
?>

<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="scss/dataTables.bootstrap.min.css" />
<script src="js/promocion.js"></script>
<script src="js/common.js"></script>
<?php include('inc/container.php'); ?>
<div class="container">

    <?php include("menus.php"); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default rounded-0 shadow">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-6">
                            <h3 class="card-title">Lista de Promociones</h3>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 text-end">
                            <button type="button" name="add" id="addPromocion" class="btn btn-primary bg-gradient rounded-0 btn-sm"><i class="far fa-plus-square"></i> Agregar promocion</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table id="promocionList" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Tipo</th>  
                                        <th>Acción</th>                                         
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="promocionModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Agregar promocion</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post"  id="promocionForm" >
                        <input type="hidden" name="id_promocion" id="id_promocion" />
                        <input type="hidden" name="btn_action" id="btn_action" />

                        <div class="form-group">
                        <label for="nombre">Nombre <label class="camposRojos">*</label></label>
                        <input type="text" name="nombre" id="nombre" class="form-control rounded-0" required />
                        <div id="nombreError" class="error-message" style="display: none;"> <label class="camposRojos">Complete este campo.</label></div>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción <label class="camposRojos" for="nombre">*</label></label>
                        <textarea name="descripcion" id="descripcion" class="form-control rounded-0" rows="5" disabled></textarea>
                        <div id="descripcionError" class="error-message" style="display: none;"><label class="camposRojos">Complete este campo.</label></div>
                    </div>
                    <div class="form-group">
                        <label for="tipo">Seleccionar tipo<label class="camposRojos" for="nombre">*</label></label>
                        <select name="tipo" id="tipo" class="form-select rounded-0" required disabled>
                            <option value="">Seleccionar tipo</option>
                            <option value="Descuento por cantidad">Descuento por cantidad</option>
                            <option value="Regalo con compra">Regalo con compra</option>
                            <option value="Descuento por tiempo limitado">Descuento por tiempo limitado</option>
                        </select>
                        <div id="tipoError" class="error-message" style="display: none;"><label class="camposRojos">Seleccione un tipo.</label></div>
                    </div> 
                       
                                 
                                                
                        <!-- Campos específicos para Descuento por cantidad -->
                        <div class="form-group promocion-campos hidden2" id="descuentoCantidadCampos">
                            <label for="umbral_cantidad_descuento">Cantidad mínima de productos para aplicar la promocion<label class="camposRojos" for="umbral_cantidad_descuento">*</label></label>
                            <input type="number" name="umbral_cantidad_descuento" id="umbral_cantidad_descuento" class="form-control rounded-0" required/>
                            <div id="cantMinError" class="error-message" style="display: none;"> <label class="camposRojos">Complete este campo.</label></div>
                            <br>
                            <label for="porcentaje_descuento">Porcentaje de descuento <label class="camposRojos" for="nombre">*</label></label>
                            <input type="text" name="porcentaje_descuento" id="porcentaje_descuento" class="form-control rounded-0"  oninput="formatPorcentaje(this)" required/>
                            <div id="porcentajeDescError" class="error-message" style="display: none;"> <label class="camposRojos">Complete este campo.</label></div>
                            <script>
                                function formatPorcentaje(input) {
                                        // Obtener el valor ingresado por el usuario
                                        let value = input.value;

                                        // Remover cualquier caracter que no sea un número
                                        value = value.replace(/[^0-9]/g, '');

                                        // Limitar el valor a un máximo de 100
                                        if (value > 100) {
                                            // Obtener el valor anterior antes de ingresar el número mayor a 100
                                            const previousValue = value.slice(0, -1);
                                            value = previousValue;
                                        }

                                        // Agregar el símbolo "%" al final
                                        value = value + "%";

                                        // Actualizar el valor en el campo de entrada
                                        input.value = value;
                                        }
                                </script>
                            <!-- Agrega otros campos específicos para esta promoción aquí -->
                        </div>

                        <!-- Campos específicos para Regalo con compra -->
                        <div class="form-group promocion-campos hidden2" id="regaloCompraCampos">
                            <label for="cantidad_compra_regalo">Cantidad mínima de productos para aplicar la promoción<label class="camposRojos" for="cantidad_compra_regalo">*</label></label>
                            <input type="number" name="cantidad_compra_regalo" id="cantidad_compra_regalo" class="form-control rounded-0" required/>   
                            <div id="cantMin2Error" class="error-message" style="display: none;"> <label class="camposRojos">Complete este campo.</label></div>                        
                            <br>
                            <label for="cantidad_regalo">Cantidad de productos regalados<label class="camposRojos" for="cantidad_regalo">*</label></label>
                            <input type="number" name="cantidad_regalo" id="cantidad_regalo" class="form-control rounded-0" required/>
                            <div id="cantRegError" class="error-message" style="display: none;"> <label class="camposRojos">Complete este campo.</label></div>
                            <!-- Agrega otros campos específicos para esta promoción aquí -->
                        </div>

                        <!-- Campos específicos para Descuento por tiempo limitado -->
                        <div class="form-group promocion-campos hidden2" id="descuentoTiempoCampos">
                            <label for="fecha_inicio_limitado"> Fecha de inicio de la promoción<label class="camposRojos" for="fecha_inicio_limitado">*</label></label>
                            <input type="date" name="fecha_inicio_limitado" id="fecha_inicio_limitado" class="form-control rounded-0" required/>
                            <div id="fechaIniError" class="error-message" style="display: none;"> <label class="camposRojos">Complete este campo.</label></div>
                            <br>
                            <!-- Agrega otros campos específicos para esta promoción aquí -->
                            <label for="fecha_fin_limitado"> Fecha de finalización de la promoción<label class="camposRojos" for="fecha_fin_limitado">*</label></label>
                            <input type="date" name="fecha_fin_limitado" id="fecha_fin_limitado" class="form-control rounded-0" required/>
                            <div id="fechaFinError" class="error-message" style="display: none;"> <label class="camposRojos">Complete este campo.</label></div>
                            <br>
                            <label for="porcentaje_descuento_limitado">Porcentaje de descuento<label class="camposRojos" for="porcentaje_descuento_limitado">*</label></label>
                            <input type="text" name="porcentaje_descuento_limitado" id="porcentaje_descuento_limitado" class="form-control rounded-0"  oninput="formatPorcentaje(this)" required/>
                            <div id="porcentajeLimError" class="error-message" style="display: none;"> <label class="camposRojos">Complete este campo.</label></div>
                            <script>
                                function formatPorcentaje(input) {
                                        // Obtener el valor ingresado por el usuario
                                        let value = input.value;

                                        // Remover cualquier caracter que no sea un número
                                        value = value.replace(/[^0-9]/g, '');

                                        // Limitar el valor a un máximo de 100
                                        if (value > 100) {
                                            // Obtener el valor anterior antes de ingresar el número mayor a 100
                                            const previousValue = value.slice(0, -1);
                                            value = previousValue;
                                        }

                                        // Agregar el símbolo "%" al final
                                        value = value + "%";

                                        // Actualizar el valor en el campo de entrada
                                        input.value = value;
                                        }
                                </script>
                                
                                
                        </div>
                        <script>
                            const nombreInput = document.getElementById('nombre');
                            const descripcionInput = document.getElementById('descripcion');
                            const tipoSelect = document.getElementById('tipo');
                            const umbral_cantidad_descuentoInput = document.getElementById('umbral_cantidad_descuento');
                            const porcentaje_descuentoInput = document.getElementById('porcentaje_descuento');
                            const cantidad_compra_regaloInput = document.getElementById('cantidad_compra_regalo');
                            const cantidad_regaloInput = document.getElementById('cantidad_regalo');
                            const fecha_inicio_limitadoInput = document.getElementById('fecha_inicio_limitado');
                            const fecha_fin_limitadoInput = document.getElementById('fecha_fin_limitado');
                            const porcentaje_descuento_limitadoInput = document.getElementById('porcentaje_descuento_limitado');

                            const nombreError = document.getElementById('nombreError');
                            const descripcionError = document.getElementById('descripcionError');
                            const tipoError = document.getElementById('tipoError');
                            const cantMinError = document.getElementById('cantMinError');
                            const porcentajeDescError = document.getElementById('porcentajeDescError');
                            const cantMin2Error = document.getElementById('cantMin2Error');
                            const cantRegError = document.getElementById('cantRegError');
                            const fechaIniError = document.getElementById('fechaIniError');
                            const fechaFinError = document.getElementById('fechaFinError');
                            const porcentajeLimError = document.getElementById('porcentajeLimError');

                            // Función para verificar y desactivar los inputs según el estado del anterior
                            function verificarInputs() {
                                descripcionInput.disabled = nombreInput.value.trim() === '';
                                tipoSelect.disabled = descripcionInput.value.trim() === '';

                                porcentaje_descuentoInput.disabled = !umbral_cantidad_descuentoInput.value;

                                cantidad_regaloInput.disabled = !cantidad_compra_regaloInput.value;

                                fecha_fin_limitadoInput.disabled = !fecha_inicio_limitadoInput.value;
                                porcentaje_descuento_limitadoInput.disabled = !fecha_fin_limitadoInput.value;

                                

                                // Mostrar mensaje de error y establecer el foco en el campo anterior
                                if (nombreInput.value.trim() === '') {
                                    nombreError.style.display = 'block';
                                    nombreInput.focus();
                                } else {
                                    nombreError.style.display = 'none';
                                }

                                if (descripcionInput.value.trim() === '') {
                                    descripcionError.style.display = 'block';
                                    descripcionInput.focus();
                                } else {
                                    descripcionError.style.display = 'none';
                                }

                                if (tipoSelect.value.trim() === '') {
                                    tipoError.style.display = 'block';
                                    tipoSelect.focus();
                                } else {
                                    tipoError.style.display = 'none';
                                }
                                // Mostrar mensaje de error y establecer el foco en el campo anterior
                                if (umbral_cantidad_descuentoInput.value.trim() === '') {
                                    porcentaje_descuentoInput.disabled = true;
                                    cantMinError.style.display = 'block';
                                    umbral_cantidad_descuentoInput.focus();
                                } else {
                                    porcentaje_descuentoInput.disabled = false;
                                    cantMinError.style.display = 'none';
                                }

                                if (porcentaje_descuentoInput.value.trim() === '') {
                                    porcentajeDescError.style.display = 'block';
                                    porcentaje_descuentoInput.focus();
                                } else {
                                    porcentajeDescError.style.display = 'none';
                                }

                                if (cantidad_compra_regaloInput.value.trim() === '') {
                                    cantMin2Error.style.display = 'block';
                                    cantidad_compra_regaloInput.focus();
                                } else {
                                    cantMin2Error.style.display = 'none';
                                }

                                if (cantidad_regaloInput.value.trim() === '') {
                                    cantRegError.style.display = 'block';
                                    cantidad_regaloInput.focus();
                                } else {
                                    cantRegError.style.display = 'none';
                                }

                                if (fecha_inicio_limitadoInput.value.trim() === '') {
                                    fechaIniError.style.display = 'block';
                                    fecha_inicio_limitadoInput.focus();
                                } else {
                                    fechaIniError.style.display = 'none';
                                }

                                if (fecha_fin_limitadoInput.value.trim() === '') {
                                    fechaFinError.style.display = 'block';
                                    fecha_fin_limitadoInput.focus();
                                } else {
                                    fechaFinError.style.display = 'none';
                                }

                                if (porcentaje_descuento_limitadoInput.value.trim() === '') {
                                    porcentajeLimError.style.display = 'block';
                                    porcentaje_descuento_limitadoInput.focus();
                                } else {
                                    porcentajeLimError.style.display = 'none';
                                }
                                


                            }

                            // Evento onchange para el input 'nombre'
                            nombreInput.addEventListener('change', verificarInputs);
                            // Evento onchange para el input 'descripcion'
                            descripcionInput.addEventListener('change', verificarInputs);
                            // Evento onchange para el select 'tipo'
                            tipoSelect.addEventListener('change', verificarInputs);

                            umbral_cantidad_descuentoInput.addEventListener('change', verificarInputs);
                            porcentaje_descuentoInput.addEventListener('change', verificarInputs);
                            cantidad_compra_regaloInput.addEventListener('change', verificarInputs);
                            cantidad_regaloInput.addEventListener('change', verificarInputs);
                            fecha_inicio_limitadoInput.addEventListener('change', verificarInputs);
                            fecha_fin_limitadoInput.addEventListener('change', verificarInputs);
                            porcentaje_descuento_limitadoInput.addEventListener('change', verificarInputs);

                        </script>
                    </form>
                </div>
                <div class="modal-footer">
                    <label class="camposRojos">* Campos obligatorios</label>	    
                    <input type="submit" name="action" id="action" class="btn btn-primary rounded-0 btn-sm" value="Agregar" form="promocionForm" />
                    <button type="button" class="btn btn-default border rounded-0 btn-sm" data-bs-dismiss="modal">Cerrar</button>
                </div>
                <style>
                .camposRojos{
                    color: #fb0101;                
                }
                </style>
            </div>
        </div>
    </div>

    <div id="productViewModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <form method="post" id="product_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-th-list"></i> Información de Producto</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <Div id="productDetails"></Div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<?php include('inc/footer.php'); ?>