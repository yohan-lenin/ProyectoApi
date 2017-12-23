<?php
if(!defined("SPECIALCONSTANT")) die("Acceso denegado");
//metodos PAra clietne
$app->get("/cliente/", function() use($app){

	try {
		$connection = getConnection();
		$dbh = $connection->prepare("SELECT * FROM cliente");
		$dbh->execute();
		$clientes = $dbh->fetchAll();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($clientes));
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
		
	}
});

$app->get("/cliente/:id", function($id) use($app){

	try {
		$connection = getConnection();
		$dbh = $connection->prepare("SELECT * FROM cliente WHERE idCliente = $id");
		$dbh->bindParam(1, $id);
		$dbh->execute();
		$cliente = $dbh->fetch();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($cliente));
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
		
	}
});

$app->post("/addC/", function() use($app){
	
	//$idProveedor = $app->request->post("idProveedor");
	$nomCliente = $app->request->post("nomCliente");


	try {
		$connection = getConnection();
		$dbh = $connection->prepare("INSERT INTO cliente VALUES(null, ?)");
		$dbh->bindParam(1, $nomCliente);


		$dbh->execute();
		$clienteAdd = $connection->lastInsertId();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($clienteAdd));
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}

});

$app->put("/putCli/", function() use($app){
	$nomCliente = $app->request->put("nomCliente");

	$idCliente = $app->request->put("idCliente");


	try {
		$connection = getConnection();
		$dbh = $connection->prepare("UPDATE cliente SET nomCliente = ?  WHERE idCliente = ?");
		$dbh->bindParam(1, $nomCliente);

		$dbh->bindParam(2, $idCliente);
		$dbh->execute();
	
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode(array("res" => 1)));
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}

});

$app->delete("/cliented/:id", function($id) use($app){
	//$nomCliente = $app->request->post("nomCliente");
	
	try {
		$connection = getConnection();
		$dbh = $connection->prepare("DELETE FROM cliente WHERE idCliente = ?");
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



