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
          '".$saldo."',
					'".$_POST['fechaBD']."',
          '".$_POST['comentarios']."'
          '".$_POST['importe']."',
          ".$_POST['concept'].",
					".$_POST['type'].",
          1,
					".$_SESSION["user_id"].",
					,null )";
	    try {
	      $mysqli = getConnection();
        $mysqli->query($sql);
        header('Location: index.php?resultado=ok');
	    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
        header('Location: index.php?resultado=error');
	    }
?>
