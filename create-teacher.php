<?php
    //1. connect to data base 

    //creamos una variable que me diga donde esta la base de datos, en este caso localhost
    $host = "localhost"; //direccion del servidor, en este caso mi computador, sino seria una IP 
    $dbname = "hora_d_or"; // nombre de la base de datos 
    $username = "root";// la base de datos necesita un nombre de usuario y una contraseña por seguridad. root es el usuario por defecto de xampp
    $password = ""; // contraseñapor defecto de xampp

    $cnx = new PDO("mysql:host=$host; dbname=$dbname", $username,$password); //PDO =>php database object -> objetos para conectarse con bases de datos 
               //en la cadena "" ingresamos la base de datos a conectar en este caso mysql y la variable $host y separamos con punto y coma
               //ingresamosel nombre de la base de datos especifica. el nombre de usuario y la clave. esto es como un constructor con esos parametros

    session_start();


    if (isset($_POST['register'])) {

        $nombre_docente = $_POST["nombre_docente"];
        $apellido_docente = $_POST["apellido_docente"];
       // $cedula_docente = $_REQUEST["username"];
        $valor_hora = $_POST["valor_hora"];

        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $query = $cnx->prepare("SELECT * FROM docentes WHERE Cedula=:username");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->execute();
 
    if ($query->rowCount() > 0) {
        echo '<p class="error">Le professeur existe déjà </p>';
    }
    
    if ($query->rowCount() == 0) {
        $query = $cnx->prepare("INSERT INTO docentes(id_docente, Nombre, Apellido, Cedula, Valor_hora,pwd) 
        VALUES (Null, '$nombre_docente', '$apellido_docente', $username, '$valor_hora', $password)");
        
        $result = $query->execute();
 
        if ($result) {
            echo '<p class="success">Professeur créé!</p>';
        } else {
            echo '<p class="error">Something went wrong!</p>';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles\stylesReport.css" type ="text/css">
    <link rel="stylesheet" href="styles\styles.css" type ="text/css">
    <link rel="stylesheet" href="styles\stylesnavbar.css" type ="text/css">
    <title>Créer un nouveau professeur</title>
</head>
<body background="images/logo2.jpg">

<h2>Ingrese la informacion del docente </h2>
<br><br>
<form class = "form" action="" method="POST" name="signup-form">

    <label for="nombre_docente">ingresa el nombre del docente </label>
    <input type="text" id="nombre_docente" name="nombre_docente"  >
        <br>
    <label for="apellido_docente">ingresa el apellido del docente </label>
    <input type="text" id="apellido_docente" name="apellido_docente">
    <br>
    <label for="cedula_docente">ingresa la cedula del docente </label>
    <input type="text" name="username" required>
    <br>
    <label for="valor_hora">ingresa el valor de la hora del docente </label>
    <input type="text" id="valor_hora" name="valor_hora">
    <br>    
    <label for="pwd">ingresa una clave para este docente </label>
    <input type="password" name="password" required>
    <br>
<input class = "form input"  type="submit" value="Créer un nouveau professeur" name = "register">  <!boton para enviar la información al formulario> 
</form>
</body>
</html>