<?php 	
	session_start();

	include ("funciones.php"); 	
		
	if(trim($_POST["user"]) && trim($_POST["password"])){
		$usuario = strtolower(htmlentities($_POST["user"], ENT_QUOTES));
		$password = md5($_POST["password"]);
		conexion ($link);  //SEGURIDAD
		$result = mysql_query('SELECT * FROM usuario WHERE user=\''.$usuario.'\'');
		if($row = mysql_fetch_array($result)){
				if($row['password'] == $password){
						session_start();
						$_SESSION["user"] = $row['user'];	
						$_SESSION["user_id"] = $row['id'];						  						
						header('Location: index.php');}
				 else{
					 $mensaje = "Password Incorrecto";
					header('Location: ingresar.php?mensaje='.$mensaje);}
		}
		else{
			mysql_free_result($result);
			$mensaje = "Usuario no existente";
			header('Location: ingresar.php?mensaje='.$mensaje);
			}
		}
	else{
		$mensaje = "Datos incompletos";
		header('Location: ingresar.php?mensaje='.$mensaje);}	
?>

