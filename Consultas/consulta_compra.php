
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
$idCompra = intval($_POST['selectedId']); // Obtener el ID de la compra ingresado por el usuario desde un formulario
// Consulta SQL para calcular el número total de cajas requeridas
$query = "SELECT p.nombre, pc.cantidad,p.tipo, p.precio*pc.cantidad AS valor, p.numero_cajas * pc.cantidad AS total_cajas, d.fecha_entrega
          FROM Compras co
          JOIN ProductosCompras pc ON co.id = pc.id_compra
          JOIN Productos p ON pc.id_producto = p.id
            JOIN Despachos d ON co.id = d.id_compra
          WHERE co.id = $idCompra";

$result = $db2 -> prepare($query);
$result -> execute();
$compras = $result -> fetchAll();
?>
<br>
<br>
<br>
<div class="container">
  <div class="jumbotron">
    <?php
      echo '
      <h2 class="text-center mb-4">ID de Compra: ' . $idCompra . '</h2>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nombre Producto</th>
            <th>Cantidad</th>
            <th>Tipo</th>
            <th>Valor</th>
            <th>Total Cajas</th>
          </tr>
        </thead>
        <tbody>';
      
      foreach ($compras as $compra) {
        echo "<tr>";
        echo "<td>$compra[0]</td>";
        echo "<td>$compra[1]</td>";
        echo "<td>$compra[2]</td>";
        echo "<td>$compra[3]</td>";
        echo "<td>$compra[4]</td>";
        echo "</tr>";
      }
      
      echo '
        </tbody>
      </table>';
      
      $fechaEntrega = $compras[0][5];
      
      if (!empty($fechaEntrega)) {
        echo "<p class='text-center mt-4'>Despacho programado para el $fechaEntrega</p>";
      } else {
        echo "<p class='text-center mt-4'>Retiro de Producto</p>";
      }
    ?>
  </div>

</div>
</body>
</html>




