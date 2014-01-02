<?php
    session_start();
    if (!isset ($_SESSION["user"])){  
      header('Location: ingresar.php');  
    }

	include('funciones.php');

	conexion ();

	$sql = "INSERT into recordatorio 
			VALUES (null,
					'".$_POST['fechaBD']."',					
					'".$_POST['importe']."',
					".$_POST['concepto'].",
					".$_POST['autor'].",null,1)";

	if (!mysql_query($sql)){									
				header('Location: index.php?resultado=error');
	}  
	else{
		mysql_close($link); 
		header('Location: index.php?resultado=ok');
	}		
?>