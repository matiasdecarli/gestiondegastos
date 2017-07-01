<?php
    session_start();
    if (!isset ($_SESSION["user"])){
      header('Location: enter.php');
    }

	include('functions.php');

	$sql = "INSERT into recordatorio
			VALUES (null,
					'".$_POST['fechaBD']."',
					'".$_POST['importe']."',
					".$_POST['concepto'].",
					".$_SESSION["user_id"].",1,null)";
    try {
        $mysqli = getConnection();
		$mysqli->query($sql);
		header('Location: index.php?resultado=ok');
    } catch(PDOException $e) {
    	echo '{"error":{"text":'. $e->getMessage() .'}}';
      header('Location: index.php?resultado=error');
    }
?>
