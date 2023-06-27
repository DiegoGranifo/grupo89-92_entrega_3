<?php include('../Templates/header.html'); ?>

<body>
<?php

  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../Config/conexion.php");

  // Obtener la categoría seleccionada del dropdown
  $comuna = $_POST['Comuna'];

  // Construir la consulta SQL dinámicamente
  $query = "SELECT id_tienda, telefono, calle, numero FROM tiendas WHERE comuna LIKE '%$comuna%';";
  $result = $db -> prepare($query);
  $result -> execute();
  $data = $result -> fetchAll();
  ?>

  <div class="resultado">
    <h2 align="center"> Teléfono y Dirección de las Tiendas de la comuna seleccionada </h2>
  </div>
  <div class="table-scroll">
    <table align="center">
      <tr>
        <th> ID Tienda </th>
        <th> Teléfono </th>
        <th> Calle </th>
        <th> N° del Inmueble </th>
    <?php 
  
    foreach ($data as $v) {
        echo "<tr> <td>$v[0]</td> <td>$v[1]</td> <td>$v[2]</td> <td>$v[3]</td> <td>";
    }
      
    ?>
    </table>
  </div>
<?php include('../Templates/footer.html'); ?> 


