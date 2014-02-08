<?php
	session_start();
    if (!isset ($_SESSION["user"])){  
      header('Location: enter.php');  
    }

	include('functions.php');

	$sql = "update recordatorio set activo='0' where id=".$_GET['id'];
    try {
        $mysqli = getConnection();
		$mysqli->query($sql);
		header('Location: index.php?resultado=ok');	       
    } catch(PDOException $e) {
    	echo '{"error":{"text":'. $e->getMessage() .'}}';
    	header('Location: index.php?resultado=error');	        
    }		
?>