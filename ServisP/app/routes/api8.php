<?php
if(!defined("SPECIALCONSTANT")) die("Acceso denegado");

$app->get("/ventaproducts/", function() use($app){

  try {
    $connection = getConnection();
    $dbh = $connection->prepare("SELECT * FROM todaVenta");
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

$app->get("/ventaproducts/:id", function($id) use($app){

  try {
    $connection = getConnection();
    $dbh = $connection->prepare("SELECT * FROM todaVenta WHERE idVenta = $id");
    $dbh->bindParam(1, $id);
    $dbh->execute();
    $producto = $dbh->fetchAll();
    $connection = null;

    $app->response->headers->set("Content-type", "application/json");
    $app->response->status(200);
    $app->response->body(json_encode($producto));
    
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    
  }
});

$app->post("/addProducts/", function() use($app){
  //$idProducto = $app->request->post("idProducto");
  $idVenta = $app->request->post("idVenta");
  $idProducto = $app->request->post("idProducto");
  $cantidadProducto = $app->request->post("cantidadProducto");

  try {
    $connection = getConnection();
    $dbh = $connection->prepare("INSERT INTO producto VALUES(?, ?, ?)");
    $dbh->bindParam(1, $idVenta);
    $dbh->bindParam(2, $idProducto);
    $dbh->bindParam(3, $cantidadProducto);

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

$app->put("/updateProducts/", function() use($app){
  $idVenta = $app->request->put("idVenta");
  $idProducto = $app->request->put("idProducto");
  $cantidadProducto = $app->request->put("cantidadProducto");


  try {
    $connection = getConnection();
    $dbh = $connection->prepare("UPDATE todaVenta SET idProducto = ?, cantidadProducto = ? WHERE idVenta = ?");
    $dbh->bindParam(1, $idProducto);
    $dbh->bindParam(2, $cantidadProducto);
    $dbh->bindParam(3, $idVenta);
 
    $dbh->execute();
  
    $connection = null;

    $app->response->headers->set("Content-type", "application/json");
    $app->response->status(200);
    $app->response->body(json_encode(array("res" => 1)));
    
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }

});

$app->delete("/ventaproducts/:id", function($id) use($app){

  try {
    $connection = getConnection();
    $dbh = $connection->prepare("DELETE FROM todaVenta WHERE idVenta = ?");
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



