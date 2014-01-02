<?php
	
	include("funciones.php");	
	conexion();	

	$sql = "SELECT * FROM concepto where tipo =".$_POST['id']." and activo = 1 order by nombre";
	$res = mysql_query($sql);

	$data='<option value="0">-Selccionar-</option>';
	while ($fila = mysql_fetch_array($res)){
		$data.= '<option value="'.$fila['id'].'">'.iconv("UTF-8","UTF-8//IGNORE",$fila['nombre']).'</option>';
	}	

	echo $data;
?>	