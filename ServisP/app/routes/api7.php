<?php
if(!defined("SPECIALCONSTANT")) die("Acceso denegado");

//metodos PAra venta
$app->get("/venta/", function() use($app){

	try {
		$connection = getConnection();
		$dbh = $connection->prepare("SELECT * FROM venta");
		$dbh->execute();
		$ventas = $dbh->fetchAll();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($ventas));
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
		
	}
});

$app->get("/venta/:id", function($id) use($app){

	try {
		$connection = getConnection();
		$dbh = $connection->prepare("SELECT * FROM venta WHERE idVenta = $id");
		$dbh->bindParam(1, $id);
		$dbh->execute();
		$venta = $dbh->fetch();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($venta));
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
		
	}
});

$app->post("/addV/", function() use($app){
	//$idProducto = $app->request->post("idProducto");
	$idVenta = $app->request->post("idVenta");
	//fecha
	//$fechaVenta = $app->request->post("idEmpleado");
	$idEmpleado = $app->request->post("idEmpleado");
	$idTipo = $app->request->post("idTipo");
	$idCliente = $app->request->post("idCliente");
	//$idProducto= $app->request->post("idProducto");
	//$cantidadProductov= $app->request->post("cantidadProductov");
	$totalVenta= $app->request->post("totalVenta");

	try {
		$connection = getConnection();
		$dbh = $connection->prepare("INSERT INTO venta VALUES(?, NOW(), ?, ?, ?, ?, ?)");
		$dbh->bindParam(1, $idVenta);
		$dbh->bindParam(2, $idEmpleado);
		$dbh->bindParam(3, $idTipo);
		$dbh->bindParam(4, $idCliente);
		//$dbh->bindParam(5, $idProducto);
		//$dbh->bindParam(6, $cantidadProductov);
		$dbh->bindParam(5, $totalVenta);


		$dbh->execute();
		$ventaAdd = $connection->lastInsertId();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($ventaAdd));
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}

});

$app->put("/putVen/", function() use($app){
	$idVenta = $app->request->put("idVenta");
	//$fechaVenta = $app->request->put("codigoProducto");
	$idEmpleado = $app->request->put("idEmpleado");
	$idTipo = $app->request->put("idTipo");
	$idCliente = $app->request->put("idCliente");
	//$idProducto = $app->request->put("idProducto");
	//$cantidadProductov = $app->request->put("cantidadProductov");
	$totalVenta = $app->request->put("totalVenta");


	try {
		$connection = getConnection();
		$dbh = $connection->prepare("UPDATE venta SET idEmpleado = ?, idTipo = ?, idCliente = ?, totalVenta = ?  WHERE idVenta = ?");
		$dbh->bindParam(1, $idEmpleado);
		$dbh->bindParam(2, $idTipo);
		$dbh->bindParam(3, $idCliente);
		//$dbh->bindParam(4, $idProducto);
		//$dbh->bindParam(5, $cantidadProductov);
		$dbh->bindParam(4, $totalVenta);
		
		$dbh->execute();
	
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode(array("res" => 1)));
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}

});

$app->delete("/venta/:id", function($id) use($app){
	/*$idProveedor = $app->request->post("idProveedor");
	$codigoProducto = $app->request->post("codigoProducto");
	$nombreProducto = $app->request->post("nombreProducto");
	$presentacionProducto = $app->request->post("presentacionProducto");
	$cantidadProducto = $app->request->post("cantidadProducto");
	$precioVenta = $app->request->post("precioVenta");
	$precioCompra = $app->request->post("precioCompra");*/

	try {
		$connection = getConnection();
		$dbh = $connection->prepare("DELETE FROM venta WHERE idVenta = ?");
		$dbh->bindParam(1, $id);
		$dbh->execute();
	
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode(array("res" => 1)));
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}

});



