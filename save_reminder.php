<?php
    session_start();
    if (!isset ($_SESSION["user"])){  
      header('Location: ingresar.php');  
    }

	include('functions.php');

	$sql = "INSERT into recordatorio 
			VALUES (null,
					'".$_POST['fechaBD']."',					
					'".$_POST['importe']."',
					".$_POST['concepto'].",
					".$_POST['autor'].",null,1)";
    try {
        $mysqli = getConnection();
		$mysqli->query($sql);
		header('Location: index.php?resultado=ok');	       
    } catch(PDOException $e) {
    	echo '{"error":{"text":'. $e->getMessage() .'}}';
    	header('Location: index.php?resultado=error');	        
    }	
?>