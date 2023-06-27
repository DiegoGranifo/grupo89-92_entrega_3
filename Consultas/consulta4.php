<?php include('../Templates/header.html'); ?>

<body>
<?php

  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../Config/conexion.php");

  // Obtener la categoría seleccionada
  $nombre = $_POST['nombre'];
  $region = $_POST['region'];
  $nombre = strtoupper($nombre);

  // Construir la consulta SQL dinámicamente
  $query = "SELECT t.id_tienda, p.nombre AS nombre_producto, p.precio, s.descuento
  FROM tiendas AS t
  JOIN stock AS s ON t.id_tienda = s.id_tienda
  JOIN productos AS p ON s.id_producto = p.id_producto
  WHERE p.nombre LIKE '%$nombre%'
    AND s.cantidad > 0
    AND t.region = '$region';";
  $result = $db -> prepare($query);
  $result -> execute();
  $data = $result -> fetchAll();
  ?>

  <div class="resultado">
    <h2 align="center"> Tiendas con de la región con el producto en stock </h2>
  </div>
  <div class="table-scroll">
    <table align="center">
      <tr>
        <th> ID Tienda </th>
        <th> Nombre Producto </th>
        <th> Precio </th>
        <th> % Descuento </th>
    <?php 
  
    foreach ($data as $v) {
        echo "<tr> <td>$v[0]</td> <td>$v[1]</td> <td>$v[2]</td> <td>$v[3]</td> <td>";
    }
      
    ?>
    </table>
  </div>
<?php include('../Templates/footer.html'); ?> 