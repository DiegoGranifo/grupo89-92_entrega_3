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
if(isset($_SESSION["user_id"]) ) {
    if ($_SESSION["user_type"] == "Cliente") {
            echo '<div class="body_3">';
            echo '<h3 align="center"> Bienvenido a bodega 89 revisa tu perfil y tu historial de compra</h3>';
            echo '<a class="nav-link" href="Consultas/profile.php">Perfil</a>';
            echo '</div>';

          #Agregar hacer compra de usuario aqui

        } else {
          echo '<div class="body_3">';
            echo '<h3 align="center">Buenos dias Administrador</h3>';
            ##Agregar features de Admon Aqui
            echo '</div>';

           
          
        }}
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




