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
<script src="js/pedidos.js"></script>
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
                            <h3 class="card-title">Lista de Pedidos</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table id="pedidoList" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre del cliente</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Direccion</th>
                                        <th>Estado</th>
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
    <div id="pedidoModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Actualizar estado del pedido</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="pedidoForm">
                        <input type="hidden" name="id_pedido" id="id_pedido" />
                        <input type="hidden" name="btn_action" id="btn_action" />

                        <div class="form-group">
                            <label>Nombre del cliente</label>
                            <input type="text" name="nombrec" id="nombrec" class="form-control rounded-0"  disabled=true />
                        </div>
                        <div class="form-group">
                            <label>Fecha</label>
                            <input type=date name="fecha" id="fecha" class="form-control rounded-0" rows="5"  disabled=true></input>
                        </div>      
                        <div class="form-group">
                            <label>Hora</label>
                            <input type="text" name="hora" id="hora" class="form-control rounded-0" disabled=true/>
                        </div>    
                        <div class="form-group">
                            <label>Direccion</label>
                            <input type="text" name="direccion" id="direccion" class="form-control rounded-0" disabled=true/>
                        </div>                 
                        <div class="form-group">
                            <label>Estado</label>
                            <div class="input-group">                                
                                <select name="estado" class="form-select rounded-0" id="estado" required>
                                    <option value="">Seleccione el estado</option>
                                    <option value="Pendiente de pago">Pendiente de pago</option>
                                    <option value="Pagado">Pagado</option>
                                    <option value="En proceso">En proceso</option>
                                    <option value="Enviado">Enviado</option>
                                    <option value="Entregado">Entregado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
                            </div>
                        </div>                                                                       
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="action" id="action" class="btn btn-primary rounded-0 btn-sm" value="Agregar" form="pedidoForm" />
                    <button type="button" class="btn btn-default border rounded-0 btn-sm" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div id="pedidoViewModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <form method="post" id="pedido_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-th-list"></i> Información de Pedido</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <Div id="pedidoDetails"></Div>
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