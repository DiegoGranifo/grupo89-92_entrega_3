
<?php include('../Templates/header.html'); ?>

<body>
<?php

  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../Config/conexion.php");

  // Obtener la categoría seleccionada
  $region = $_POST['region'];

  // Construir la consulta SQL dinámicamente
  $query = "SELECT t.id_tienda, COUNT(CASE WHEN p.genero = 1 THEN 1 END) AS total_femenino, 
  COUNT(CASE WHEN p.genero = 0 THEN 1 END) AS total_masculino, 
  AVG(CASE WHEN p.genero = 1 THEN p.edad END) AS edad_promedio_femenino, 
  AVG(CASE WHEN p.genero = 0 THEN p.edad END) AS edad_promedio_masculino
  FROM tiendas AS t
  JOIN personal AS p ON t.id_tienda = p.id_tienda
  WHERE t.region = '$region'
  GROUP BY t.id_tienda;";
  $result = $db -> prepare($query);
  $result -> execute();
  $data = $result -> fetchAll();
  ?>

  <div class="resultado">
    <h2 align="center"> Cantidad de Trabajadores por género y promedio de edad en las tiendas de la región seleccionada </h2>
  </div>
  <div class="table-scroll">
    <table align="center">
      <tr>
        <th> ID Tienda </th>
        <th> Total Mujeres </th>
        <th> Total Hombres </th>
        <th> Promedio Edad Mujeres </th>
        <th> Promedio Edad Hombres </th>
    <?php 
  
    foreach ($data as $v) {
        echo "<tr> <td>$v[0]</td> <td>$v[1]</td> <td>$v[2]</td> <td>$v[3]</td> <td>$v[4]</td> <td>";
    }
      
    ?>
    </table>
  </div>
<?php include('../Templates/footer.html'); ?> 