<?php

	//$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
	class conexion{
		
		private $conexion;

		function conectar() {
			$servidor = "localhost";
			$usuario = "toqenpro_tron";
			$clave = 'a$vl87X87';
			$db = "toqenpro_tron";
		
			$this->conexion = mysqli_connect($servidor, $usuario, $clave, $db);
			mysqli_set_charset($this->conexion, "utf8"); // Establecer la codificación de caracteres a UTF-8
		
			return $this->conexion;
		}
		

		function consultar($csql){
			
			$conexion=$this->conectar();
			return mysqli_query($conexion,$csql);
		}
	}

?>

