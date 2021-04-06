<?php
    $fecha = $_REQUEST["fecha"];
    $horas = $_REQUEST["horas"];
    $id_docente = $_REQUEST["id_docente"];
    $id_repo = $_REQUEST["id_repo"];
    //1. Connecta to db

    $host = "localhost"; //direccion del servidor, en este caso mi computador, sino seria una IP 
    $dbname = "hora_d_or"; // nombre de la base de datos 
    $username = "root";// la base de datos necesita un nombre de usuario y una contraseña por seguridad. root es el usuario por defecto de xampp
    $password = ""; // contraseñapor defecto de xampp

    $cnx = new PDO("mysql:host=$host; dbname=$dbname", $username,$password); 
    $cnx3 = new PDO("mysql:host=$host; dbname=$dbname", $username,$password);
    
     //2. construir la sentencia sql 
     
    
     $sql = "INSERT INTO fechas_horas (id, fecha, horas, id_docente, id_reporte) 
        VALUES (Null, '$fecha','$horas', '$id_docente', $id_repo)";
    

    //3. preparar sentencia 
    
    

    $q = $cnx -> prepare ($sql);

    //4. ejecutar sentencia 
   
   
    $result = $q -> execute();

  

    if($result){
        echo "<br><br><br><br>";
        echo "<h2>Reporte enviado !\n </h2";

        echo "siga el enlace para ingresar las fechas y las horas\n"; 
        echo "<br><br>";
        ?>
       <br><br>
        <?php
    }
    else{
        echo "ERREUR en envoyant le report";
    }
    ?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles\styles.css" type ="text/css">
        <link rel="stylesheet" href="styles\stylesReport.css" type ="text/css">

        <title>Guardar horas</title>
    </head>
    
    <body background="images/logo2.jpg" >   

     <form class="form" action="save-horas.php" method="POST">
      <label for="fecha">ingresa la fecha</label>
      <input type="date" id="fecha" name="fecha">   
        <br>
        <label for="horas">ingresa el numero de horas</label>
          <input type="float" id="horas" name="horas">
        <br>
        <input type="submit" value="Enviar fecha y horas">  
        
        <label for="id_docente"></label>
        <input id="id_docente" name="id_docente" type="hidden" value="<?php echo $id_docente?> ">

        <label for="id_repo"></label>
        <input id="id_repo" name="id_repo" type="hidden" value="<?php echo $id_repo?> ">
        </form>     

        <br><br>
        <br><a href="bienvenido_docente.php">Terminar</a><br>
    </body>
    <br><br>
    <a class = "link" href="index.php">Aller à la page d'acceuille </a>

    </html> 