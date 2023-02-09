<?php
$database = new PDO("mysql:host=localhost; dbname=amazon", "root", "");
$sql = "UPDATE users SET name= :name, password= :password, email= :email WHERE id= :id";
$comando = $database->prepare($sql);
$comando->bindParam(":id", $_POST['id'], PDO::PARAM_INT);
$comando->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
$comando->bindParam(":password", $_POST['password'], PDO::PARAM_STR);
$comando->bindParam(":email", $_POST['email'], PDO::PARAM_STR);
$comando->execute();
header('Location: listar.php');