<?php
    session_start();
    if (!isset ($_SESSION["user"])){  
      header('Location: enter.php');  
    }

	include('functions.php');

	$mysqli = getConnection();
	$saldo = getSaldo();

	if ($_POST['type']==1){
		//ingreso
		$saldo = $_POST['importe']+$saldo;	}
	else{
		//egreso
		$saldo = $saldo - $_POST['importe'];	
	}

	$sql = "INSERT into movimiento 
			VALUES ( null,
					'".$_POST['fechaBD']."',
					".$_POST['type'].",
					'".$_POST['importe']."',
					'".$saldo."',
					".$_POST['concept'].",
					".$_SESSION["user_id"].",
					'".$_POST['comentarios']."',null,1 )";
	    try {
	        $mysqli = getConnection();
			$mysqli->query($sql);
    		header('Location: index.php?resultado=ok');	       
	    } catch(PDOException $e) {
	    	echo '{"error":{"text":'. $e->getMessage() .'}}';
	    	header('Location: index.php?resultado=error');	        
	    }
?>