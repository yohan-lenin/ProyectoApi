<?php
if(!defined("SPECIALCONSTANT")) die("Acceso denegado");

$app->get("/producto/", function() use($app){

	try {
		$connection = getConnection();
		$dbh = $connection->prepare("SELECT * FROM producto");
		$dbh->execute();
		$productos = $dbh->fetchAll();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($productos));
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
		
	}
});

$app->get("/producto/:id", function($id) use($app){

	try {
		$connection = getConnection();
		$dbh = $connection->prepare("SELECT * FROM producto WHERE idProducto = $id");
		$dbh->bindParam(1, $id);
		$dbh->execute();
		$producto = $dbh->fetch();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($producto));
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
		
	}
});

$app->post("/addP/", function() use($app){
	//$idProducto = $app->request->post("idProducto");
	$idProveedor = $app->request->post("idProveedor");
	$codigoProducto = $app->request->post("codigoProducto");
	$nombreProducto = $app->request->post("nombreProducto");
	$presentacionProducto = $app->request->post("presentacionProducto");
	$cantidadProducto = $app->request->post("cantidadProducto");
	$precioVenta = $app->request->post("precioVenta");
	$precioCompra = $app->request->post("precioCompra");

	try {
		$connection = getConnection();
		$dbh = $connection->prepare("INSERT INTO producto VALUES(null, ?, ?, ?, ?, ?, ?, ?)");
		$dbh->bindParam(1, $idProveedor);
		$dbh->bindParam(2, $codigoProducto);
		$dbh->bindParam(3, $nombreProducto);
		$dbh->bindParam(4, $presentacionProducto);
		$dbh->bindParam(5, $cantidadProducto);
		$dbh->bindParam(6, $precioVenta);
		$dbh->bindParam(7, $precioCompra);

		$dbh->execute();
		$productoAdd = $connection->lastInsertId();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($productoAdd));
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}

});

$app->put("/putPro/", function() use($app){
	$idProveedor = $app->request->put("idProveedor");
	$codigoProducto = $app->request->put("codigoProducto");
	$nombreProducto = $app->request->put("nombreProducto");
	$presentacionProducto = $app->request->put("presentacionProducto");
	$cantidadProducto = $app->request->put("cantidadProducto");
	$precioVenta = $app->request->put("precioVenta");
	$precioCompra = $app->request->put("precioCompra");
	$idProducto = $app->request->put("idProducto");


	try {
		$connection = getConnection();
		$dbh = $connection->prepare("UPDATE producto SET idProveedor = ?, codigoProducto = ?, nombreProducto = ?, presentacionProducto = ?, cantidadProducto = ?, precioVenta = ?, precioCompra = ? WHERE idProducto = ?");
		$dbh->bindParam(1, $idProveedor);
		$dbh->bindParam(2, $codigoProducto);
		$dbh->bindParam(3, $nombreProducto);
		$dbh->bindParam(4, $presentacionProducto);
		$dbh->bindParam(5, $cantidadProducto);
		$dbh->bindParam(6, $precioVenta);
		$dbh->bindParam(7, $precioCompra);
		$dbh->bindParam(8, $idProducto);
		$dbh->execute();
	
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode(array("res" => 1)));
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}

});

$app->delete("/producto/:id", function($id) use($app){
	/*$idProveedor = $app->request->post("idProveedor");
	$codigoProducto = $app->request->post("codigoProducto");
	$nombreProducto = $app->request->post("nombreProducto");
	$presentacionProducto = $app->request->post("presentacionProducto");
	$cantidadProducto = $app->request->post("cantidadProducto");
	$precioVenta = $app->request->post("precioVenta");
	$precioCompra = $app->request->post("precioCompra");*/

	try {
		$connection = getConnection();
		$dbh = $connection->prepare("DELETE FROM producto WHERE idProducto = ?");
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



