<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <title> Entrega 2 </title>

    <link
      rel="stylesheet"
      type="text/css"
    />

    <link rel="stylesheet" href="Styles/mystyles.css" />

    <style>
      .sticky {
        position: fixed;
        top: 0;
        width: 100%;
        z-index:-1;
      }
      .btn:hover {
      background-color: #0056b3;
      cursor: pointer;
    }
    .btn-purple {
    background-color: rgb(71, 62, 118);
    color: white;
  }
    </style>
    <script>
      // Cuando el usuario baje la pagina, se ejecuta myFunction
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
<div class = 'todo'>
<?php session_start() ?>

<body class = "body">

  <header class="header" id="sticky_header">
    <div text-align = center class="primera">
      <a class="logo"> La Bodega 89 </a>
      <p> Aquí podrás encontrar información sobre nuestros productos y tus compras.</p>
      <?php
        if(isset($_SESSION["user_id"]) ) {
            echo '
                      <a class="nav-link" href="Consultas/logout.php"  style="color: white;">Logout</a>';
        } else {
            // User is not logged in
            echo '
                      <a class="nav-link" href="login_index.php" style="color: white;" >Login</a>

                 ';
        }
        ?>
      
    

    </div>


  </header>
  <?php
if (isset($_SESSION["user_id"])) {
  if ($_SESSION["user_type"] == "Cliente") {
      echo '<div class="body_3">';
      echo '<h3 align="center">Bienvenido a bodega 89, revisa tu perfil y tu historial de compra</h3>';
      echo '<a class="nav-link" href="Consultas/profile.php">Perfil</a>';
      echo '</div>';

      # Agregar hacer compra de usuario aquí

  } else {
      echo '<div class="body_3">';
      echo '<h3 align="center">Buenos días Administrador</h3>';
      ## Agregar features de Administrador aquí
      echo '</div>';
      require("Config/conexion.php");
      $result = $db->prepare("SELECT DISTINCT region FROM tiendas;");
      $result->execute();
      $dataCollected = $result->fetchAll();

      echo '<div class="body_3">';
      echo '<h3 align="center">Elige una región</h3>';

      if (isset($_POST['region_1'])) {
        ## SI ya dio la region
          $selectedRegion = $_POST['region_1'];
          echo '<h4 align="center">Región seleccionada: ' . $selectedRegion . '</h4>';
          $query = "SELECT id_tienda FROM tiendas WHERE tiendas.region = '$selectedRegion';";
          $result2 = $db->prepare($query);
          $result2->execute();
          $dataCollected2 = $result2->fetchAll();

          echo '<h3 align="center">Elige una tienda</h3>';
          echo '<form align="center" action="Consultas/consulta_tienda.php" method="post">';
          echo '<div align="center">';
          echo '  <select name="tienda_id" style="width: 200px;">';
          ### Nombre variable de id es tienda_id Seguir con el id de la tienda en consulta_tienda.php
          foreach ($dataCollected2 as $d) {
              echo "<option value='$d[0]'>$d[0]</option>";
          }
          echo '  </select>';
          echo '  <br><br>';
          echo '  <input type="submit" name="submit" value="Buscar">';
          echo '</div>';
          echo '</form>';

      } else {
        ## Form pars obtener la region, refresca la pagina al apretar el boton y se ejecuta el if de arriba
          echo '<form align="center" action="" method="post">';
          echo '<div align="center">';
          echo '  <select name="region_1" style="width: 200px;">';
          foreach ($dataCollected as $d) {
              echo "<option value='$d[0]'>$d[0]</option>";
          }
          echo '  </select>';
          echo '  <br><br>';
          echo '  <input type="submit" name="submit" value="Buscar">';
          echo '</div>';
          echo '</form>';
      }
      echo '</div>';
      echo '<br>';
      echo '<br>';
      echo '<br>';
  }
}


           

        ?>
        
  <div class="body_3">  
  <form action="Consultas/imp_usarios.php" method="post">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-4">
          <button type="submit" class="btn btn-sm btn-purple">Importar Usuarios</button>
        </div>
      </div>
    </div>
  </form>
</div>




