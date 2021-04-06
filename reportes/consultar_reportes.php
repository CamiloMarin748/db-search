<?php

//$fecha = $_REQUEST['fecha'];

$operand = "";
if (isset($_REQUEST['operand'])){
    $operand = $_REQUEST['operand'];
    //echo $operand;
}

$where = ' ';
if (isset($_REQUEST['docente'])){
    $docente = $_REQUEST['docente'];
    /*echo $docente;*/
    if ($docente != ""){
            $where = "WHERE d.Nombre = '$docente'";
    }
}
if (isset($_REQUEST['curso'])){
    $curso = $_REQUEST['curso'];
    //echo $curso;
    if ($curso != ""){
        if ($where==""){
            $where = "WHERE r.nom_curso = '$curso'"; 
        }
      else {
        $where = "$where $operand r.nom_curso = '$curso'";
      }
    }
}

if (isset($_REQUEST['fecha'])){
    $fecha = $_REQUEST['fecha'];
    if ($fecha != ""){
        if ($where!=""){
            $where = "WHERE f.fecha = '$fecha'";
        }
        else{
            $where = "$where $operand f.fecha = '$fecha'";
        }
    }
}

//1. connect to data base 
    $host = "localhost"; 
    $dbname = "hora_d_or"; 
    $username = "root";
    $password = ""; 

    $cnx = new PDO("mysql:host=$host; dbname=$dbname", $username,$password); //PDO =>php database object -> objetos para conectarse con bases de datos 
    
    //2. construir la sentencia sql 
    $sql = "SELECT d.Nombre, d.Apellido, d.Cedula, r.nom_curso, f.fecha, f.horas FROM docentes as d 
    JOIN reportes r ON d.id_docente = r.id_docente 
    JOIN fechas_horas f ON r.id_reporte = f.id_reporte  
    $where
    ORDER BY d.Nombre ASC" ; 
    
    $sql2 = "SELECT  id_docente, Nombre FROM docentes";

    $sql3 = "SELECT NombreCurso FROM cursos";

    //3. preparar sentencia 
    $q = $cnx -> prepare ($sql); 
    $p = $cnx -> prepare ($sql2); 
    $o = $cnx -> prepare ($sql3);
    //4. ejecutar sentencia 
    $result = $q -> execute(); 
    $result2 = $p -> execute(); 
    $result3 = $o -> execute();

    $reportes = $q -> fetchAll();
    $docentes = $p -> fetchAll();
    $cursos = $o ->fetchAll();

    //var_dump($reportes);
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="stylesConsultas.css" type ="text/css">
        <link rel="stylesheet" href="..\styles\styles.css" type ="text/css">
        <link rel="stylesheet" href="..\styles\stylesnavbar.css" type ="text/css">

        <title>Consulta de reportes</title>
        <br>
    </head>

    <body >
    <nav class="topnav">
    <a class="active" href="..\bienvenido_docente.php">Acceuille</a>
            <a href="..\create-report.php">Reportar Horas</a>
            <a href="consultar_reportes.php">Consultar Reportes </a> 
            <a href="consultar_salarios.php">Consultar Salarios </a>  
        </nav>
    <br>

        <h2> Consulta de reportes de horas </h2>
      
      <form class="form" action="consultar_reportes.php">
     
       <label for="docente">Consulta por docente </label>
      
        <select name="docente" >
        <option value="">selecciona</option>
        <?php
        for($i=0; $i<count($docentes); $i++){
          ?>
          <option value="<?php echo $docentes[$i]["Nombre"]?>">
          <?php echo $docentes[$i]["Nombre"]?> </option>
          <?php
        }
      ?>
        </select >
<br>
        
      <label for="curso">Consulta por curso </label>
        
        <select name="curso" >
        <option value="">selecciona</option>
        <?php
        for($i=0; $i<count($cursos); $i++){
          ?>
          <option value="<?php echo $cursos[$i]["NombreCurso"]?>">
          <?php echo $cursos[$i]["NombreCurso"]?></option>
          <?php
        }
      ?>
        </select >
        <br>
        Consulta por fecha <input type="date" name= "fecha" value = "<?php /*echo $fecha; */?>">
        
<br>

        <button class = "form input" name="operand" type="submit" value="OR">Uno de los filtros</button>
        <br>
        <button class = "form input" name="operand" type="submit" value="AND">Todos los filtros</button>
      <br>
      
      </form>  
        
        <table class ="table">
            <thead>
                <td> Nombre </td>

                <td> Apellido </td>

                <td> Cédula </td>

                <td> Nombre del curso </td>

                <td> Fecha </td>

                <td> Número de horas </td>
            </thead>
    <?php for ($i =0; $i<count($reportes); $i++ ){ ?>
                <tr>
                    <td> <?php echo $reportes[$i]["Nombre"];?> </td>

                    <td> <?php echo $reportes[$i]["Apellido"]; ?> </td>
            
                    <td> <?php echo $reportes[$i]["Cedula"]; ?> </td>

                    <td> <?php echo $reportes[$i]["nom_curso"]; ?> </td>

                    <td> <?php echo $reportes[$i]["fecha"]; ?> </td>

                    <td> <?php echo $reportes[$i]["horas"]; ?>
                    </td>
            </tr>
    <?php } ?>
            </table>
    </body>
    <br><br>
    <a class = "link" href="../index.php">Aller à la page d'acceuille </a>

    </html>