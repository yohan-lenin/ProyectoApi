<?php
if(!defined("SPECIALCONSTANT")) die("Acceso denegado");
/*


//MEtodos para usuario
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
*/
$app->get("/user/:id", function($id) use($app){

	try {
		$connection = getConnection();
		$dbh = $connection->prepare("SELECT * FROM user WHERE idEmpleado = $id");
		$dbh->bindParam(1, $id);
		$dbh->execute();
		$user = $dbh->fetch();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($user));
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
		
	}
});

$app->post("/addUser/", function() use($app){
	
	$usuario = $app->request->post("usuario");
	$password = $app->request->post("password");
	$idEmpleado = $app->request->post("idEmpleado");

	try {
		$connection = getConnection();
		$dbh = $connection->prepare("INSERT INTO user VALUES(?, ?, ?)");
		$dbh->bindParam(1, $usuario);
		$dbh->bindParam(2, $password);
		$dbh->bindParam(3, $idEmpleado);



		$dbh->execute();
		$userAdd = $connection->lastInsertId();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($userAdd));
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}

});

$app->put("/putUser/", function() use($app){
	$password = $app->request->put("password");
	$idEmpleado = $app->request->put("idEmpleado");
	$usuario = $app->request->put("usuario");


	try {
		$connection = getConnection();
		$dbh = $connection->prepare("UPDATE user SET password = ?, idEmpleado = ? WHERE usuario = ?");
		$dbh->bindParam(1, $password);
		$dbh->bindParam(2, $idEmpleado);
		$dbh->bindParam(3, $usuario);
		$dbh->execute();
	
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode(array("res" => 1)));
		
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}

});

$app->delete("/usuariod/:id", function($id) use($app){
	//$idEmpleado = $app->request->post("nomEmpleado");
	
	try {
		$connection = getConnection();
		$dbh = $connection->prepare("DELETE FROM usuario WHERE usuario = ?");
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



