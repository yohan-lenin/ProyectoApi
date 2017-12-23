<?php
if(!defined("SPECIALCONSTANT")) die("Acceso denegado");

//metodos PAra Proveedor
$app->get("/proveedor/", function() use($app){

	try {
		$connection = getConnection();
		$dbh = $connection->prepare("SELECT * FROM proveedor");
		$dbh->execute();
		$proveedors = $dbh->fetchAll();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($proveedors));
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
		
	}
});

$app->get("/proveedor/:id", function($id) use($app){

	try {
		$connection = getConnection();
		$dbh = $connection->prepare("SELECT * FROM proveedor WHERE idProveedor = $id");
		$dbh->bindParam(1, $id);
		$dbh->execute();
		$proveedor = $dbh->fetch();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($proveedor));
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
		
	}
});

$app->post("/addPro/", function() use($app){
	
	//$idProveedor = $app->request->post("idProveedor");
	$nomProveedor = $app->request->post("nomProveedor");


	try {
		$connection = getConnection();
		$dbh = $connection->prepare("INSERT INTO proveedor VALUES(null, ?)");
		$dbh->bindParam(1, $nomProveedor);


		$dbh->execute();
		$proveedorAdd = $connection->lastInsertId();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($proveedorAdd));
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}

});
/*
$app->put("/putCli/", function() use($app){
	$nomCliente = $app->request->put("nomCliente");

	$idCliente = $app->request->put("idCliente");


	try {
		$connection = getConnection();
		$dbh = $connection->prepare("UPDATE cliente SET idProveedor = ?  WHERE idCliente = ?");
		$dbh->bindParam(1, $idCliente);

		$dbh->bindParam(2, $nomCliente);
		$dbh->execute();
	
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode(array("res" => 1)));
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}

});
*/
$app->delete("/proveedord/:id", function($id) use($app){
	//$nomProveedor = $app->request->post("nomProveedor");
	
	try {
		$connection = getConnection();
		$dbh = $connection->prepare("DELETE FROM proveedor WHERE idProveedor = ?");
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



