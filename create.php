<?php
$database = new PDO("mysql:host=localhost; dbname=amazon", "root", "");
$sql = "INSERT INTO users VALUES (null, :name, :password, :email)";
$comando = $database->prepare($sql);
$comando->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
$comando->bindParam(":password", $_POST['password'], PDO::PARAM_STR);
$comando->bindParam(":email", $_POST['email'], PDO::PARAM_STR);
$comando->execute();
header('Location: listar.php');