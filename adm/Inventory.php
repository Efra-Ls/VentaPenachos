<?php
class Inventory
{
	private $host  = 'localhost';
	private $user  = 'root';
	private $password   = '';
	private $database  = 'bdgpsvp';
	private $userTable = 'usuario';
	private $customerTable = 'cliente';
	private $categoryTable = 'categoria';
	private $pedidoTable = 'pedido';
	private $detallepedidoTable = 'detalle_pedido';
	private $brandTable = 'ims_brand';
	private $productTable = 'producto';
	private $promocionTable = 'promocion';
	private $carritoTable = 'carrito';
	private $detallecarritoTable = 'detallecarrito';
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
			SELECT * FROM " . $this->customerTable . " AS c
			INNER JOIN ".$this->userTable." AS u ON c.correo=u.correo WHERE id_cliente = '" . $_POST["userid"] . "'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		echo json_encode($row);
	}
	public function getCustomerInicio()
	{
		$sqlQuery = "
			SELECT * FROM " . $this->customerTable . " 
			WHERE id_cliente = '" . $_POST["userid"] . "'";
			$result = mysqli_query($this->dbConnect, $sqlQuery);
			while ($product = mysqli_fetch_assoc($result)) {
				$output['id_cliente'] = $product['id_cliente'];
				$output['nombre'] = $product['nombre'];
				$output['domicilio'] = $product['domicilio'];
				$output['telefono'] = $product['telefono'];
				$output['correo'] = $product['correo'];				
			}
			echo json_encode($output);
	}
	public function getContraInicio()
	{
		$sqlQuery = "
			SELECT * FROM " . $this->userTable . " 
			WHERE correo = '" . $_POST["correo"] . "'";
			$result = mysqli_query($this->dbConnect, $sqlQuery);
			while ($product = mysqli_fetch_assoc($result)) {
				$output['correo'] = $product['correo'];
				$output['contrasenia'] = $product['contrasenia'];		
			}
			echo json_encode($output);
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
	
	public function getmisComprasList()
	{
		$sqlQuery = "SELECT * FROM pedido AS p INNER JOIN detalle_pedido AS dp ON p.id_pedido=dp.id_pedido INNER JOIN producto AS pr ON dp.id_producto=pr.id_producto WHERE p.id_cliente=". $_POST['id_cliente']." ";

		if (!empty($_POST["search"]["value"])) { 			
			$sqlQuery .= 'AND pr.nombre LIKE "%' . $_POST["search"]["value"] . '%" ';	
		}
		
		if (!empty($_POST["order"])) {
			$sqlQuery .= ' ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
		} 
		else {
			$sqlQuery .= ' ORDER BY p.id_pedido ASC ';
		}


		if ($_POST["length"] != -1) {
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}

		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$customerData = array();
		while ($customer = mysqli_fetch_assoc($result)) {
				
		// Obtén los datos de la imagen de la base de datos
		$imageData = $customer["fotoprincipal"];
		// Convierte los datos de la imagen en una cadena base64
		$imageBase64 = base64_encode($imageData);
		// Crea una URL de datos que puede ser utilizada en la etiqueta <img>
		$imageSrc = 'data:image/jpeg;base64,' . $imageBase64;
			

			$customerRows = array();
			$customerRows[] = '<td class="product-thumbnail">
									<a href="#"><img src="' . $imageSrc . '" class="product-image" alt=""></a>
								</td>';
			$customerRows[] = '<td class="product-name"><a href="#">'.$customer['nombre'].'</a></td>';
			$customerRows[] = '<td class="product-price-cart"><span class="amount">$'.$customer['precio'].'</span></td>';
			$customerRows[] = '<td class="product-quantity">
									<div class="cart-plus-minus">
										<input class="cart-plus-minus-box" type="text" name="qtybutton"
											value="'.$customer['cantidad'].'">
									</div>
								</td>';
			$customerRows[] = '<td class="product-subtotal">'. ($customer['cantidad']*$customer['precio']) .'</td>';
			$customerRows[] = '<td class="product-wishlist-cart">
									<a href="#">++ carrito</a>
								</td>';
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
	
	public function getmiscosasCarrito()
	{
		$sqlQuery = "SELECT * FROM carrito AS c INNER JOIN detallecarrito AS dc ON c.id_carrito = dc.id_carrito INNER JOIN producto AS pr ON dc.id_producto=pr.id_producto WHERE c.id_cliente=". $_POST['id_cliente']." ";

		if (!empty($_POST["search"]["value"])) { 			
			$sqlQuery .= 'AND pr.nombre LIKE "%' . $_POST["search"]["value"] . '%" ';	
		}
		
		if (!empty($_POST["order"])) {
			$sqlQuery .= ' ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
		} 
		else {
			$sqlQuery .= ' ORDER BY c.id_carrito ASC ';
		}


		if ($_POST["length"] != -1) {
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}

		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$customerData = array();
		while ($customer = mysqli_fetch_assoc($result)) {
				
		// Obtén los datos de la imagen de la base de datos
		$imageData = $customer["fotoprincipal"];
		// Convierte los datos de la imagen en una cadena base64
		$imageBase64 = base64_encode($imageData);
		// Crea una URL de datos que puede ser utilizada en la etiqueta <img>
		$imageSrc = 'data:image/jpeg;base64,' . $imageBase64;
			

			$customerRows = array();
			$customerRows[] = '<td class="product-thumbnail">
									<a href="#"><img src="' . $imageSrc . '" class="product-image" alt=""></a>
								</td>';
			$customerRows[] = '<td class="product-name"><a href="#">'.$customer['nombre'].'</a></td>';
			$customerRows[] = '<td class="product-price-cart"><span class="amount">$'.$customer['precio'].'</span></td>';
			$customerRows[] = '<td class="product-quantity">
									<div class="cart-plus-minus">
										<input class="cart-plus-minus-box" type="text" name="qtybutton"
											value="'.$customer['cantidad'].'">
									</div>
								</td>';
			$customerRows[] = '<td class="product-subtotal">'. ($customer['cantidad']*$customer['precio']) .'</td>';
			$customerRows[] = ' <td class="product-remove">
									<a href="#"><i class="fa fa-pencil"></i></a>
									<a href="#"><i class="fa fa-times"></i></a>
								</td>';
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
			VALUES ('" . $_POST['correo'] . "', '" . $_POST['passwordR'] . "', 'cliente')";
		mysqli_query($this->dbConnect, $sqlInsert);		

		$sqlInsert = "			
			INSERT INTO " . $this->customerTable . "(nombre, domicilio, telefono, correo) 
			VALUES ('" . $_POST['cnombre'] . "', '" . $_POST['domicilio'] . "', '" . $_POST['telefono'] . "', '" . $_POST['correo'] . "')";
		mysqli_query($this->dbConnect, $sqlInsert);

		echo 'New Customer Added';
	}

	public function agregaralCarrito()
	{
		$sqlInsert = "
			INSERT INTO " . $this->detallecarritoTable . "
			VALUES ('" . $_POST['id_carrito'] . "', '" . $_POST['id_producto'] . "', '" . $_POST['cantidad'] . "')";
		mysqli_query($this->dbConnect, $sqlInsert);		

		echo 'Agredado al carrito';
	}
	

	public function updateCustomer()
	{
		if ($_POST['userid']) {
			$sqlInsert = "
				UPDATE " . $this->customerTable . " 
				SET nombre = '" . $_POST['cnombre'] . "', domicilio= '" . $_POST['domicilio'] . "', telefono = '" . $_POST['telefono'] . "', correo = '" . $_POST['correo'] . "' 
				WHERE id_cliente = '" . $_POST['userid'] . "'";
			mysqli_query($this->dbConnect, $sqlInsert);

			if(!empty($_POST['passwordR'] )){
				$sqlInsertuser = "
					UPDATE " . $this->userTable . " 
					SET contrasenia = '" .$_POST['passwordR'] . "' 
					WHERE correo = '" . $_POST['correo'] . "'";
				mysqli_query($this->dbConnect, $sqlInsertuser);
			}
			echo 'Customer Edited';
		}
	}
	public function updateContraPerfil()
	{

			if(!empty($_POST['passwordR'] )){
				$sqlInsertuser = "
					UPDATE " . $this->userTable . " 
					SET contrasenia = '" .$_POST['passwordR'] . "' 
					WHERE correo = '" . $_POST['correoU'] . "'";
				mysqli_query($this->dbConnect, $sqlInsertuser);
			}
			echo 'Customer Edited';
	}

	public function updateDireccionPerfil()
	{
				$sqlInsertuser = "
					UPDATE " . $this->customerTable . " 
					SET domicilio = '" .$_POST['domicilio2'] . "' 
					WHERE id_cliente = '" . $_POST['id_clienteD'] . "'";
				mysqli_query($this->dbConnect, $sqlInsertuser);
			echo 'Customer Edited';
	}
	
	public function updateCustomerPerfil()
	{
		if ($_POST['userid']) {
			$sqlInsert = "
				UPDATE " . $this->customerTable . " 
				SET nombre = '" . $_POST['cnombre'] . "', domicilio= '" . $_POST['domicilio'] . "', telefono = '" . $_POST['telefono'] . "' 
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
	public function promocionDropdownList()
	{
		$sqlQuery = "SELECT * FROM " . $this->promocionTable . " 
			ORDER BY nombre ASC";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$promocionHTML = '';
		while ($promocion = mysqli_fetch_assoc($result)) {
			$promocionHTML .= '<option value="' . $promocion["id_promocion"] . '">' . $promocion["nombre"] . '</option>';
		}
		return $promocionHTML;
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
			$pedidoRow[] = '<div class="btn-group btn-group-sm"><button type="button" name="view" id_pedido="' . $pedido["id_pedido"] . '" class="btn btn-light bg-gradient border text-dark btn-sm rounded-0  view" title="View"><i class="fa fa-eye"></i></button><button type="button" name="update" id_pedido="' . $pedido["id_pedido"] . '" class="btn btn-primary btn-sm rounded-0  update" title="Update"><i class="fa fa-edit"></i></button></div>';
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
	public function listPedidoNoenviados()
	{
		$sqlQuery = "SELECT p.id_pedido,c.nombre as nombrec,p.fecha,p.hora,p.direccion,p.estado FROM " . $this->pedidoTable . " as p    INNER JOIN "  . $this->customerTable .  " as c ON p.id_cliente = c.id_cliente  WHERE p.estado='Pagado'";
				
		if (isset($_POST["search"]["value"])) {
			$sqlQuery .= ' OR p.id_pedido LIKE "%' . $_POST["search"]["value"] . '%" ';
			$sqlQuery .= ' OR c.nombre LIKE "%' . $_POST["search"]["value"] . '%" ';
			$sqlQuery .= ' OR p.fecha LIKE "%' . $_POST["search"]["value"] . '%" ';
			$sqlQuery .= ' OR p.direccion LIKE "%' . $_POST["search"]["value"] . '%" ';
			
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
			//$pedidoRow[] = $pedido['estado'];
			
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
		$sqlQuery = "SELECT p.id_producto,p.nombre,p.descripcion,c.nombre as categoria,p.precio,p.existencia,p.unidad,p.fotoprincipal,pr.nombre as promocion  FROM " . $this->productTable . " as p INNER JOIN " . $this->categoryTable . " as c ON c.id_categoria = p.id_categoria INNER JOIN " . $this->promocionTable . " as pr ON pr.id_promocion = p.id_promocion ";
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
			$productRow[] = $product['promocion'];
			$productRow[] = "$" . number_format($product['precio'], 2, '.', ',');
			$productRow[] = $product['existencia'];
			$productRow[] = $product['unidad'];
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

	//prociones lista
	public function getPromocionList()
	{
		$sqlQuery = "SELECT * FROM  ". $this->promocionTable ."  as p  ";
		if (isset($_POST["search"]["value"])) {
			$sqlQuery .= ' WHERE p.id_promocion LIKE "%' . $_POST["search"]["value"] . '%" ';
			$sqlQuery .= ' OR p.nombre LIKE "%' . $_POST["search"]["value"] . '%" ';
			$sqlQuery .= ' OR p.descripcion LIKE "%' . $_POST["search"]["value"] . '%" ';
			$sqlQuery .= ' OR p.tipo LIKE "%' . $_POST["search"]["value"] . '%" ';
		}
		if (isset($_POST['order'])) {
			$sqlQuery .= ' ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
		} else {
			$sqlQuery .= ' ORDER BY p.id_promocion DESC ';
		}
		if ($_POST['length'] != -1) {
			$sqlQuery .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$productData = array();
		while ($product = mysqli_fetch_assoc($result)) {
			$productRow = array();
			$productRow[] = $product['id_promocion'];
			$productRow[] = $product['nombre'];
			$productRow[] = $product['descripcion'];
			$productRow[] = $product['tipo'];
			$productRow[] = '<div class="btn-group btn-group-sm"><button type="button" name="view" id_promocion="' . $product["id_promocion"] . '" class="btn btn-light bg-gradient border text-dark btn-sm rounded-0  view" title="View"><i class="fa fa-eye"></i></button><button type="button" name="update" id_promocion="' . $product["id_promocion"] . '" class="btn btn-primary btn-sm rounded-0  update" title="Update"><i class="fa fa-edit"></i></button><button type="button" name="delete" id_promocion="' . $product["id_promocion"] . '" class="btn btn-danger btn-sm rounded-0  delete" title="Delete"><i class="fa fa-trash"></i></button></div>';
			
			$productRow[] = $product['umbral_cantidad_descuento'];
			$productRow[] = $product['porcentaje_descuento'];
			$productRow[] = $product['cantidad_compra_regalo'];
			$productRow[] = $product['cantidad_regalo'];
			$productRow[] = $product['fecha_inicio_limitado'];
			$productRow[] = $product['fecha_fin_limitado'];
			$productRow[] = $product['fecha_fin_limitado'];
		
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
	//promcion agregar
	//promcion
	public function viewPromocionDetails()
	{
		$sqlQuery = "SELECT *  FROM " . $this->promocionTable . " as p		 
			WHERE p.id_promocion = '" . $_POST["id_promocion"] . "'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$productDetails = '<div class="table-responsive">
				<table class="table table-boredered">';

		while ($product = mysqli_fetch_assoc($result)) {
			
		// Obtén los datos de la imagen de la base de datos		
			$productDetails .= '
			<tr>
				<td>Nombre </td>
				<td>' . $product["nombre"] . '</td>
			</tr>
			<tr>
				<td>Descripción </td>
				<td>' . $product["descripcion"] . '</td>
			</tr>
			<tr>
				<td>Tipo </td>
				<td>' . $product["tipo"] . '</td>
			</tr>';

			if($product["tipo"]=== 'Descuento por cantidad'){
				$productDetails .= '
				<tr>
					<td>Cantidad mínima de productos para aplicar la promoción </td>
					<td>' . $product["umbral_cantidad_descuento"] . '</td>
				</tr>
				<tr>
					<td>Porcentaje de descuento </td>
					<td> ' . $product["porcentaje_descuento"]*100 . '%</td>
				</tr>';
			}
			if($product["tipo"]=== 'Regalo con compra'){
				$productDetails .= '
				<tr>
					<td>Cantidad mínima de productos para aplicar la promoción</td>
					<td>' . $product["cantidad_compra_regalo"] . '</td>
				</tr>
				<tr>
					<td>Cantidad de productos regalados</td>
					<td>' . $product["cantidad_regalo"] . '</td>
				</tr>';
			}
			if($product["tipo"]=== 'Descuento por tiempo limitado'){
				$productDetails .= '
				<tr>
					<td>Fecha de inicio de la promoción</td>
					<td>' . $product["fecha_inicio_limitado"] . '</td>
				</tr>
				<tr>
					<td>Fecha de finalización de la promoción</td>
					<td>' . $product["fecha_fin_limitado"] . '</td>
				</tr>
				<tr>
					<td>Porcentaje de descuento</td>
					<td>' . $product["porcentaje_descuento_limitado"]*100 . '%</td>
				</tr>
				';
			}
		}
		$productDetails .= '
			</table>
		</div>
		';
		echo $productDetails;
	}
	public function addPromocion()
{						
    // Definir todos los campos y su orden correcto
    $campos = array(
        'nombre',
        'descripcion',
        'tipo',
        'umbral_cantidad_descuento',
        'porcentaje_descuento',
        'cantidad_compra_regalo',
        'cantidad_regalo',
        'fecha_inicio_limitado',
        'fecha_fin_limitado',
        'porcentaje_descuento_limitado'
    );
    
    // Preparar la consulta SQL con los campos y valores correspondientes
    $sqlInsert = "
    INSERT INTO " . $this->promocionTable . "
    (nombre, descripcion, tipo, umbral_cantidad_descuento, porcentaje_descuento, cantidad_compra_regalo, cantidad_regalo, fecha_inicio_limitado, fecha_fin_limitado, porcentaje_descuento_limitado) 
    VALUES (";

    foreach ($campos as $campo) {
        $valor = (!empty($_POST[$campo]))? $_POST[$campo] : "NULL";
        
        if (($campo === 'porcentaje_descuento' && !empty($_POST[$campo]) ) || ($campo === 'porcentaje_descuento_limitado')&& !empty($_POST[$campo]) ) {
            $valor = str_replace('%', "", $valor);
            $valor = $valor / 100;
        }

        if ($campo === 'porcentaje_descuento_limitado') {
            if ($valor === 'NULL') {
                $sqlInsert .= "NULL";
            } else {
                $sqlInsert .= "'" . $valor . "'";
            }
        } else {
            if ($valor === "NULL") {
                $sqlInsert .= "NULL,";
            } else {
                $sqlInsert .= "'" . $valor . "',";
            }
        }
    }

    $sqlInsert .= ")";

    echo $sqlInsert;

    // Ejecutar la consulta SQL
    mysqli_query($this->dbConnect, $sqlInsert);
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
    $precio = str_replace(',', '', $_POST['precio']);
    $precio = substr($precio, 1);
    $sqlInsert = "INSERT INTO " . $this->productTable . "(nombre, descripcion, id_categoria, precio, existencia, unidad, fotoprincipal, id_promocion) 
                  VALUES (?, ?, ?, ?, ?, ?, '', ?)";
    $stmtInsert = mysqli_prepare($this->dbConnect, $sqlInsert);
    mysqli_stmt_bind_param($stmtInsert, "sssssss", $_POST["nombre"], $_POST['descripcion'], $_POST['categoria'], $precio, $_POST['existencia'], $_POST['unidad'], $_POST['promocion']);
    mysqli_stmt_execute($stmtInsert);

    if(mysqli_stmt_affected_rows($stmtInsert)>0){
		$lastInsertedId = mysqli_insert_id($this->dbConnect); // Obtener el ID del producto insertado
		
		$fotos = array("fotoprincipal", "foto1", "foto2", "foto3", "foto4", "foto5");
		foreach ($fotos as $foto) {
			if (isset($_FILES[$foto]["tmp_name"]) ) {
				try {
					if (getimagesize($_FILES[$foto]["tmp_name"]) !== false) {
						$image = $_FILES[$foto]['tmp_name'];
						$imgContenido = addslashes(file_get_contents($image));	
						$sqlUpdateFoto = "UPDATE " . $this->productTable . " 
										SET " . $foto . " = ?  
										WHERE id_producto = ?";
						$stmtUpdateFoto = mysqli_prepare($this->dbConnect, $sqlUpdateFoto);
						mysqli_stmt_bind_param($stmtUpdateFoto, "ss", $imgContenido, $lastInsertedId);
						mysqli_stmt_execute($stmtUpdateFoto);					
					}
				} catch (Exception $e) {
					// Manejo del error: mostrar un mensaje de error o realizar alguna acción de manejo de errores
					echo "<script>console.log('Error: " . $e->getMessage() . "');</script>";
				}
			}
		}
	}
}

	
	public function getPromocionDetails()
	{
		$sqlQuery = "SELECT *  FROM " . $this->promocionTable . " as p		
					WHERE p.id_promocion = '" . $_POST["id_promocion"] . "'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		while ($product = mysqli_fetch_assoc($result)) {
			$output['id_promocion'] = $product['id_promocion'];
			$output['nombre'] = $product['nombre'];
			$output['descripcion'] = $product['descripcion'];
			$output['tipo'] = $product['tipo'];
			$output['umbral_cantidad_descuento'] = $product['umbral_cantidad_descuento'];		
			$output['porcentaje_descuento'] = ($product['porcentaje_descuento']*100) . "%";
			$output['cantidad_compra_regalo'] = $product['cantidad_compra_regalo'];
			$output['cantidad_regalo'] = $product['cantidad_regalo'];
			$output['fecha_inicio_limitado'] = $product['fecha_inicio_limitado'];
			$output['fecha_fin_limitado'] = $product['fecha_fin_limitado'];
			$output['porcentaje_descuento_limitado'] = $product['porcentaje_descuento_limitado'];
			//$output['foto'] = $product['foto'];
		}
		echo json_encode($output);
	}
	public function getProductDetails()
	{
		$sqlQuery = "SELECT p.id_producto,p.nombre,p.descripcion,c.id_categoria as categoria,p.precio,p.existencia,p.unidad,p.fotoprincipal,pr.id_promocion as promocion  FROM " . $this->productTable . " as p
		INNER JOIN " . $this->categoryTable . " as c ON c.id_categoria = p.id_categoria INNER JOIN " . $this->promocionTable . " as pr ON pr.id_promocion = p.id_promocion 
			WHERE p.id_producto = '" . $_POST["id_producto"] . "'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		while ($product = mysqli_fetch_assoc($result)) {
			$output['id_producto'] = $product['id_producto'];
			$output['nombre'] = $product['nombre'];
			$output['descripcion'] = $product['descripcion'];
			$output['categoria'] = $product['categoria'];
			$output['promocion'] = $product['promocion'];
			$output['precio'] = "$" . number_format($product['precio'], 2, '.', ',');
			$output['existencia'] = $product['existencia'];
			$output['unidad'] = $product['unidad'];
			//$output['foto'] = $product['foto'];
		}
		echo json_encode($output);
	}
	public function cargarExistencia()
	{
		$sqlQuery = "SELECT * FROM producto WHERE id_producto = '" . $_POST["id_producto"] . "'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		while ($product = mysqli_fetch_assoc($result)) {
			$output['existencia'] = $product['existencia'];
			$output['id_producto'] = $product['id_producto'];
			//$output['foto'] = $product['foto'];
		}
		echo json_encode($output);
	}

	public function cargarIdCarrito()
	{
		$sqlQuery = "SELECT * FROM carrito WHERE id_cliente = '" . $_POST["id_cliente"] . "'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		while ($product = mysqli_fetch_assoc($result)) {
			$output['id_carrito'] = $product['id_carrito'];
			//$output['foto'] = $product['foto'];
		}
		echo json_encode($output);
	}
	
	public function updateProduct()
	{		
		$precio = str_replace(',', '', $_POST['precio']);
		$precio = substr($precio, 1);
		$sqlUpdate = "UPDATE " . $this->productTable . " 
						SET id_categoria = '" . $_POST['categoria'] . "', nombre='" . $_POST['nombre'] . "', descripcion='" . $_POST['descripcion'] . "', precio='" . $precio . "', existencia='" . $_POST['existencia'] . "', unidad='" . $_POST['unidad'] . "', id_promocion='" . $_POST['promocion'] . "'  WHERE id_producto = '" . $_POST["id_producto"] . "'";
		mysqli_query($this->dbConnect, $sqlUpdate);
		
			$fotos = array("fotoprincipal","foto1", "foto2", "foto3", "foto4", "foto5");
			foreach ($fotos as $foto) {
				if (isset($_FILES[$foto]["tmp_name"])) {				
					try {
						if (getimagesize($_FILES[$foto]["tmp_name"]) !== false) {
							$image = $_FILES[$foto]['tmp_name'];
							$imgContenido = addslashes(file_get_contents($image));	
							$sqlUpdateFoto = "UPDATE " . $this->productTable . " 
									SET " . $foto . " = '" . $imgContenido . "'  WHERE id_producto = '" . $_POST["id_producto"] . "'";
							mysqli_query($this->dbConnect, $sqlUpdateFoto);					
						}
					} catch (Exception $e) {
						// Manejo del error: mostrar un mensaje de error o realizar alguna acción de manejo de errores
						echo "<script>console.log('Error: " . $e->getMessage() . "');</script>";

					}	
				}
			}
							// Resto del código
		
	}
	
	public function updatePedido()
	{		
		$sqlUpdate = "UPDATE " . $this->pedidoTable . " 
						SET estado = '" . $_POST['estado'] . "'  WHERE id_pedido = '" . $_POST["id_pedido"] . "'";
		mysqli_query($this->dbConnect, $sqlUpdate);
		echo "actualizado";
	}
	public function updatePromocion()
	{		

		if (isset($_POST['porcentaje_descuento']) && !empty($_POST['porcentaje_descuento'])) {
			$valor = $_POST['porcentaje_descuento'];
			$valor = str_replace('%', "", $valor);
            $valor = $valor / 100;
		}
		if (isset($_POST['porcentaje_descuento_limitado']) && !empty($_POST['porcentaje_descuento_limitado'])) {
			$valor = $_POST['porcentaje_descuento_limitado'];
			$valor = str_replace('%', "", $valor);
            $valor = $valor / 100;
		}

		$sqlUpdate0 = "UPDATE " . $this->promocionTable . " 
						SET nombre='" . $_POST['nombre'] . "', descripcion='" . $_POST['descripcion'] . "', tipo='" . $_POST['tipo'] . "'  WHERE id_promocion = '" . $_POST["id_promocion"] . "'";
			mysqli_query($this->dbConnect, $sqlUpdate0);


		if($_POST['tipo']==='Descuento por cantidad'){
			$sqlUpdate1 = "UPDATE " . $this->promocionTable . " 
						SET umbral_cantidad_descuento='" . $_POST['umbral_cantidad_descuento'] . "', porcentaje_descuento='" .$valor . "'  WHERE id_promocion = '" . $_POST["id_promocion"] . "'";
			mysqli_query($this->dbConnect, $sqlUpdate1);

		}
		if($_POST['tipo']==='Regalo con compra'){
			$sqlUpdate2 = "UPDATE " . $this->promocionTable . " 
						SET cantidad_compra_regalo='" . $_POST['cantidad_compra_regalo'] . "', cantidad_regalo='" . $_POST['cantidad_regalo'] . "'  WHERE id_promocion = '" . $_POST["id_promocion"] . "'";
			mysqli_query($this->dbConnect, $sqlUpdate2);

		}
		if($_POST['tipo']==='Descuento por tiempo limitado'){
			$sqlUpdate3 = "UPDATE " . $this->promocionTable . " 
			SET fecha_inicio_limitado='" . $_POST['fecha_inicio_limitado'] . "', fecha_fin_limitado='" . $_POST['fecha_fin_limitado'] . "', porcentaje_descuento_limitado='" . $valor . "'  WHERE id_promocion = '" . $_POST["id_promocion"] . "'";
			mysqli_query($this->dbConnect, $sqlUpdate3);

		}								
	}



	public function deleteProduct()
	{
		$sqlQuery = "
			DELETE FROM " . $this->productTable . " 
			WHERE id_producto = '" . $_POST["id_producto"] . "'";
		mysqli_query($this->dbConnect, $sqlQuery);
	}
	public function deletePromocion()
	{
		$sqlQuery = "
			DELETE FROM " . $this->promocionTable . " 
			WHERE id_promocion = '" . $_POST["id_promocion"] . "'";
		mysqli_query($this->dbConnect, $sqlQuery);
	}
	public function viewProductDetails()
	{
		$sqlQuery = "SELECT p.id_producto,p.nombre,p.descripcion,c.nombre as categoria,p.precio,p.existencia,p.unidad,p.fotoprincipal,pr.nombre as promocion  FROM " . $this->productTable . " as p
		INNER JOIN " . $this->categoryTable . " as c ON c.id_categoria = p.id_categoria  INNER JOIN " . $this->promocionTable . " as pr ON pr.id_promocion = p.id_promocion 
			WHERE p.id_producto = '" . $_POST["id_producto"] . "'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$productDetails = '<div class="table-responsive">
				<table class="table table-boredered">';

		while ($product = mysqli_fetch_assoc($result)) {
			
		// Obtén los datos de la imagen de la base de datos
		$imageData = $product["fotoprincipal"];
		// Convierte los datos de la imagen en una cadena base64
		$imageBase64 = base64_encode($imageData);
		// Crea una URL de datos que puede ser utilizada en la etiqueta <img>
		$imageSrc = 'data:image/jpeg;base64,' . $imageBase64;

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
				<td>Promocion</td>
				<td>' . $product["promocion"] . '</td>
			</tr>
			<tr>
				<td>Foto</td>
				<td><img src="' . $imageSrc . '" class="product-image"></td>
			</tr>			
			';
		}
		$productDetails .= '
			</table>
		</div>
		';
		echo $productDetails;
	}
	
	public function viewProductList()
	{
		$sqlQuery = "SELECT p.id_producto,p.nombre,p.descripcion,c.nombre as categoria,p.precio,p.existencia,p.unidad,p.fotoprincipal  FROM " . $this->productTable . " as p
		INNER JOIN " . $this->categoryTable . " as c ON c.id_categoria = p.id_categoria";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$productDetails = '';

		while ($product = mysqli_fetch_assoc($result)) {
			
		// Obtén los datos de la imagen de la base de datos
		$imageData = $product["fotoprincipal"];
		// Convierte los datos de la imagen en una cadena base64
		$imageBase64 = base64_encode($imageData);
		// Crea una URL de datos que puede ser utilizada en la etiqueta <img>
		$imageSrc = 'data:image/jpeg;base64,' . $imageBase64;

		$tipofiltro = "";

		if($product["categoria"]==="Penachos"){
			$tipofiltro = "app";
		}else if($product["categoria"]==="Accesorio"){
			$tipofiltro = "card";
		}else{
			$tipofiltro = "web"; 
		}
		
			$productDetails .= '
			<div class="col-lg-4 col-md-6 portfolio-item filter-' . $tipofiltro . '"> <img src="' . $imageSrc . '" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>' . $product["nombre"] . '</h4>
              <p>$' . $product["precio"] . '</p>
              <a href="' . $imageSrc . '" data-gallery="portfolioGallery" class="product-image portfolio-lightbox preview-link" title="' . $product["nombre"] . '"><i class="bx bx-plus"></i></a> <a href="portfolio-details.php?id_producto=' . $product["id_producto"] . '" name="verdetalles" id_producto="' . $product["id_producto"] . '" class="details-link " title="More Details verdetalles" ><i class="bx bx-link" id_producto="' . $product["id_producto"] . '"></i></a>
            </div>
          </div>			
			';
		}
		echo $productDetails;
	}
	public function verMasImagenesProductos()
	{
		$sqlQuery = "SELECT fotoprincipal,foto1,foto2,foto3,foto4,foto5 FROM " . $this->productTable . " WHERE id_producto = '" . $_POST["id_producto"] . "'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$imagenesextra = "";

		while ($product = mysqli_fetch_assoc($result)) {
		
		// Obtén los datos de la imagen de la base de datos
		$imageDataP = $product["fotoprincipal"];
		if ($imageDataP) {
			// Convierte los datos de la imagen en una cadena base64		
			$imageBase64P = base64_encode($imageDataP);
			// Crea una URL de datos que puede ser utilizada en la etiqueta <img>
			$imageSrcP = 'data:image/jpeg;base64,' . $imageBase64P;	
			// Verifica si la imagen es válida
			if (getimagesize($imageSrcP)) {
				$imagenesextra .= "<div class='swiper-slide'>
				<img src='". $imageSrcP ."' alt=''>
			</div>
			";
			} 
		}
		
		// Obtén los datos de la imagen de la base de datos
		$imageData1 = $product["foto1"];
		if ($imageData1 ) {
			// Convierte los datos de la imagen en una cadena base64
			$imageBase641 = base64_encode($imageData1);
			// Crea una URL de datos que puede ser utilizada en la etiqueta <img>
			$imageSrc1 = 'data:image/jpeg;base64,' . $imageBase641;
			if (getimagesize($imageSrc1)) {
				$imagenesextra .= "<div class='swiper-slide'>
									   <img src='". $imageSrc1 ."' alt=''>
								   </div>";
			} 
	    }
		// Obtén los datos de la imagen de la base de datos
		$imageData2 = $product["foto2"];
		if ($imageData2) {
			// Convierte los datos de la imagen en una cadena base64
			$imageBase642 = base64_encode($imageData2);
			// Crea una URL de datos que puede ser utilizada en la etiqueta <img>
			$imageSrc2 = 'data:image/jpeg;base64,' . $imageBase642;
			if ( getimagesize($imageSrc2)) {
				$imagenesextra .= "<div class='swiper-slide'>
				<img src='". $imageSrc2 ."' alt=''>
			</div>
			";
			} 
		}
		// Obtén los datos de la imagen de la base de datos
		$imageData3 = $product["foto3"];
		if ($imageData3) {
			// Convierte los datos de la imagen en una cadena base64
			$imageBase643 = base64_encode($imageData3);
			// Crea una URL de datos que puede ser utilizada en la etiqueta <img>
			$imageSrc3 = 'data:image/jpeg;base64,' . $imageBase643;
			if (getimagesize($imageSrc3)) {
				$imagenesextra .= "<div class='swiper-slide'>
				<img src='". $imageSrc3 ."' alt=''>
			</div>
			";
			} 
		}
		// Obtén los datos de la imagen de la base de datos
		$imageData4 = $product["foto4"];
		if ($imageData4) {
			// Convierte los datos de la imagen en una cadena base64
			$imageBase644 = base64_encode($imageData4);
			// Crea una URL de datos que puede ser utilizada en la etiqueta <img>
			$imageSrc4 = 'data:image/jpeg;base64,' . $imageBase644;
			if (getimagesize($imageSrc4)) {
				$imagenesextra .= "<div class='swiper-slide'>
				<img src='". $imageSrc4 ."' alt=''>
			</div>
			";
			} 
		}
		// Obtén los datos de la imagen de la base de datos
		$imageData5 = $product["foto5"];
		if ($imageData5) {
			// Convierte los datos de la imagen en una cadena base64
			$imageBase645 = base64_encode($imageData5);
			// Crea una URL de datos que puede ser utilizada en la etiqueta <img>
			$imageSrc5 = 'data:image/jpeg;base64,' . $imageBase645;
			if (getimagesize($imageSrc5)) {
				$imagenesextra .= "<div class='swiper-slide'>
				<img src='" . $imageSrc5 ."' alt=''>
			</div>
			";
			} 
		}
		
		}
		echo $imagenesextra;
	}
	
	public function verMasDetalleProductos()
	{
		$sqlQuery = "SELECT pr.id_producto,pr.nombre,pr.descripcion,c.nombre as categoria,pr.precio,pr.existencia,pr.unidad FROM " . $this->productTable . " as pr INNER JOIN categoria as c ON pr.id_categoria=c.id_categoria WHERE id_producto = '" . $_POST["id_producto"] . "'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
	
		$detallesextra = "<h3>Informacion del Producto</h3>
		<ul>";

		while ($product = mysqli_fetch_assoc($result)) {
			$detallesextra .= "<li><strong>Nombre</strong>: ".$product["nombre"]."</li>";
			$detallesextra .= "<li><strong>Descripcion</strong>: ".$product["descripcion"]."</li>";
			$detallesextra .= "<li><strong>Categoria</strong>: ".$product["categoria"]."</li>";
			$detallesextra .= "<li><strong>Precio</strong>: $".$product["precio"]."</li>";
			$detallesextra .= "<li><strong>Existencia</strong>: ".$product["existencia"]."  ".$product["unidad"]."</li>";
		}
		$detallesextra .= "</ul>";
		echo $detallesextra;

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
