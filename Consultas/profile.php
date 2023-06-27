
<!DOCTYPE html>
<html lang="es">
  <meta charset="UTF-8" />
  <title>Bodega 89</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">

  <style>
    .custom-table {
            max-width: 1000px; /* Adjust the value to your desired width */
            margin: 0 auto; /* Center the table horizontally */
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
    <?php
      require("../Config/conexion.php");
      session_start();
      if(!isset($_SESSION["user_id"])) {
         header("Location: //codd.ing.puc.cl/~grupo89/login_index.php");
      }
      $id = $_SESSION["user_id"];
      $query = "SELECT * FROM clientes WHERE id = $id";
      $result = $db2 -> prepare($query);
      $result -> execute();
      $user = $result -> fetchAll();
    ?>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="mb-3">
        <label for="id" class="form-label">ID Usuarios:</label>
        <input type="text" class="form-control" id="id" name="id" value="<?php echo $user[0][0] ?>" readonly>
      </div>
      <div class="mb-3">
        <label for="username" class="form-label">Nombre de Usuario:</label>
        <input type="text" class="form-control" id="username" name="username" value="<?php echo $user[0][1] ?>" readonly>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Direccion</label>
        <input type="text" class="form-control" id="password" name="password" value="<?php echo $user[0][3] . ' ' . $user[0][4] . ', ' . $user[0][5] . ', ' . $user[0][6] ?>" readonly>
      </div>
    </div>
  </div>
  <div class="row justify-content-center"> <!-- Add this row for centering the "Log Out" button -->
    <div class="col-md-4">
      <a href="https://codd.ing.puc.cl/~grupo89/Consultas/logout.php" class="btn btn-primary btn-sm">Log Out</a>
    </div>
  </div>
</div>


<?php
$query = "SELECT *
          FROM Compras co
          WHERE co.id_cliente = $id
          ORDER BY co.fecha";

// Ejecutar la consulta
$result = $db2 -> prepare($query);
$result -> execute();
$compras = $result -> fetchAll();
?>
<?php
$query = "SELECT *
          FROM Compras co
          WHERE co.id_cliente = $id
          ORDER BY co.fecha";

// Ejecutar la consulta
$result = $db2 -> prepare($query);
$result -> execute();
$compras = $result -> fetchAll();
?>
<br>
<br>
<br>

<div class="container">
    <div class="jumbotron">
        <form id="redirectForm" action="consulta_compra.php" method="post">
            <input type="hidden" id="selectedId" name="selectedId" value="">
        </form>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID Compra</th>
                <th>Fecha</th>
                <th>Valor</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($compras as $row) {
                echo "<tr onclick=\"selectRow('" . $row["id"] . "');\" style=\"cursor: pointer;\">";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row['fecha'] . "</td>";
                echo "<td>" . $row['valor'] . "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
<script>
    function selectRow(id) {
        document.getElementById("selectedId").value = id;
        document.getElementById("redirectForm").submit();
    }
</script>






