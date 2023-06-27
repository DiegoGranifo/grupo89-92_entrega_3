<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Entrega 2</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="Styles/mystyles.css" />

  <style>
    .sticky {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1;
    }

    /* Added styles for the form */
    .container {
      margin-top: 50px;
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


    .btn:hover {
      background-color: #0056b3;
      cursor: pointer;
    }
    .logo {
      text-decoration: none;
      color: inherit;
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
</head>

<body class="body">
  <div class='todo'>
    <?php session_start() ?>
    <header class="header" id="sticky_header">
      <div class="primera">
        <a class="logo" href="https://codd.ing.puc.cl/~grupo89/">La Bodega 89</a>
        <form action="Consultas/login.php" method="post">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-4">
                <div class="mb-3">
                  <label for="id" class="form-label">ID Usuarios:</label>
                  <input type="text" class="form-control" id="id" name="id">
                </div>
                <div class="mb-3">
                  <label for="clave" class="form-label">Clave:</label>
                  <input type="text" class="form-control" id="clave" name="clave">
                </div>
                <br>
                <br>
                <button type="submit" class="btn btn-secondary">Log In</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </header>
  </div>
</body>
</html>
