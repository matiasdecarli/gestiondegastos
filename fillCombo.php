<?php
	include("functions.php");	
	$sql = "SELECT * FROM concepto where tipo =".$_POST['id']." and activo = 1 order by nombre";
	    try {
	        $mysqli = getConnection();
	        $res =  $mysqli->query($sql);
	        while ($row=$res->fetch_array(MYSQLI_ASSOC)){ 
				$data.= '<option value="'.$row['id'].'">'.iconv("UTF-8","UTF-8//IGNORE",$row['nombre']).'</option>';

	        }	        	       	        
	    } catch(PDOException $e) {
	        echo '{"error":{"text":'. $e->getMessage() .'}}';
	        die();
	    }	
	echo $data;
?>	