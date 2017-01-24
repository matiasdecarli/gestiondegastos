<?php

	function getConnection(){

		//local	
		// $mysqli = new mysqli("localhost","root","root","gestion-de-gastos");

		//prod		
		$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

		$server = getenv("SERVER");
		$username = getenv("USERNAME");
		$password = getenv("PASSWORD");
		$db = getenv("DB");

		$mysqli = new mysqli($server, $username, $password, $db);

		if (mysqli_connect_errno()) {
		    printf("Connect failed: %s\n", mysqli_connect_error());
		    exit();
		}
		$mysqli->query("SET NAMES 'UTF8'");
		return $mysqli;	  

		mysql_query("SET NAMES 'UTF8'");
	}

	function getCombo($concept) {
	   $sql = "SELECT * FROM ".$concept." WHERE activo='1' order by nombre";
	    try {
	        $mysqli = getConnection();
	        $res =  $mysqli->query($sql);
	        $result = array();
	        while ($row=$res->fetch_array(MYSQLI_ASSOC)){ 
	        	$result[] = $row;
	        }	        
	        return $result;
	    } catch(PDOException $e) {
	        echo '{"error":{"text":'. $e->getMessage() .'}}';
	        die();
	    }
	}

	function getLastMovements($limit){
		 $sql = "SELECT 
							m.id as id,
				            m.fecha as fecha,
				            t.nombre as tipo,
				            m.importe as importe,
				            m.saldo as saldo,
				            c.nombre as concepto,
				            a.nombre as autor
				FROM movimiento as m
				           left join concepto as c on m.concepto = c.id    
				           left join tipo as t on m.tipo = t.id     
				           left join usuario as a on a.id=m.autor
				WHERE
				          m.activo=1
	          	ORDER BY  
	          			m.fecha DESC, m.saved_at DESC limit ".$limit;
	    try {
	        $mysqli = getConnection();
	        $res =  $mysqli->query($sql);
	        $result = array();
	        while ($row=$res->fetch_array(MYSQLI_ASSOC)){ 
	        	$result[] = $row;
	        }	        
	        return $result;
	    } catch(PDOException $e) {
	        echo '{"error":{"text":'. $e->getMessage() .'}}';
	        die();
	    }
	};

	function getSaldo(){
		$sql = "SELECT saldo from movimiento where activo = 1 order by saved_at DESC limit 1";
	    try {
	        $mysqli = getConnection();
	        $result = $mysqli->query($sql)->fetch_row();
	        return $result[0];
	    } catch(PDOException $e) {
	        echo '{"error":{"text":'. $e->getMessage() .'}}';
	        die();
	    }	
	}

	function getMovement($id){
		$sql = "SELECT 
							m.id as id,
				            m.fecha as fecha,
				            t.nombre as tipo,
				            m.importe as importe,
				            m.saldo as saldo,
				            c.nombre as concepto,
				            m.comentarios as comentarios,
				            a.nombre as autor
				FROM movimiento as m
				           left join concepto as c on m.concepto = c.id    
				           left join tipo as t on m.tipo = t.id     
				           left join usuario as a on a.id=m.autor
				WHERE
						  m.id = ".$id." AND
				          m.activo=1";
	    try {
	        $mysqli = getConnection();
	        $res =  $mysqli->query($sql);
	        $result = array();
	        while ($row=$res->fetch_array(MYSQLI_ASSOC)){ 
	        	$result[] = $row;
	        }	        
	        return $result[0];
	    } catch(PDOException $e) {
	        echo '{"error":{"text":'. $e->getMessage() .'}}';
	        die();
	    }
	}

	function getReminders($limit) {
	   $sql = "SELECT 
					r.id as id,
			        r.fecha as fecha,
			        r.importe as importe,
			        mr.nombre as concepto,
			        a.nombre as autor
				FROM recordatorio as r
				       left join motivo_recordatorio as mr on r.motivo_recordatorio = mr.id    
				       left join usuario as a on a.id=r.autor
				WHERE
				      r.activo=1
				ORDER BY  
				    r.fecha ASC, r.saved_at ASC limit ".$limit;
	    try {
	        $mysqli = getConnection();
	        $res =  $mysqli->query($sql);
	        $result = array();
	        while ($row=$res->fetch_array(MYSQLI_ASSOC)){ 
	        	$result[] = $row;
	        }	        
	        return $result;
	    } catch(PDOException $e) {
	        echo '{"error":{"text":'. $e->getMessage() .'}}';
	        die();
	    }
	}

?>
