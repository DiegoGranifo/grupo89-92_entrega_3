
<?php include('../Templates/header.html'); ?>

<body>
<?php

  # Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../Config/conexion.php");

  // Obtener la categoría seleccionada
  $region = $_POST['region'];

  // Construir la consulta SQL dinámicamente
  $query = "SELECT t.id_tienda, t.calle, t.numero, t.comuna,
  SUM(p.precio * s.cantidad) AS valor_total_stock
  FROM tiendas AS t
  JOIN stock AS s ON t.id_tienda = s.id_tienda
  JOIN productos AS p ON s.id_producto = p.id_producto
  WHERE t.region = '$region'
  GROUP BY t.id_tienda, t.calle, t.numero, t.comuna;";
  $result = $db -> prepare($query);
  $result -> execute();
  $data = $result -> fetchAll();
  ?>

  <div class="resultado">
    <h2 align="center"> Valor total del stock de cada tienda de la región seleccionada </h2>
  </div>
  <div class="table-scroll">
    <table align="center">
      <tr>
        <th> ID Tienda </th>
        <th> Calle </th>
        <th> N° Inmueble </th>
        <th> Comuna </th>
        <th> Valor total Stock </th>
    <?php 
  
    foreach ($data as $v) {
        echo "<tr> <td>$v[0]</td> <td>$v[1]</td> <td>$v[2]</td> <td>$v[3]</td> <td>$v[4]</td> <td>";
    }
      
    ?>
    </table>
  </div>
<?php include('../Templates/footer.html'); ?> 