<?php include('../Templates/header.html'); ?>
<?php
session_start();
require("../Config/conexion.php");
$id_user = $_POST["id"];
$password = $_POST["clave"];
$query = "SELECT * FROM users WHERE id = $id_user AND password = '$password'";
$result = $db2->query($query);
$users = $result -> fetchAll();


// Ejecutar la consulta
// Aquí debes utilizar tu conexión a la base de datos y ejecutar la consulta SQL
// Guarda el resultado en una variable, por ejemplo, $result

// Mostrar los resultados
?>
<?php
echo $users[0][1];
if ($users[0][1] == null) {
    header("Location: https://codd.ing.puc.cl/~grupo89/login_index.php");
} else {
    $_SESSION["user_id"] = $users[0][0];
    $_SESSION["user_name"] = $users[0][1];
    $_SESSION["user_type"] = $users[0][3];
    $_SESSION['loggedin'] = true;
    header("Location: https://codd.ing.puc.cl/~grupo89");


}


?>
