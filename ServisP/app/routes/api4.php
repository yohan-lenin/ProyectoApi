<?php
if(!defined("SPECIALCONSTANT")) die("Acceso denegado");

//metodos PAra empleaado
$app->get("/empleado/", function() use($app){

	try {
		$connection = getConnection();
		$dbh = $connection->prepare("SELECT * FROM empleado");
		$dbh->execute();
		$empleados = $dbh->fetchAll();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($empleados));
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
		
	}
});

$app->get("/empleado/:id", function($id) use($app){

	try {
		$connection = getConnection();
		$dbh = $connection->prepare("SELECT * FROM empleado WHERE idEmpleado = $id");
		$dbh->bindParam(1, $id);
		$dbh->execute();
		$empleado = $dbh->fetch();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($empleado));
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
		
	}
});

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



