<?php include('../Templates/header.html'); ?>

<body>
<?php

  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../Config/conexion.php");

  // Obtener la categoría seleccionada del dropdown
  $categoria = $_POST['Categoría'];

  // Construir la consulta SQL dinámicamente
  $query = "SELECT id_producto, nombre, precio FROM Productos WHERE categoria = '$categoria' ORDER BY precio DESC LIMIT 5";
  $result = $db -> prepare($query);
  $result -> execute();
  $data = $result -> fetchAll();
  ?>

  <div class="resultado">
    <h2 align="center"> Cinco productos más caros de la categoría seleccionada </h2>
  </div>
  <div class="table-scroll">
    <table align="center">
      <tr>
        <th> ID Producto </th>
        <th> Nombre Producto </th>
        <th> Precio </th>
    <?php 
  
    foreach ($data as $v) {
        echo "<tr> <td>$v[0]</td> <td>$v[1]</td> <td>$v[2]</td> <td>";
    }
      
    ?>
    </table>
  </div>
<?php include('../Templates/footer.html'); ?> 