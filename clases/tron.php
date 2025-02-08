<?php
class cTrons
{

	function loguearUsuario($email_user, $pass_user){
		$csql = "		
		SELECT * FROM users 
		WHERE email_user = '$email_user' and pass_user = '$pass_user'
		
		";
		$obc = new conexion();
		return $obc->consultar($csql);
	}

	function crearUsuario($user_name, $email_user, $pass_user){
		$csql = "		
		INSERT INTO  users  
		(user_name, email_user, pass_user)
		 
		VALUES  
		('$user_name', '$email_user', '$pass_user');	
		";
		$obc = new conexion();
		return $obc->consultar($csql);
	}


	function verificarUser($user_name, $email_user){
		$csql = "		
		SELECT * FROM users 
		WHERE user_name = '$user_name' or email_user = '$email_user'	
		";
		$obc = new conexion();
		return $obc->consultar($csql);
	}
	




	/**********************************************/
}

