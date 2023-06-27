<!DOCTYPE html>
<html lang="es">
  <meta charset="UTF-8" />
  <title>Bodega 89</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">

  <style>
    .custom-table {
            max-width: 1000px; /* Adjust the value to your desired width */
            margin: 0 auto; /* Center the table horizontally */
            background-color: rgb(227, 227, 227);
    
    
    font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
      "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
        }

    .sticky {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1;
    }

    /* Added styles for the form */
    .container {
      background-color: rgb(227, 227, 227);
    text-align: center;
    padding: 10px;
    }

    .form-label {
      font-weight: bold;
    }

    .form-control {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }


    .logo {
      text-decoration: none;
      color: inherit;
    }
    body {
        background-image: url("../Styles/fondo.jpg"); 
        background-size: 100%;
    background-position: top;
        background-repeat: repeat;
      }
  </style>

  <script>
    // When the page loads, execute myFunction
    window.onload = function () {
      myFunction();
    };

    document.addEventListener("DOMContentLoaded", function (event) {
      myFunction();
    });

    // Get the header
    var header = document.getElementById("sticky_header");

    // Get the offset position of the navbar
    var sticky = header.offsetTop;

    // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
    function myFunction() {
      header.classList.add("sticky");
    }
  </script>
<nav class="navbar navbar-light" style="background-color: #473E76;">
    <a class="navbar-brand text-center" href="https://codd.ing.puc.cl/~grupo89/" style="color: white;">
        Bodega 89
    </a>
</nav>
<body>
<br>
<br>
<br>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../Config/conexion.php");

  $query="CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY,
    username VARCHAR(255),
    password VARCHAR(255),
    user_type VARCHAR(10)
  );";
  $result = $db2 -> prepare($query);
  $result -> execute();
  $query = "
  INSERT INTO users (id, username, password, user_type)
  VALUES (1, 'admin', 'admin', 'Admin')
  ON CONFLICT (id) DO NOTHING;";

$result = $db2 -> prepare($query);
$result -> execute();

$query = "SELECT id,
CONCAT(SUBSTRING(nombre FROM 1 FOR POSITION(' ' IN nombre) - 1), '_', SUBSTRING(nombre FROM POSITION(' ' IN nombre) + 1)) AS full_name,
SUBSTRING(MD5(RANDOM()::text), 1, 8) AS random_password
FROM clientes";
  $result = $db2 -> prepare($query);
  $result -> execute();
  $clientes = $result -> fetchAll();
  foreach ($clientes as $cliente) {
    $query = "INSERT INTO users (id, username, password, user_type)
    VALUES ($cliente[0], '$cliente[1]', '$cliente[2]', 'Cliente')
    ON CONFLICT (id) DO NOTHING;";
    $result = $db2 -> prepare($query);
    $result -> execute();
  }

$query = "SELECT * FROM users ORDER BY id Limit 10";
$result = $db2 -> prepare($query);
$result -> execute();
$users = $result -> fetchAll();

?>
<div class="container">
<div class="jumbotron">
  <table class="table table-striped custom-table">
    <thead>
      <tr>
        <th>ID </th>
        <th>Nombre </th>
        <th>Contraseña</th>
        <th>tipo</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($users as $row) {
        echo "<tr>";
        echo "<td>" . $row[0] . "</td>";
        echo "<td>" . $row[1] . "</td>";
        echo "<td>" . $row[2] . "</td>";
        echo "<td>" . $row[3] . "</td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</div>
</div>
</body>
</html>
