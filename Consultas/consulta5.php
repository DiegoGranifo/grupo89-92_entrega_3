
<?php include('../Templates/header.html'); ?>

<body>
<?php

  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../Config/conexion.php");

  // Obtener la categoría seleccionada
  $region = $_POST['region'];

  // Construir la consulta SQL dinámicamente
  $query = "SELECT COUNT(p.id_personal) AS total_personal
  FROM personal AS p
  JOIN tiendas AS t ON p.id_tienda = t.id_tienda
  WHERE t.region = '$region';";
  $result = $db -> prepare($query);
  $result -> execute();
  $data = $result -> fetchAll();
  ?>

  <div class="resultado">
    <h2 align="center"> Total de personas trabajando en las tiendas de la región seleccionada </h2>
  </div>
  <div class="table-scroll">
    <table align="center">
      <tr>
        <th> Total Trabajadores </th>
    <?php 
  
    foreach ($data as $v) {
        echo "<tr> <td>$v[0]</td> <td>$v[1]</td> <td>";
    }
      
    ?>
    </table>
  </div>
<?php include('../Templates/footer.html'); ?> 