<?php

    $nombre_curso = $_REQUEST["nombre_curso"];
    $tipo_curso = $_REQUEST["tipo_curso"];
    $nivel = $_REQUEST["nivel"];
    
    //1. connect to data base 

    $host = "localhost"; //direccion del servidor, en este caso mi computador, sino seria una IP 
    $dbname = "hora_d_or"; // nombre de la base de datos 
    $username = "root";// la base de datos necesita un nombre de usuario y una contraseña por seguridad. root es el usuario por defecto de xampp
    $password = ""; // contraseñapor defecto de xampp

    $cnx = new PDO("mysql:host=$host; dbname=$dbname", $username,$password); //PDO =>php database object -> objetos para conectarse con bases de datos 
    

    //2. construir la sentencia sql 
    $sql = "INSERT INTO cursos (id_curso, NombreCurso, TipoCurso, Nivel) 
    VALUES (Null, '$nombre_curso', '$tipo_curso', '$nivel')"; 
                                                        

    //3. preparar sentencia 
    $p = $cnx -> prepare ($sql); 
                
    
    //4. ejecutar sentencia 
    $result = $p -> execute(); //me interesa un resultado para saber si hay un error //execute es un metodo de php

    if($result){
        echo "Cours crée avec succès"; 
    }
    else{
        echo "ERREUR en créant le cours ";
    }

?>

