<?php
    session_start();
    if (!isset ($_SESSION["user"])){  
      header('Location: ingresar.php');  
    }

	include('funciones.php');

	conexion ();

	$sql = 'SELECT saldo from movimiento where activo = 1 order by saved_at DESC limit 1';
	$row = mysql_fetch_array(mysql_query($sql)); 

	if ($_POST['tipo']==1)
		//ingreso
		$saldo = $_POST['importe']+$row['saldo'];	
	else
		//egreso
		$saldo = $row['saldo']- $_POST['importe'];	


	$sql = "INSERT into movimiento 
			VALUES ( null,
					'".$_POST['fechaBD']."',
					".$_POST['tipo'].",
					'".$_POST['importe']."',
					'".$saldo."',
					".$_POST['concepto'].",
					".$_SESSION["user_id"].",
					'".$_POST['comentarios']."',null,1 )";

	if (!mysql_query($sql)){									
				var_dump($sql);
				die();
				header('Location: index.php?resultado=error');
	}  
	else{
		mysql_close($link); 
		header('Location: index.php?resultado=ok');
	}	
		
?>