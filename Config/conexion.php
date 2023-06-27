<?php
    try {
        require('data.php'); # pido los datos de ese archivo
        $db = new PDO("pgsql:dbname=$databaseName;host=localhost;port=5432;user=$usuario;password=$contrasena");
    } catch (Exception $e){
        echo "No se pudo conectar a la base de datos: $e";  
    }
?>
<?php
  try {
    #Pide las variables para conectarse a la base de datos.
    require('data.php'); 
    # Se crea la instancia de PDO
    $db2 = new PDO("pgsql:dbname=$databaseName_2;host=localhost;port=5432;user=$user;password=$password");
  } catch (Exception $e) {
    echo "No se pudo conectar a la base de datos: $e";
  }
?>