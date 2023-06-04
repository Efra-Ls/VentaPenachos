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
<script src="js/product.js"></script>
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
                            <h3 class="card-title">Lista de Productos</h3>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 text-end">
                            <button type="button" name="add" id="addProduct" class="btn btn-primary bg-gradient rounded-0 btn-sm"><i class="far fa-plus-square"></i> Agregar Producto</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table id="productList" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Categoría</th>
                                        <th>Promocion</th>
                                        <th>Precio</th>
                                        <th>Existencia</th>
                                        <th>Unidad</th>
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
    <div id="productModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Agregar Producto</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" id="productForm" >
                        <input type="hidden" name="id_producto" id="id_producto" />
                        <input type="hidden" name="btn_action" id="btn_action" />

                        <div class="form-group">
                            <label for="nombre">Nombre de Producto<label class="camposRojos">*</label></label>
                            <input type="text" name="nombre" id="nombre" class="form-control rounded-0" required />
                            <div id="nombreError" class="error-message" style="display: none;"> <label class="camposRojos">Complete este campo.</label></div>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción de Producto<label class="camposRojos">*</label></label>
                            <textarea name="descripcion" id="descripcion" class="form-control rounded-0" rows="5" ></textarea>
                            <div id="descripcionError" class="error-message" style="display: none;"> <label class="camposRojos">Complete este campo.</label></div>
                        </div>
                        <div class="form-group">
                            <label for="categoria">Seleccionar Categoría<label class="camposRojos">*</label></label>
                            <select name="categoria" id="categoria" class="form-select rounded-0" required>
                                <option value="">Seleccionar Categoría</option>
                                <?php echo $inventory->categoryDropdownList(); ?>
                            </select>
                            <div id="categoriaError" class="error-message" style="display: none;"> <label class="camposRojos">Seleccione una categoria.</label></div>
                        </div>      
                        <div class="form-group">
                            <label for="precio">Precio base del producto<label class="camposRojos">*</label></label>
                            <input type="text" name="precio" id="precio" class="form-control rounded-0" required  />
                            <div id="precioError" class="error-message" style="display: none;"> <label class="camposRojos">Complete este campo.</label></div>
                        </div>                  
                        <div class="form-group">
                            <label for="existencia">Cantidad de Producto<label class="camposRojos">*</label></label>
                            <div class="input-group">
                                <input type="text" name="existencia" id="existencia" class="form-control rounded-0" required pattern="[0-9]+" />
                                <div id="existenciaError" class="error-message" style="display: none;"> <label class="camposRojos"></label></div>
                                <select name="unidad" class="form-select rounded-0" id="unidad" required>
                                    <option value="">Selecciona Unidad</option>
                                    <option value="Bolsos">Bolsos</option>
                                    <option value="Botellas">Botellas</option>
                                    <option value="Cajas">Cajas</option>
                                    <option value="Docenas">Docenas</option>
                                    <option value="Pies">Pies</option>
                                    <option value="Galones">Galones</option>
                                    <option value="Gramos">Gramos</option>
                                    <option value="Pulgadas">Pulgadas</option>
                                    <option value="Kilos">Kilos</option>
                                    <option value="Litros">Litros</option>
                                    <option value="Metros">Metros</option>
                                    <option value="Unidades">Unidades</option>
                                    <option value="Paquete">Paquete</option>
                                    <option value="Rollos">Rollos</option>
                                </select>
                                <div id="unidadError" class="error-message" style="display: none;"> <label class="camposRojos">Seleccione la unidad de conteo.</label></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="promocion">Seleccionar promocion<label class="camposRojos">*</label></label>
                            <select name="promocion" id="promocion" class="form-select rounded-0" required>
                                <option value="">Seleccionar promocion</option>
                                <?php echo $inventory->promocionDropdownList(); ?>
                            </select>
                            <div id="promocionError" class="error-message" style="display: none;"> <label class="camposRojos">Seleccione una promocion.</label></div>
                        </div> 
                        <div class="form-group">
                            <label for="fotoprincipal">Foto pricipal<label class="camposRojos">*</label></label>
                            <input type="file" name="fotoprincipal" id="fotoprincipal" class="form-control rounded-0" multiple />            
                            <div id="fotoPError" class="error-message" style="display: none;"> <label class="camposRojos">Debe proporcionar la imagen que sera mostrada en el catalogo.</label></div>                
                        </div>    
                        <div class="form-group">
                            <label for="foto1">Foto 1<label class="camposRojos">*</label></label>
                            <input type="file" name="foto1" id="foto1" class="form-control rounded-0" multiple />          
                            <div id="foto1Error" class="error-message" style="display: none;"> <label class="camposRojos">Debe proporcionar imagenes para mostrar en la descripcion del producto</label></div>                  
                        </div> 
                        <div class="form-group">
                            <label for="foto2">Foto 2<label class="camposRojos">*</label></label>
                            <input type="file" name="foto2" id="foto2" class="form-control rounded-0" multiple />
                            <div id="foto2Error" class="error-message" style="display: none;"> <label class="camposRojos">Debe proporcionar imagenes para mostrar en la descripcion del producto</label></div>                             
                        </div> 
                        <div class="form-group">
                            <label for="foto3">Foto 3<label class="camposRojos">*</label></label>
                            <input type="file" name="foto3" id="foto3" class="form-control rounded-0" multiple /> 
                            <div id="foto3Error" class="error-message" style="display: none;"> <label class="camposRojos">Debe proporcionar imagenes para mostrar en la descripcion del producto</label></div>                            
                        </div> 
                        <div class="form-group">
                            <label for="foto4">Foto 4<label class="camposRojos">*</label></label>
                            <input type="file" name="foto4" id="foto4" class="form-control rounded-0" multiple />     
                            <div id="foto4Error" class="error-message" style="display: none;"> <label class="camposRojos">Debe proporcionar imagenes para mostrar en la descripcion del producto</label></div>                        
                        </div> 
                        <div class="form-group">
                            <label for="foto5">Foto 5<label class="camposRojos">*</label></label>
                            <input type="file" name="foto5" id="foto5" class="form-control rounded-0" multiple />   
                            <div id="foto5Error" class="error-message" style="display: none;"> <label class="camposRojos">Debe proporcionar imagenes para mostrar en la descripcion del producto</label></div>                          
                        </div>                                                         
                    </form>
                </div>
                <div class="modal-footer">
                    <label><label class="camposRojos">* Campos obligatorios</label></label>	    
                    <input type="submit" name="action" id="action" class="btn btn-primary rounded-0 btn-sm" value="Agregar" form="productForm" />
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