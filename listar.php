<?php
$database = new PDO("mysql:host=localhost; dbname=amazon", "root", "");
$sql = "SELECT * FROM users";
$comando = $database->prepare($sql);
$comando->execute();
$listar = $comando->fetchAll(PDO::FETCH_ASSOC);
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
    <table>
        <thead>
            <tr>
                <td>Nome</td>
                <td>Senha</td>
                <td>E-mail</td>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($listar as $list) {
            ?>
            <tr>
                <td><?php echo $list['name']; ?></td>
                <td><?php echo $list['password']; ?></td>
                <td><?php echo $list['email']; ?></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html>