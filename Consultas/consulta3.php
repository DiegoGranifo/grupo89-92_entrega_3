<?php include('../Templates/header.html'); ?>

<body>
<?php

  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../Config/conexion.php");

  // Obtener la categoría seleccionada del dropdown
  $id = $_POST['id'];

  // Construir la consulta SQL dinámicamente
  $query = "SELECT p.id_producto, p.nombre, p.numero_cajas, SUM(c.peso)
    FROM productos AS p
    JOIN cajas AS c ON p.id_producto = c.id_producto
    WHERE p.id_producto = $id
    GROUP BY p.id_producto;";
  $result = $db -> prepare($query);
  $result -> execute();
  $data = $result -> fetchAll();
  ?>

  <div class="resultado">
    <h2 align="center"> Datos del empaque del producto seleccionado </h2>
  </div>
  <div class="table-scroll">
    <table align="center">
      <tr>
        <th> ID Producto </th>
        <th> Nombre </th>
        <th> N° Cajas Necesarias </th>
        <th> Peso total </th>
    <?php 
  
    foreach ($data as $v) {
        echo "<tr> <td>$v[0]</td> <td>$v[1]</td> <td>$v[2]</td> <td>$v[3]</td> <td>";
    }
      
    ?>
    </table>
  </div>
<?php include('../Templates/footer.html'); ?> 