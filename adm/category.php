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
<script src="js/category.js"></script>
<script src="js/common.js"></script>
<?php include('inc/container.php'); ?>
<div class="container">

	<?php include("menus.php"); ?>
	<div class="row">
		<div class="col-lg-12">
			<div class="card card-default rounded-0 shadow">
				<div class="card-header">
					<div class="row">
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
							<h3 class="card-title">Listado de Categorías</h3>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 text-end">
						<button type="button" name="add" id="categoryAdd" class="btn btn-primary bg-gradient rounded-0 btn-sm"><i class="far fa-plus-square"></i> Agregar categoria</button>
						</div>
					</div>
					<div style="clear:both"></div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-12 table-responsive">
							<table id="categoryList" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>ID</th>
										<th>Nombre Categoría</th>
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
	<div id="categoryModal" class="modal fade">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><i class="fa fa-plus"></i> Agregar Categoría</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
			    	<div class="modal-body">					
						<form method="post" id="categoryForm">
							<input type="hidden" name="id_categoria" id="id_categoria" />
							<input type="hidden" name="btn_action" id="btn_action" />

							<div class="form-group">
								<label>Nombre Categoría<label class="camposRojos">*</label>	</label>
								<input type="text" name="categoria" id="categoria" class="form-control rounded-0" required />

								<div id="categoriaError" class="error-message" style="display: none;">
									<label class="camposRojos">Complete este campo.</label>
								</div>

							</div>
							
						 </form>


					 </div> 

				<div class="modal-footer">	
					<label class="camposRojos">* Campos obligatorios</label>										
						<input type="submit" name="action" id="action" class="btn btn-primary rounded-0 btn-sm" value="Agregar" form="categoryForm" />
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
</div>
<?php include('inc/footer.php'); ?>