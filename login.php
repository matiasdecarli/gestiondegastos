<?php 	
	session_start();
	include ("functions.php"); 	
		
	if(trim($_POST["user"]) && trim($_POST["password"])){
		$usuario = strtolower(htmlentities($_POST["user"], ENT_QUOTES));
		$password = md5($_POST["password"]);

		$sql = 'SELECT * FROM usuario WHERE user=\''.$usuario.'\'';
	    try {
	        $mysqli = getConnection();
	        $res = $mysqli->query($sql);
	        $result = array();
	        while ($row=$res->fetch_array(MYSQLI_ASSOC)){ 
	        	$result[] = $row;
	        }	      
	        if ($result[0]){
	        	if($result[0]['password'] == $password){
						//session_start();
						$_SESSION["user"] = $result[0]['user'];	
						$_SESSION["user_id"] = $result[0]['id'];						  						
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
			catch(PDOException $e) {
		        echo '{"error":{"text":'. $e->getMessage() .'}}';
		        die();
		    }		
		}	
		else{
			$mensaje = "Datos incompletos";
			header('Location: ingresar.php?mensaje='.$mensaje);
		}			
	    			
?>

