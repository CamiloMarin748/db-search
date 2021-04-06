<?php

$id_docente = $_REQUEST['id_docente'];
$id_repo = $_REQUEST['id_reporte'];
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
    <title>Guardar horas</title>
</head>
<body background="images/logo2.jpg">

<br><br><br>
    <form class="form" action="save-horas.php" method="POST">
     <label for="fecha">ingresa la fecha</label> 
      <input type="date" id="fecha" name="fecha">   
        <br>
       <label for="horas">ingresa el numero de horas</label> 
        <input type="float" id="horas" name="horas">
        <br>
        <input type="submit" value="Enviar fecha y horas">  
        
        <label for="id_docente"><?php /*echo $id_docente*/?></label>
        <input id="id_docente" name="id_docente" type="hidden" value="<?php echo $id_docente?> ">

        <label for="id_repo"><?php /* echo $id_repo*/?></label>
        <input id="id_repo" name="id_repo" type="hidden" value="<?php echo $id_repo?> ">

      </form>
</body>
<br><br>
<a class = "link" href="index.php">Aller à la page d'acceuille </a>
</html>