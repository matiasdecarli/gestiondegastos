<?php

	function conexion (){

		//entorno local
		$link = mysql_connect ("localhost","root","root");
		mysql_select_db ("gestion-de-gastos",$link) or die ("Error en la Base de Datos");
		mysql_query("SET NAMES 'UTF8'");

		//entorno prod		
		// $services_json = json_decode(getenv("VCAP_SERVICES"),true);
		// $mysql_config = $services_json["mysql-5.1"][0]["credentials"];
		// $username = $mysql_config["username"];
		// $password = $mysql_config["password"];
		// $hostname = $mysql_config["hostname"];
		// $port = $mysql_config["port"];
		// $db = $mysql_config["name"];
		// $link = mysql_connect("$hostname:$port", $username, $password);
		// $db_selected = mysql_select_db($db, $link);
		// mysql_query("SET NAMES 'UTF8'");
	}

	function recupera_combo($tabla,&$res){

		conexion ();	

		$sql = "SELECT * FROM ".$tabla." WHERE activo='1' order by nombre";
		$res =  mysql_query($sql);

	}

	function ultimos_movimientos(&$res){

		conexion();

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
	          			m.fecha DESC, m.saved_at DESC limit 50";
		$res =  mysql_query($sql);

	};

	function recupera_saldo(){

		conexion ();

		//busco ultimo saldo
		$sql = 'SELECT saldo from movimiento where activo = 1 order by saved_at DESC  limit 1';
		$row = mysql_fetch_array(mysql_query($sql)); 

		return $row['saldo'];

	}

	function busca_movimiento($id,&$res){

		conexion ();	

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

		$res =  mysql_query($sql);

	}

	function ultimos_recordatorios(&$res){

		conexion();

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
				    r.fecha ASC, r.saved_at ASC limit 10";

		$res =  mysql_query($sql);

	};

?>