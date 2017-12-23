<?php
if(!defined("SPECIALCONSTANT")) die("Acceso denegado");

//metodos PAra tipo de pago
$app->get("/tipoP/", function() use($app){

	try {
		$connection = getConnection();
		$dbh = $connection->prepare("SELECT * FROM tipoPago");
		$dbh->execute();
		$tipos = $dbh->fetchAll();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($tipos));
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
		
	}
});

$app->get("/tipo/:id", function($id) use($app){

	try {
		$connection = getConnection();
		$dbh = $connection->prepare("SELECT * FROM tipoPago WHERE idTipo = $id");
		$dbh->bindParam(1, $id);
		$dbh->execute();
		$tipo = $dbh->fetch();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($tipo));
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
		
	}
});
/*
$app->post("/addEmp/", function() use($app){
	
	//$idProveedor = $app->request->post("idProveedor");
	$nomEmpleado = $app->request->post("nomEmpleado");


	try {
		$connection = getConnection();
		$dbh = $connection->prepare("INSERT INTO empleado VALUES(null, ?)");
		$dbh->bindParam(1, $nomEmpleado);


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

$app->put("/putEmp/", function() use($app){
	$nomEmpleado = $app->request->put("nomEmpleado");

	$idEmpleado = $app->request->put("idEmpleado");


	try {
		$connection = getConnection();
		$dbh = $connection->prepare("UPDATE empleado SET nomEmpleado = ?  WHERE idEmpleado = ?");
		$dbh->bindParam(1, $nomEmpleado);

		$dbh->bindParam(2, $idEmpleado);
		$dbh->execute();
	
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode(array("res" => 1)));
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}

});

$app->delete("/empleadod/:id", function($id) use($app){
	//$idEmpleado = $app->request->post("nomEmpleado");
	
	try {
		$connection = getConnection();
		$dbh = $connection->prepare("DELETE FROM empleado WHERE idEmpleado = ?");
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

*/

