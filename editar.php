<?php
$database = new PDO("mysql:host=localhost; dbname=amazon", "root", "");
$sql = "SELECT * FROM users WHERE id= :id";
$comando = $database->prepare($sql);
$comando->bindParam(":id", $_GET['id'], PDO::PARAM_INT);
$comando->execute();
$listar = $comando->fetch(PDO::FETCH_ASSOC);
var_dump($listar);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar</title>
</head>
<body>
    <?php
    include("template/navbar.php");
    ?>
    <form action="update.php" method="post">
        <input type="hidden" name="id" value="<?php echo $_POST['id'] ?>">
        <input type="text" name="nome" value="<?php echo $_POST['name'] ?>">
        <input type="email" name="email" value="<?php echo $_POST['email'] ?>">
        <input type="password" name="senha" value="<?php echo $_POST['password'] ?>">
        <button type="submit">Enviar</button>
    </form>
</body>
</html>