<?php
ob_start();
session_start();
include('inc/header.php');
$_SESSION['name']="";
$loginError = '';
if (!empty($_POST['email']) && !empty($_POST['pwd'])) {
	include 'Inventory.php';
	$inventory = new Inventory();
	$login = $inventory->login($_POST['email'], $_POST['pwd']);
	if (!empty($login)) {
		$_SESSION['userid'] = $login[0]['correo'];
		$_SESSION['name'] = $login[0]['correo'];		
		if($login[0]['tipo']=="cliente" ){	
			$datosCliente = $inventory->getCustomerwhitUser($login[0]['correo']);
			if (!empty($datosCliente)) {	
				$_SESSION['cname'] = $datosCliente[0]['nombre'];	
				header("Location:../index.php");
			}
		}else{header("Location:index.php");
		}
	} else {
		$loginError = "Invalid email or password!";
	}
}
?>
<script src="js/loginregistro.js"></script>
<style>
	html,
	body,
	body>.container {
		height: 95%;
		width: 100%;
	}

	body>.container {
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
	}

	#title {
		text-shadow: 2px 2px 5px #000;
	}
	.button {
    border: none;
    color: white;
    padding: 16px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    transition-duration: 0.4s;
    cursor: pointer;
  }
  
  .button1 {
    background-color: #6d011a; 
    color: white; 
    border: 2px solid #6d011a;
  }
  
  .button1:hover {
    background-color: #6d011a5c;
    color: white;
  }
  
</style>
<?php include('inc/container.php'); ?>


<div class="col-lg-4 col-md-5 col-sm-10 col-xs-12">
	<div class="card rounded-0 shadow">
		<div class="card-header">
			<div class="card-title h3 text-center mb-0 fw-bold">Ingresar</div>
		</div>
		<div class="card-body">
			<div class="container-fluid">
				<form method="post" action="">
					<div class="form-group">
						<?php if ($loginError) { ?>
							<div class="alert alert-danger rounded-0 py-1"><?php echo $loginError; ?></div>
						<?php } ?>
					</div>
					<div class="mb-3">
						<label for="email" class="control-label">Correo</label>
						<input name="email" id="email" type="email" class="form-control rounded-0" placeholder="Dirección de Correo" autofocus="" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" required>
					</div>
					<div class="mb-3">
						<label for="password" class="control-label">Contraseña</label>
						<input type="password" class="form-control rounded-0" id="password" name="pwd" placeholder="Contraseña" required>
					</div>					
					<div class="d-grid">
					<button type="submit" name="login" class="button button1">Acceder</button>
					</div>
					<div class="col-lg-4 col-md-2 col-sm-4 col-xs-6" alaign="right" color="white">
							<button type="button" name="add" id="addCustomer" data-bs-toggle="modal" data-bs-target="#userModal" class="btn btn-info bg-Info btn-sm rounded-0"><i class="far fa-plus-square"></i>
								Registrarse
							</button> 	
						</div>
				</form>
			</div>
		</div>

		<div id="customerModal" class="modal">
			<div class="modal-dialog modal-dialog-centered  rounded-0">
				<div class="modal-content rounded-0">
					<div class="modal-header">
						<h4 class="modal-title"><i class="fa fa-plus"></i> Registro de cliente</h4>
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
								<div class="mb-3">
									<label for="password" class="control-label">Contraseña*</label>
									<input type="password" class="form-control rounded-0" id="password" name="password" placeholder="Contraseña" required>
								</div>	
								<div class="mb-3">
									<label for="confirmPassword" class="control-label">Confirmar contraseña*</label>
									<input type="password" class="form-control rounded-0" id="confirmPassword" name="confirmPassword" placeholder="Contraseña" required>
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