<?php
class Inventory
{
	private $host  = 'localhost';
	private $user  = 'root';
	private $password   = '1234';
	private $database  = 'bdgpsvp';
	private $userTable = 'usuario';
	private $customerTable = 'cliente';
	private $categoryTable = 'categoria';
	private $pedidoTable = 'pedido';
	private $detallepedidoTable = 'detalle_pedido';
	private $brandTable = 'ims_brand';
	private $productTable = 'producto';
	private $supplierTable = 'ims_supplier';
	private $purchaseTable = 'ims_purchase';
	private $orderTable = 'ims_order';
	private $dbConnect = false;
	public function __construct()
	{
		if (!$this->dbConnect) {
			$conn = new mysqli($this->host, $this->user, $this->password, $this->database);
			if ($conn->connect_error) {
				die("Error failed to connect to MySQL: " . $conn->connect_error);
			} else {
				$this->dbConnect = $conn;
			}
		}
	}
	private function getData($sqlQuery)
	{
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if (!$result) {
			die('Error in query: ' . mysqli_error());
		}
		$data = array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[] = $row;
		}
		return $data;
	}
	private function getNumRows($sqlQuery)
	{
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if (!$result) {
			die('Error in query: ' . mysqli_error());
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}
	public function login($email, $password)
	{
		//$password = md5($password);
		$sqlQuery = "
			SELECT correo,contrasenia,tipo
			FROM " . $this->userTable . " 
			WHERE correo='" . $email . "' AND contrasenia='" . $password . "'";
		return  $this->getData($sqlQuery);
	}
	public function checkLogin()
	{
		if (empty($_SESSION['userid'])) {
			header("Location:login.php");
		}
	}
	public function getCustomer()
	{
		$sqlQuery = "
			SELECT * FROM " . $this->customerTable . " 
			WHERE id_cliente = '" . $_POST["userid"] . "'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		echo json_encode($row);
	}
	public function getCustomerwhitUser($email)
	{
		$sqlQuery = "
			SELECT * FROM " . $this->customerTable . " 
			WHERE correo = '" . $email . "'";
		return  $this->getData($sqlQuery);
	}

	public function getCustomerList()
	{
		$sqlQuery = "SELECT * FROM " . $this->customerTable . " ";
		if (!empty($_POST["search"]["value"])) {
			$sqlQuery .= 'where id_cliente LIKE "%' . $_POST["search"]["value"] . '%" ';
			$sqlQuery .= 'OR nombre LIKE "%' . $_POST["search"]["value"] . '%" ';
			$sqlQuery .= 'OR domicilio LIKE "%' . $_POST["search"]["value"] . '%" ';
			$sqlQuery .= 'OR telefono LIKE "%' . $_POST["search"]["value"] . '%" ';
			$sqlQuery .= 'OR correo LIKE "%' . $_POST["search"]["value"] . '%" ';
		}
		
		if (!empty($_POST["order"])) {
			$sqlQuery .= ' ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
		} 
		else {
			$sqlQuery .= ' ORDER BY id_cliente ASC ';
		}


		if ($_POST["length"] != -1) {
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$customerData = array();
		while ($customer = mysqli_fetch_assoc($result)) {			
			$customerRows = array();
			$customerRows[] = $customer['id_cliente'];
			$customerRows[] = $customer['nombre'];
			$customerRows[] = $customer['domicilio'];
			$customerRows[] = $customer['telefono'];
			$customerRows[] = $customer['correo'];
			$customerRows[] = '<button type="button" name="update"  id_cliente="' . $customer["id_cliente"] . '" class="btn btn-primary btn-sm rounded-0 update" title="update"><i class="fa fa-edit"></i></button><button type="button" name="delete" 
			 correo = "' . $customer["correo"] . ' " class="btn btn-danger btn-sm rounded-0 delete" ><i class="fa fa-trash"></button>';
			$customerRows[] = '';
			$customerData[] = $customerRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$customerData
		);															
		echo json_encode($output);
	}

	public function saveCustomer()
	{
		$sqlInsert = "
			INSERT INTO " . $this->userTable . "(correo, contrasenia, tipo) 
			VALUES ('" . $_POST['correo'] . "', '1234', 'cliente')";
		mysqli_query($this->dbConnect, $sqlInsert);		

		$sqlInsert = "			
			INSERT INTO " . $this->customerTable . "(nombre, domicilio, telefono, correo) 
			VALUES ('" . $_POST['cnombre'] . "', '" . $_POST['domicilio'] . "', '" . $_POST['telefono'] . "', '" . $_POST['correo'] . "')";
		mysqli_query($this->dbConnect, $sqlInsert);

		echo 'New Customer Added';
	}
	public function updateCustomer()
	{
		if ($_POST['userid']) {
			$sqlInsert = "
				UPDATE " . $this->customerTable . " 
				SET nombre = '" . $_POST['cnombre'] . "', domicilio= '" . $_POST['domicilio'] . "', telefono = '" . $_POST['telefono'] . "', correo = '" . $_POST['correo'] . "' 
				WHERE id_cliente = '" . $_POST['userid'] . "'";
			mysqli_query($this->dbConnect, $sqlInsert);
			echo 'Customer Edited';
		}
	}
	public function deleteCustomer()
	{
		$sqlQuery = "DELETE FROM " . $this->customerTable . " 
		WHERE correo = '" . $_POST['correo'] . "'";
		mysqli_query($this->dbConnect, $sqlQuery);	
		$sqlQuery = "DELETE FROM " . $this->userTable . " 
		WHERE correo = '" . $_POST['correo'] . "'";
		mysqli_query($this->dbConnect, $sqlQuery);			
		//echo 'Customer Deleted';
	}
	// Category functions
	public function getCategoryList()
	{
		$sqlQuery = "SELECT * FROM " . $this->categoryTable . " ";
		if (!empty($_POST["search"]["value"])) {
			$sqlQuery .= 'WHERE nombre LIKE "%' . $_POST["search"]["value"] . '%" ';
		}
		if (!empty($_POST["order"])) {
			$sqlQuery .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
		} else {
			$sqlQuery .= 'ORDER BY nombre ASC ';
		}
		if ($_POST["length"] != -1) {
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$categoryData = array();
		while ($category = mysqli_fetch_assoc($result)) {
			$categoryRows = array();
			$categoryRows[] = $category['id_categoria'];
			$categoryRows[] = $category['nombre'];
			$categoryRows[] = '<button type="button" name="update" id_categoria="' . $category["id_categoria"] . '" class="btn btn-primary btn-sm rounded-0 update" title="Update"><i class="fa fa-edit"></i></button><button type="button" name="delete" id_categoria="' . $category["id_categoria"] . '" class="btn btn-danger btn-sm rounded-0 delete"  title="Delete"><i class="fa fa-trash"></i></button>';
			//$categoryRows[] = "";
			$categoryData[] = $categoryRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$categoryData
		);
		echo json_encode($output);
	}
	public function saveCategory()
	{
		$sqlInsert = "
			INSERT INTO " . $this->categoryTable . "(nombre) 
			VALUES ('" . $_POST['categoria'] . "')";
		mysqli_query($this->dbConnect, $sqlInsert);
		echo 'New Category Added';
	}
	public function getCategory()
	{
		$sqlQuery = "
			SELECT * FROM " . $this->categoryTable . " 
			WHERE id_categoria = '" . $_POST["id_categoria"] . "'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		echo json_encode($row);
	}
	public function updateCategory()
	{
		if ($_POST['categoria']) {
			$sqlInsert = "
				UPDATE " . $this->categoryTable . " 
				SET nombre = '" . $_POST['categoria'] . "'
				WHERE id_categoria = '" . $_POST["id_categoria"] . "'";
			mysqli_query($this->dbConnect, $sqlInsert);
			echo 'Category Update';
		}
	}
	public function deleteCategory()
	{
		$sqlQuery = "DELETE FROM " . $this->categoryTable . " 
			WHERE id_categoria = '" . $_POST["id_categoria"] . "'";
		mysqli_query($this->dbConnect, $sqlQuery);
	}
	// Brand management 
	public function getBrandList()
	{
		$sqlQuery = "SELECT * FROM " . $this->brandTable . " as b 
			INNER JOIN " . $this->categoryTable . " as c ON c.categoryid = b.categoryid ";
		if (!empty($_POST["search"]["value"])) {
			$sqlQuery .= 'WHERE b.bname LIKE "%' . $_POST["search"]["value"] . '%" ';
			$sqlQuery .= 'OR c.name LIKE "%' . $_POST["search"]["value"] . '%" ';
			$sqlQuery .= 'OR b.status LIKE "%' . $_POST["search"]["value"] . '%" ';
		}
		if (!empty($_POST["order"])) {
			$sqlQuery .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
		} else {
			$sqlQuery .= 'ORDER BY b.id DESC ';
		}
		if ($_POST["length"] != -1) {
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$brandData = array();
		while ($brand = mysqli_fetch_assoc($result)) {
			$status = '';
			if ($brand['status'] == 'active') {
				$status = '<span class="label label-success">Active</span>';
			} else {
				$status = '<span class="label label-danger">Inactive</span>';
			}
			$brandRows = array();
			$brandRows[] = $brand['id'];
			$brandRows[] = $brand['bname'];
			$brandRows[] = $brand['name'];
			$brandRows[] = $status;
			$brandRows[] = '<button type="button" name="update" id="' . $brand["id"] . '" class="btn btn-primary btn-sm rounded-0  update" title="Update"><i class="fa fa-edit"></i></button><button type="button" name="delete" id="' . $brand["id"] . '" class="btn btn-danger btn-sm rounded-0  delete" data-status="' . $brand["status"] . '" title="Delete"><i class="fa fa-trash"></i></button>';
			$brandData[] = $brandRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$brandData
		);
		echo json_encode($output);
	}
	public function categoryDropdownList()
	{
		$sqlQuery = "SELECT * FROM " . $this->categoryTable . " 
			ORDER BY nombre ASC";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$categoryHTML = '';
		while ($category = mysqli_fetch_assoc($result)) {
			$categoryHTML .= '<option value="' . $category["id_categoria"] . '">' . $category["nombre"] . '</option>';
		}
		return $categoryHTML;
	}
	public function saveBrand()
	{
		$sqlInsert = "
			INSERT INTO " . $this->brandTable . "(categoryid, bname) 
			VALUES ('" . $_POST["categoryid"] . "', '" . $_POST['bname'] . "')";
		mysqli_query($this->dbConnect, $sqlInsert);
		echo 'New Brand Added';
	}
	public function getBrand()
	{
		$sqlQuery = "
			SELECT * FROM " . $this->brandTable . " 
			WHERE id = '" . $_POST["id"] . "'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		echo json_encode($row);
	}
	public function updateBrand()
	{
		if ($_POST['id']) {
			$sqlUpdate = "UPDATE " . $this->brandTable . " SET bname = '" . $_POST['bname'] . "', categoryid='" . $_POST['categoryid'] . "' WHERE id = '" . $_POST["id"] . "'";
			mysqli_query($this->dbConnect, $sqlUpdate);
			echo 'Brand Update';
		}
	}
	public function deleteBrand()
	{
		$sqlQuery = "
			DELETE FROM " . $this->brandTable . " 
			WHERE id = '" . $_POST["id"] . "'";
		mysqli_query($this->dbConnect, $sqlQuery);
	}
	// Pedido management 
	public function getPedidoList()
	{
		$sqlQuery = "SELECT p.id_pedido,c.nombre as nombrec,p.fecha,p.hora,p.direccion,p.estado FROM " . $this->pedidoTable . " as p   INNER JOIN "  . $this->customerTable .  " as c ON p.id_cliente = c.id_cliente ";
				
		if (isset($_POST["search"]["value"])) {
			$sqlQuery .= 'WHERE p.id_pedido LIKE "%' . $_POST["search"]["value"] . '%" ';
			$sqlQuery .= 'OR c.nombre LIKE "%' . $_POST["search"]["value"] . '%" ';
			$sqlQuery .= 'OR p.fecha LIKE "%' . $_POST["search"]["value"] . '%" ';
			$sqlQuery .= 'OR p.direccion LIKE "%' . $_POST["search"]["value"] . '%" ';
			$sqlQuery .= 'OR p.estado LIKE "%' . $_POST["search"]["value"] . '%" ';
		}
		if (isset($_POST['order'])) {
			$sqlQuery .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
		} else {
			$sqlQuery .= 'ORDER BY p.id_pedido DESC ';
		}
		if ($_POST['length'] != -1) {
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$pedidoData = array();
		while ($pedido = mysqli_fetch_assoc($result)) {
			$pedidoRow = array();
			$pedidoRow[] = $pedido['id_pedido'];
			$pedidoRow[] = $pedido['nombrec'];
			$pedidoRow[] = $pedido['fecha'];
			$pedidoRow[] = $pedido['hora'];
			$pedidoRow[] = $pedido['direccion'];
			$pedidoRow[] = $pedido['estado'];
			$pedidoRow[] = '<div class="btn-group btn-group-sm"><button type="button" name="view" id_pedido="' . $pedido["id_pedido"] . '" class="btn btn-light bg-gradient border text-dark btn-sm rounded-0  view" title="View"><i class="fa fa-eye"></i></button><button type="button" name="update" id_pedido="' . $pedido["id_pedido"] . '" class="btn btn-primary btn-sm rounded-0  update" title="Update"><i class="fa fa-edit"></i></button><button type="button" name="delete" id_pedido="' . $pedido["id_pedido"] . '" class="btn btn-danger btn-sm rounded-0  delete" title="Delete"><i class="fa fa-trash"></i></button></div>';
			//$customerRows[] = '';
			$pedidoData[] = $pedidoRow;
		}
		$outputData = array(
			"draw"    			=> 	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$pedidoData
		);
		echo json_encode($outputData);
	}
	public function getPedidoDetails()
	{
		$sqlQuery = "SELECT p.id_pedido,c.nombre as nombrec,p.fecha,p.hora,p.direccion,p.estado FROM " . $this->pedidoTable . " as p   INNER JOIN "  . $this->customerTable .  " as c ON p.id_cliente = c.id_cliente 
			WHERE p.id_pedido = '" . $_POST["id_pedido"] . "'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		while ($pedido = mysqli_fetch_assoc($result)) {
			$output['id_pedido'] = $pedido['id_pedido'];
			$output['nombrec'] = $pedido['nombrec'];
			$output['fecha'] = $pedido['fecha'];
			$output['hora'] = $pedido['hora'];
			$output['direccion'] = $pedido['direccion'];
			$output['estado'] = $pedido['estado'];
		}
		echo json_encode($output);
	}
	public function viewPedidoDetails()
	{
		$sqlQuery = "SELECT p.id_pedido,c.nombre as nombrec,p.fecha,p.hora,p.direccion,p.estado FROM " . $this->pedidoTable . " as p   INNER JOIN "  . $this->customerTable .  " as c ON p.id_cliente = c.id_cliente 
			WHERE p.id_pedido = '" . $_POST["id_pedido"] . "'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$pedidoDetails = '<div class="table-responsive">
				<table class="table table-boredered">';
		while ($pedido = mysqli_fetch_assoc($result)) {
			$pedidoDetails .= '
			<tr>
				<td>Nombre del Cliente</td>
				<td>' . $pedido["nombrec"] . '</td>
			</tr>
			<tr>
				<td>Fecha</td>
				<td>' . $pedido["fecha"] . '</td>
			</tr>
			<tr>
				<td>Hora</td>
				<td>' . $pedido["hora"] . '</td>
			</tr>
			<tr>
				<td>Direccion</td>
				<td>' . $pedido["direccion"] . '</td>
			</tr>	
			<tr>
					<td>Estado</td>
					<td>' . $pedido["estado"] . '</td>
			</tr>											
			';
		}
		$sqlQuery = "SELECT p.nombre as nombreP,p.precio,dp.cantidad,(p.precio*dp.cantidad) as total FROM ". $this->detallepedidoTable . " AS dp INNER JOIN " . $this->productTable . " AS p ON dp.id_producto=p.id_producto WHERE dp.id_pedido = '". $_POST["id_pedido"] . "'";				
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$totalpago=0;
		$pedidoDetails .= '<tr>
							<div>
								<table style="border-collapse: separate; border-spacing: 15px;">
									<tr>
										<th style="width: 150px;">Producto</th>
										<th style="width: 65px;">Precio</th>
										<th style="width: 50px;">Cantidad</th>
										<th style="width: 50px;">Total</th>
									</tr>';
				while ($detallpedido = mysqli_fetch_assoc($result)) {
					$totalpago +=$detallpedido["total"] ;
					$pedidoDetails .= '
									<tr>						
										<td style="text-align: left; width: 150px;">' . $detallpedido["nombreP"] . '</td>
										<td style="text-align: left; width: 65px;">' . $detallpedido["precio"] . '</td>
										<td style="text-align: center; width: 50px;">' . $detallpedido["cantidad"] . '</td>
										<td style="text-align: center; width: 50px;">' . $detallpedido["total"] . '</td>
									</tr>																															
					';
				}
		$pedidoDetails .= '		</table>
							</div>
						</tr>	
				<div>
					<h3>Total: ' . $totalpago .'</h3>
				</div>
			</table>
		</div>
		';
		echo $pedidoDetails;
	}
	// Product management 
	public function getProductList()
	{
		$sqlQuery = "SELECT p.id_producto,p.nombre,p.descripcion,c.nombre as categoria,p.precio,p.existencia,p.unidad,p.foto  FROM " . $this->productTable . " as p
					INNER JOIN " . $this->categoryTable . " as c ON c.id_categoria = p.id_categoria ";
		if (isset($_POST["search"]["value"])) {
			$sqlQuery .= 'WHERE p.id_producto LIKE "%' . $_POST["search"]["value"] . '%" ';
			$sqlQuery .= 'OR p.nombre LIKE "%' . $_POST["search"]["value"] . '%" ';
			$sqlQuery .= 'OR p.descripcion LIKE "%' . $_POST["search"]["value"] . '%" ';
			$sqlQuery .= 'OR c.nombre LIKE "%' . $_POST["search"]["value"] . '%" ';
			$sqlQuery .= 'OR p.precio LIKE "%' . $_POST["search"]["value"] . '%" ';
			$sqlQuery .= 'OR p.existencia LIKE "%' . $_POST["search"]["value"] . '%" ';
			$sqlQuery .= 'OR p.unidad LIKE "%' . $_POST["search"]["value"] . '%" ';
		}
		if (isset($_POST['order'])) {
			$sqlQuery .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
		} else {
			$sqlQuery .= 'ORDER BY p.id_producto DESC ';
		}
		if ($_POST['length'] != -1) {
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$productData = array();
		while ($product = mysqli_fetch_assoc($result)) {
			$productRow = array();
			$productRow[] = $product['id_producto'];
			$productRow[] = $product['nombre'];
			$productRow[] = $product['descripcion'];
			$productRow[] = $product['categoria'];
			$productRow[] = $product['precio'];
			$productRow[] = $product['existencia'];
			$productRow[] = $product['unidad'];
			$productRow[] = $product["foto"];
			$productRow[] = '<div class="btn-group btn-group-sm"><button type="button" name="view" id_producto="' . $product["id_producto"] . '" class="btn btn-light bg-gradient border text-dark btn-sm rounded-0  view" title="View"><i class="fa fa-eye"></i></button><button type="button" name="update" id_producto="' . $product["id_producto"] . '" class="btn btn-primary btn-sm rounded-0  update" title="Update"><i class="fa fa-edit"></i></button><button type="button" name="delete" id_producto="' . $product["id_producto"] . '" class="btn btn-danger btn-sm rounded-0  delete" title="Delete"><i class="fa fa-trash"></i></button></div>';
			//$customerRows[] = '';
			$productData[] = $productRow;
		}
		$outputData = array(
			"draw"    			=> 	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$productData
		);
		echo json_encode($outputData);
	}
	public function getCategoryBrand($categoryid)
	{
		$sqlQuery = "SELECT * FROM " . $this->brandTable . " 
			WHERE status = 'active' AND categoryid = '" . $categoryid . "'	ORDER BY bname ASC";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$dropdownHTML = '';
		while ($brand = mysqli_fetch_assoc($result)) {
			$dropdownHTML .= '<option value="' . $brand["id"] . '">' . $brand["bname"] . '</option>';
		}
		return $dropdownHTML;
	}
	public function supplierDropdownList()
	{
		$sqlQuery = "SELECT * FROM " . $this->supplierTable . " 
			WHERE status = 'active'	ORDER BY supplier_name ASC";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$dropdownHTML = '';
		while ($supplier = mysqli_fetch_assoc($result)) {
			$dropdownHTML .= '<option value="' . $supplier["supplier_id"] . '">' . $supplier["supplier_name"] . '</option>';
		}
		return $dropdownHTML;
	}
	public function addProduct()
	{
		$sqlInsert = "
			INSERT INTO " . $this->productTable . "(nombre, descripcion, id_categoria, precio, existencia, unidad, foto) 
			VALUES ('" . $_POST["nombre"] . "', '" . $_POST['descripcion'] . "', '" . $_POST['categoria'] . "', '" . $_POST['precio'] . "', '" . $_POST['existencia'] . "', '" . $_POST['unidad'] . "', '" . $_POST['foto'] . "')";
		mysqli_query($this->dbConnect, $sqlInsert);
		echo 'New Product Added';
	}
	public function getProductDetails()
	{
		$sqlQuery = "SELECT p.id_producto,p.nombre,p.descripcion,c.nombre as categoria,p.precio,p.existencia,p.unidad,p.foto  FROM " . $this->productTable . " as p
		INNER JOIN " . $this->categoryTable . " as c ON c.id_categoria = p.id_categoria  
			WHERE p.id_producto = '" . $_POST["id_producto"] . "'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		while ($product = mysqli_fetch_assoc($result)) {
			$output['id_producto'] = $product['id_producto'];
			$output['nombre'] = $product['nombre'];
			$output['descripcion'] = $product['descripcion'];
			$output['categoria'] = $product['categoria'];
			$output['precio'] = $product['precio'];
			$output['existencia'] = $product['existencia'];
			$output['unidad'] = $product['unidad'];
			$output['foto'] = $product['foto'];
		}
		echo json_encode($output);
	}
	public function updateProduct()
	{
		if ($_POST['id_producto']) {
			$sqlUpdate = "UPDATE " . $this->productTable . " 
				SET id_categoria = '" . $_POST['categoria'] . "', nombre='" . $_POST['nombre'] . "', descripcion='" . $_POST['descripcion'] . "', precio='" . $_POST['precio'] . "', existencia='" . $_POST['existencia'] . "', unidad='" . $_POST['unidad'] . "', foto='" . $_POST['foto'] . "'  WHERE id_producto = '" . $_POST["id_producto"] . "'";
			mysqli_query($this->dbConnect, $sqlUpdate);
			echo 'Product Update';
		}
	}
	public function deleteProduct()
	{
		$sqlQuery = "
			DELETE FROM " . $this->productTable . " 
			WHERE id_producto = '" . $_POST["id_producto"] . "'";
		mysqli_query($this->dbConnect, $sqlQuery);
	}
	public function viewProductDetails()
	{
		$sqlQuery = "SELECT p.id_producto,p.nombre,p.descripcion,c.nombre as categoria,p.precio,p.existencia,p.unidad,p.foto  FROM " . $this->productTable . " as p
		INNER JOIN " . $this->categoryTable . " as c ON c.id_categoria = p.id_categoria  
			WHERE p.id_producto = '" . $_POST["id_producto"] . "'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$productDetails = '<div class="table-responsive">
				<table class="table table-boredered">';
		while ($product = mysqli_fetch_assoc($result)) {
			$productDetails .= '
			<tr>
				<td>Nombre de Producto</td>
				<td>' . $product["nombre"] . '</td>
			</tr>
			<tr>
				<td>Descripción de Producto</td>
				<td>' . $product["descripcion"] . '</td>
			</tr>
			<tr>
				<td>Categoría</td>
				<td>' . $product["categoria"] . '</td>
			</tr>
			<tr>
				<td>Precio</td>
				<td>' . $product["precio"] . '</td>
			</tr>			
			<tr>
				<td>Cantidad Disponible</td>
				<td>' . $product["existencia"] . ' ' . $product["unidad"] . '</td>
			</tr>
			<tr>
				<td>Foto</td>
				<td>' . $product["foto"] . '</td>
			</tr>			
			';
		}
		$productDetails .= '
			</table>
		</div>
		';
		echo $productDetails;
	}
	// supplier 
	public function getSupplierList()
	{
		$sqlQuery = "SELECT * FROM " . $this->supplierTable . " ";
		if (!empty($_POST["search"]["value"])) {
			$sqlQuery .= 'WHERE (supplier_name LIKE "%' . $_POST["search"]["value"] . '%" ';
			$sqlQuery .= '(address LIKE "%' . $_POST["search"]["value"] . '%" ';
		}
		if (!empty($_POST["order"])) {
			$sqlQuery .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
		} else {
			$sqlQuery .= 'ORDER BY supplier_id DESC ';
		}
		if ($_POST["length"] != -1) {
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$supplierData = array();
		while ($supplier = mysqli_fetch_assoc($result)) {
			$status = '';
			if ($supplier['status'] == 'active') {
				$status = '<span class="label label-success">Active</span>';
			} else {
				$status = '<span class="label label-danger">Inactive</span>';
			}
			$supplierRows = array();
			$supplierRows[] = $supplier['supplier_id'];
			$supplierRows[] = $supplier['supplier_name'];
			$supplierRows[] = $supplier['mobile'];
			$supplierRows[] = $supplier['address'];
			$supplierRows[] = $status;
			$supplierRows[] = '<div class="btn-group btn-group-sm"><button type="button" name="update" id="' . $supplier["supplier_id"] . '" class="btn btn-primary btn-sm rounded-0  update" title="Update"><i class="fa fa-edit"></i></button><button type="button" name="delete" id="' . $supplier["supplier_id"] . '" class="btn btn-danger btn-sm rounded-0  delete"  title="Delete"><i class="fa fa-trash"></i></button></div>';
			$supplierData[] = $supplierRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$supplierData
		);
		echo json_encode($output);
	}
	public function addSupplier()
	{
		$sqlInsert = "
			INSERT INTO " . $this->supplierTable . "(supplier_name, mobile, address) 
			VALUES ('" . $_POST['supplier_name'] . "', '" . $_POST['mobile'] . "', '" . $_POST['address'] . "')";
		mysqli_query($this->dbConnect, $sqlInsert);
		echo 'New Supplier Added';
	}
	public function getSupplier()
	{
		$sqlQuery = "
			SELECT * FROM " . $this->supplierTable . " 
			WHERE supplier_id = '" . $_POST["supplier_id"] . "'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		echo json_encode($row);
	}
	public function updateSupplier()
	{
		if ($_POST['supplier_id']) {
			$sqlUpdate = "
				UPDATE " . $this->supplierTable . " 
				SET supplier_name = '" . $_POST['supplier_name'] . "', mobile= '" . $_POST['mobile'] . "' , address= '" . $_POST['address'] . "'	WHERE supplier_id = '" . $_POST['supplier_id'] . "'";
			mysqli_query($this->dbConnect, $sqlUpdate);
			echo 'Supplier Edited';
		}
	}
	public function deleteSupplier()
	{
		$sqlQuery = "
			DELETE FROM " . $this->supplierTable . " 
			WHERE supplier_id = '" . $_POST['supplier_id'] . "'";
		mysqli_query($this->dbConnect, $sqlQuery);
	}
	// purchase
	public function listPurchase()
	{
		$sqlQuery = "SELECT ph.*, p.pname, s.supplier_name FROM " . $this->purchaseTable . " as ph
			INNER JOIN " . $this->productTable . " as p ON p.pid = ph.product_id 
			INNER JOIN " . $this->supplierTable . " as s ON s.supplier_id = ph.supplier_id ";
		if (isset($_POST['order'])) {
			$sqlQuery .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
		} else {
			$sqlQuery .= 'ORDER BY ph.purchase_id DESC ';
		}
		if ($_POST['length'] != -1) {
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$purchaseData = array();
		while ($purchase = mysqli_fetch_assoc($result)) {
			$productRow = array();
			$productRow[] = $purchase['purchase_id'];
			$productRow[] = $purchase['pname'];
			$productRow[] = $purchase['quantity'];
			$productRow[] = $purchase['supplier_name'];
			$productRow[] = '<div class="btn-group btn-group-sm"><button type="button" name="update" id="' . $purchase["purchase_id"] . '" class="btn btn-primary btn-sm rounded-0  update" title="Update"><i class="fa fa-edit"></i></button><button type="button" name="delete" id="' . $purchase["purchase_id"] . '" class="btn btn-danger btn-sm rounded-0  delete" title="Delete"><i class="fa fa-trash"></i></button></div>';
			$purchaseData[] = $productRow;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$purchaseData
		);
		echo json_encode($output);
	}
	public function productDropdownList()
	{
		$sqlQuery = "SELECT * FROM " . $this->productTable . " ORDER BY pname ASC";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$dropdownHTML = '';
		while ($product = mysqli_fetch_assoc($result)) {
			$dropdownHTML .= '<option value="' . $product["pid"] . '">' . $product["pname"] . '</option>';
		}
		return $dropdownHTML;
	}
	public function addPurchase()
	{
		$sqlInsert = "
			INSERT INTO " . $this->purchaseTable . "(product_id, quantity, supplier_id) 
			VALUES ('" . $_POST['product'] . "', '" . $_POST['quantity'] . "', '" . $_POST['supplierid'] . "')";
		mysqli_query($this->dbConnect, $sqlInsert);
		echo 'New Purchase Added';
	}
	public function getPurchaseDetails()
	{
		$sqlQuery = "
			SELECT * FROM " . $this->purchaseTable . " 
			WHERE purchase_id = '" . $_POST["purchase_id"] . "'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		echo json_encode($row);
	}
	public function updatePurchase()
	{
		if ($_POST['purchase_id']) {
			$sqlUpdate = "
				UPDATE " . $this->purchaseTable . " 
				SET product_id = '" . $_POST['product'] . "', quantity= '" . $_POST['quantity'] . "' , supplier_id= '" . $_POST['supplierid'] . "'	WHERE purchase_id = '" . $_POST['purchase_id'] . "'";
			mysqli_query($this->dbConnect, $sqlUpdate);
			echo 'Purchase Edited';
		}
	}
	public function deletePurchase()
	{
		$sqlQuery = "
			DELETE FROM " . $this->purchaseTable . " 
			WHERE purchase_id = '" . $_POST['purchase_id'] . "'";
		mysqli_query($this->dbConnect, $sqlQuery);
	}
	// order
	public function listOrders()
	{
		$sqlQuery = "SELECT * FROM " . $this->orderTable . " as o
			INNER JOIN " . $this->customerTable . " as c ON c.id = o.customer_id
			INNER JOIN " . $this->productTable . " as p ON p.pid = o.product_id ";
		if (isset($_POST['order'])) {
			$sqlQuery .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
		} else {
			$sqlQuery .= 'ORDER BY o.order_id DESC ';
		}
		if ($_POST['length'] != -1) {
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$orderData = array();
		while ($order = mysqli_fetch_assoc($result)) {
			$orderRow = array();
			$orderRow[] = $order['order_id'];
			$orderRow[] = $order['pname'];
			$orderRow[] = $order['total_shipped'];
			$orderRow[] = $order['name'];
			$orderRow[] = '<div class="btn-group btn-group-sm"><button type="button" name="update" id="' . $order["order_id"] . '" class="btn btn-primary btn-sm rounded-0  update" title="Update"><i class="fa fa-edit"></i></button><button type="button" name="delete" id="' . $order["order_id"] . '" class="btn btn-danger btn-sm rounded-0  delete" title="Delete"><i class="fa fa-trash"></i></button></button';
			$orderData[] = $orderRow;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$orderData
		);
		echo json_encode($output);
	}
	public function addOrder()
	{
		$sqlInsert = "
			INSERT INTO " . $this->orderTable . "(product_id, total_shipped, customer_id) 
			VALUES ('" . $_POST['product'] . "', '" . $_POST['shipped'] . "', '" . $_POST['customer'] . "')";
		mysqli_query($this->dbConnect, $sqlInsert);
		echo 'New order added';
	}
	public function getOrderDetails()
	{
		$sqlQuery = "
			SELECT * FROM " . $this->orderTable . " 
			WHERE order_id = '" . $_POST["order_id"] . "'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		echo json_encode($row);
	}
	public function updateOrder()
	{
		if ($_POST['order_id']) {
			$sqlUpdate = "
				UPDATE " . $this->orderTable . " 
				SET product_id = '" . $_POST['product'] . "', total_shipped='" . $_POST['shipped'] . "', customer_id='" . $_POST['customer'] . "' WHERE order_id = '" . $_POST['order_id'] . "'";
			mysqli_query($this->dbConnect, $sqlUpdate);
			echo 'Order Edited';
		}
	}
	public function deleteOrder()
	{
		$sqlQuery = "
			DELETE FROM " . $this->orderTable . " 
			WHERE order_id = '" . $_POST['order_id'] . "'";
		mysqli_query($this->dbConnect, $sqlQuery);
	}
	public function customerDropdownList()
	{
		$sqlQuery = "SELECT * FROM " . $this->customerTable . " ORDER BY name ASC";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$dropdownHTML = '';
		while ($customer = mysqli_fetch_assoc($result)) {
			$dropdownHTML .= '<option value="' . $customer["id"] . '">' . $customer["name"] . '</option>';
		}
		return $dropdownHTML;
	}
	public function getInventoryDetails()
	{
		$sqlQuery = "SELECT p.pid, p.pname, p.model, p.quantity as product_quantity, s.quantity as recieved_quantity, r.total_shipped
			FROM " . $this->productTable . " as p
			LEFT JOIN " . $this->purchaseTable . " as s ON s.product_id = p.pid
			LEFT JOIN " . $this->orderTable . " as r ON r.product_id = p.pid ";
		if (isset($_POST['order'])) {
			$sqlQuery .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
		} else {
			$sqlQuery .= 'ORDER BY p.pid DESC ';
		}
		if ($_POST['length'] != -1) {
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$inventoryData = array();
		$i = 1;
		while ($inventory = mysqli_fetch_assoc($result)) {

			if (!$inventory['recieved_quantity']) {
				$inventory['recieved_quantity'] = 0;
			}
			if (!$inventory['total_shipped']) {
				$inventory['total_shipped'] = 0;
			}

			$inventoryInHand = ($inventory['product_quantity'] + $inventory['recieved_quantity']) - $inventory['total_shipped'];

			$inventoryRow = array();
			$inventoryRow[] = $i++;
			$inventoryRow[] = "<div class='lh-1'><div>{$inventory['pname']}</div><div class='fw-bolder text-muted'><small>{$inventory['model']}</small></div></div>";
			// $inventoryRow[] = $inventory['pname'];
			// $inventoryRow[] = $inventory['model'];
			$inventoryRow[] = $inventory['product_quantity'];
			$inventoryRow[] = $inventory['recieved_quantity'];
			$inventoryRow[] = $inventory['total_shipped'];
			$inventoryRow[] = $inventoryInHand;
			$inventoryData[] = $inventoryRow;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$inventoryData
		);
		echo json_encode($output);
	}
}
