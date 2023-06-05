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

    <div id="successMessage" class="modal">
		
			<div class="modal-dialog modal-dialog-centered  rounded-0">
					<div class="modal-content rounded-0">
						<div class="modal-header">
							<button type="button" class="btn-close text-xs" data-bs-dismiss="modal"></button>
						</div>

						<div class="modal-body">
						<div class="container-fluid">
							<div class="mb-3">
									<label class="control-label"><h3>Registrado correctamente</h3></label>
									
								</div>
							
						</div>
						</div>

						<div class="modal-footer">							
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