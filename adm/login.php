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
				</form>
			</div>
		</div>
	</div>	
</div>
<?php include('inc/footer.php'); ?>