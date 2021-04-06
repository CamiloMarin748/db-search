<?php
    //1. connect to data base 
    $host = "localhost"; 
    $dbname = "hora_d_or"; 
    $username = "root";
    $password = ""; 

    $cnx = new PDO("mysql:host=$host; dbname=$dbname", $username,$password); //PDO =>php database object -> objetos para conectarse con bases de datos 
    $cnx2 = new PDO("mysql:host=$host; dbname=$dbname", $username,$password);
    $cnx3 = new PDO("mysql:host=$host; dbname=$dbname", $username,$password);
    //2. construir la sentencia sql 
    $sql = "SELECT  * FROM cursos"; 
    $sql2 = "SELECT  id_docente, Nombre FROM docentes";
    $sql3 = "SELECT  id_reporte FROM reportes";
    //3. preparar sentencia 
    $q = $cnx -> prepare ($sql); 
    $p = $cnx2 -> prepare ($sql2); 
    $o = $cnx3 -> prepare ($sql3); 

    //4. ejecutar sentencia 
    $result = $q -> execute(); 
    $result2 = $p -> execute(); 
    $result3 = $o -> execute(); 


    $cursos = $q->fetchAll();
    $docentes = $p -> fetchAll();
    $reportes =$o -> fetchAll();
    //var_dump($docentes);
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

    <title>Reporte de horas</title>
</head>
<br>
<body background="images/logo2.jpg" >

<nav class="topnav">
<a class="active" href="bienvenido_docente.php">Acceuille</a>
            <a href="create-report.php">Reportar Horas</a>
            <a href="reportes\consultar_reportes.php">Consultar Reportes </a> 
            <a href="reportes\consultar_salarios.php">Consultar Salarios </a>  
        </nav>
    <br>
  
    <h2>En este formulario debes ingresar <br> la información del curso en el cual diste clase.</h2>


<main>
<form class="form" action="save-report.php" method="POST">


<label for="docente">selecciona el docente </label>
      <select name="docente" id="docente">
      <?php
        for($i=0; $i<count($docentes); $i++){
          ?>
          <option value="<?php echo $docentes[$i]["id_docente"]?>">
          <?php echo $docentes[$i]["Nombre"]?></option>
          <?php
        }

      ?>
      </select>

  
<br>
    <label for="meses">selecciona un mes</label>
        <select name="meses" id="meses">
            <option value="1">Enero</option>
            <option value="2">Febrero</option>
            <option value="3">Marzo</option>
            <option value="4">Abril</option>
            <option value="5">Mayo</option>
            <option value="6">Junio</option>
            <option value="7">Julio</option>
            <option value="8">Agosto</option>
            <option value="9">Septiembre</option>
            <option value="10">Octubre</option>
            <option value="11">Noviembre</option>
            <option value="12">Diciembre</option>
        </select>
    <br>


    <label for="curso">selecciona el curso </label>
      <select name="curso" id="curso">
      <?php
        for($i=0; $i<count($cursos); $i++){
          ?>
          <option value="<?php echo $cursos[$i]["NombreCurso"]?>">
          <?php echo $cursos[$i]["NombreCurso"]?></option>
          <?php
        }
      ?>
      </select>
<br>



<label for="TipoCurso">selecciona el tipo de curso </label>
      <select name="TipoCurso" id="TipoCurso">
      <?php
        for($i=0; $i<count($cursos); $i++){
          ?>
          <option value="<?php echo $cursos[$i]["TipoCurso"]?>">
          <?php echo $cursos[$i]["TipoCurso"]?></option>
          <?php
        }
      ?>
      </select>
<br>

      <label for="nivel">selecciona el nivel del curso </label>
      <select name="nivel" id="nivel">
      <?php
        for($i=0; $i<count($cursos); $i++){
          ?>
          <option value="<?php echo $cursos[$i]["Nivel"]?>">
          <?php echo $cursos[$i]["Nivel"]?></option>
          <?php
        }
      ?>
      </select>   

    <br>    
    
    <label for="numestu">ingresa el numero de estudiantes </label>
    <input type="int" id="numestu" name="numestu">
     
    <label for="modulo">ingresa el módulo </label>
    <input type="text" id="modulo" name="modulo">

    <label for="horario">indica el horario</label>
    <input type="text" id="horario" name="horario">

    <?php
        for($i=0; $i<count($reportes); $i++){
          $id_repo=$reportes[$i]["id_reporte"];
         }
      ?>
    <label for="id_repo"><?php /*echo $id_repo*/?></label>
    <input id="id_repo" name="id_repo" type="hidden" value="<?php echo $id_repo?> ">

    <input class = "form input" type="submit" value="Enviar información del grupo">  
  </form>
</main>

</body>
<br>

  <a class = "link" href="index.php">Aller à la page d'acceuille </a>


</html>