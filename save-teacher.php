<?php

    $nombre_docente = $_REQUEST["nombre_docente"];
    $apellido_docente = $_REQUEST["apellido_docente"];
    $cedula_docente = $_REQUEST["username"];
    $valor_hora = $_REQUEST["valor_hora"];
    $pwd = $_REQUEST["password"];
    //     echo $nombre_docente; //imprimimos el contenido de la variable nombre_docente
   //      var_dump($_REQUEST); // imrpime todo lo que viene en la variable request

    //1. connect to data base 

    //creamos una variable que me diga donde esta la base de datos, en este caso localhost
    $host = "localhost"; //direccion del servidor, en este caso mi computador, sino seria una IP 
    $dbname = "hora_d_or"; // nombre de la base de datos 
    $username = "root";// la base de datos necesita un nombre de usuario y una contraseña por seguridad. root es el usuario por defecto de xampp
    $password = ""; // contraseñapor defecto de xampp

    $cnx = new PDO("mysql:host=$host; dbname=$dbname", $username,$password); //PDO =>php database object -> objetos para conectarse con bases de datos 
               //en la cadena "" ingresamos la base de datos a conectar en este caso mysql y la variable $host y separamos con punto y coma
               //ingresamosel nombre de la base de datos especifica. el nombre de usuario y la clave. esto es como un constructor con esos parametros


    //2. construir la sentencia sql 
    $sql = "INSERT INTO docentes (id_docente, Nombre, Apellido, Cedula, Valor_hora,pwd) 
    VALUES (Null, '$nombre_docente', '$apellido_docente', '$cedula_docente', '$valor_hora', '$pwd')"; //sentencia sql para 
                                                        //insertar datos en la base de datos 

    //3. preparar sentencia 
    $q = $cnx -> prepare ($sql); // con esta sentenciase prepara la conexion a la basa de datos y a la sentencia sql, ahora 
                                // hay que ejecutarla. 
    
    //4. ejecutar sentencia 
    $result = $q -> execute(); //me interesa un resultado para saber si hay un error //execute es un metodo de php

    if($result){
        echo "Professeur crée avec succès"; 
    }
    else{
        echo "ERREUR en créant le professeur $nombre_docente";
    }

?>

