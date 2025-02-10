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

	function obtenerDatosUsuario($cod_user){
		$csql = "        
		SELECT * FROM users 
		WHERE cod_user = '$cod_user'
		";
		$obc = new conexion();
		return $obc->consultar($csql);
	}

    function verificarUserName($user_name, $cod_user){
		$csql = "		
		SELECT * FROM users 
		WHERE user_name = '$user_name' AND cod_user != '$cod_user'
		";
		$obc = new conexion();
		return $obc->consultar($csql);
	}

    function actualizarUsuario($cod_user, $nom_user, $user_name, $user_phone, $user_country, $user_pic){
		$csql = "		
		UPDATE users SET
		nom_user = '$nom_user',
		user_name = '$user_name',
		user_phone = '$user_phone',
		user_country = '$user_country',
		user_pic = '$user_pic'
		WHERE cod_user = '$cod_user'
		";
		$obc = new conexion();
		return $obc->consultar($csql);
	}
	
	function actualizarPassword($cod_user, $pass_user){
        $csql = "        
        UPDATE users SET
        pass_user = '$pass_user'
        WHERE cod_user = '$cod_user'
        ";
        $obc = new conexion();
        return $obc->consultar($csql);
    }

    function actualizarImagenUsuario($cod_user, $user_pic){
        $csql = "        
        UPDATE users SET
        user_pic = '$user_pic'
        WHERE cod_user = '$cod_user'
        ";
        $obc = new conexion();
        return $obc->consultar($csql);
    }

	function getUserByEmail($email_user) {
        $csql = "SELECT cod_user FROM users WHERE email_user = '$email_user'";
        $obc = new conexion();
        $result = $obc->consultar($csql);
        return mysqli_fetch_assoc($result);
    }

    function getUserCoinData($cod_user) {
        $csql = "SELECT * FROM coins_user WHERE cod_user = '$cod_user'";
        $obc = new conexion();
        $result = $obc->consultar($csql);
        return mysqli_fetch_assoc($result);
    }

    function updateCoinAmounts($sender_cod_user, $receiver_cod_user, $amount, $symbol_coin) {
        $amount = number_format($amount, 2, '.', ''); // Ensure 2 decimal places
        $csql_sender = "UPDATE coins_user SET amount_coin = ROUND(amount_coin - $amount, 2) 
                        WHERE cod_user = '$sender_cod_user' AND symbol_coin = '$symbol_coin'";
        $csql_receiver = "UPDATE coins_user SET amount_coin = ROUND(amount_coin + $amount, 2) 
                          WHERE cod_user = '$receiver_cod_user' AND symbol_coin = '$symbol_coin'";
        
        $obc = new conexion();
        $result_sender = $obc->consultar($csql_sender);
        $result_receiver = $obc->consultar($csql_receiver);
        
        return $result_sender && $result_receiver;
    }


	function getUserCoinDataSaldo($cod_user) {
        $csql = "SELECT * FROM coins_user WHERE cod_user = '$cod_user'";
        $obc = new conexion();
        return $obc->consultar($csql);
        
    }
	
	/**********************************************/
}

