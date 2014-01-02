<?php
	include('funciones.php');

	conexion ();

	$sql = "update recordatorio set activo='0' where id=".$_GET['id'];

	if (!mysql_query($sql)){									
				header('Location: index.php?resultado=error');
	}  
	else{
		mysql_close($link); 
		header('Location: index.php?resultado=ok');
	}		
?>