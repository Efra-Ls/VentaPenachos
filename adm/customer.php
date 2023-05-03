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
<script src="js/customer.js"></script>
<script src="js/common.js"></script>
<?php include('inc/container.php');?>
<div class="container">
	<?php include("menus.php"); ?>
	<div class="row">
		<div class="col-lg-12">
			<div class="card card-default rounded-0 shadow">
				<div class="card-header">
					<div class="row">
						<div class="col-lg-10 col-md-10 col-sm-8 col-xs-6">
							<h3 class="card-title">Clientes</h3>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-4 col-xs-6" alaign="right" color="white">
							<button type="button" name="add" id="addCustomer" data-bs-toggle="modal" data-bs-target="#userModal" class="btn btn-info bg-Info btn-sm rounded-0"><i class="far fa-plus-square"></i>
								Agregar Cliente
							</button> 	
						</div>
					</div>
					<div class="clear:both"></div>
				</div>
				<div class="card-body">				
					<div class="row">
						<div class="col-sm-12 table-responsive">
							<table id="customerList" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>ID</th>
										<th>Nombre</th>
										<th>Domicilio</th>
										<th>Telefono</th>
										<th>Correo</th>
										<th>Acción</th>																			
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="customerModal" class="modal">
			<div class="modal-dialog modal-dialog-centered  rounded-0">
				<div class="modal-content rounded-0">
					<div class="modal-header">
						<h4 class="modal-title"><i class="fa fa-plus"></i> Agregar Cliente</h4>
						<button type="button" class="btn-close text-xs" data-bs-dismiss="modal"></button>
					</div>
					<div class="modal-body">
						<div class="container-fluid">
							<form method="post" id="customerForm">
								<input type="hidden" name="userid" id="userid" />
								<input type="hidden" name="btn_action" id="btn_action" value="customerAdd" />
								<div class="mb-3">
									<label class="control-label">Nombre*</label>
									<input type="text" name="cnombre" id="cnombre" class="form-control rounded-0" required pattern="[A-Za-z]+" title="Este campo no acepta numeros." />
								</div>
								<div class="mb-3">
									<label class="control-label">Domicilio*</label>
									<input type="text" name="domicilio" id="domicilio" class="form-control rounded-0" required />
								</div>
								<div class="mb-3">
									<label class="control-label">Telefono*</label>
									<input type="text" name="telefono" id="telefono" class="form-control rounded-0" required pattern="[0-9]+" maxlength="10" title="Este campo no acepta letras."/>
								</div>
								<div class="mb-3">
									<label class="control-label">Correo*</label>
									<input type="email" name="correo" id="correo" class="form-control rounded-0" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Por favor ingrese una dirección de correo válida." ></input>
								</div>								
							</form>
						</div>
					</div>
					<div class="modal-footer">
						<label>* Campos obligatorios</label>					
						<button type="submit" name="action" id="action" class="btn btn-sm rounded-0 btn-primary" form="customerForm">Guardar</button>
						<button type="button" class="btn btn-sm rounded-0 btn-default border" data-bs-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include('inc/footer.php'); ?>