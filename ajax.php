<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 0);
error_reporting(0);


session_start();

include('conex/conex.php');
include('clases/tron.php');
$website = 'https://tronvault.io';

if(isset($_POST['action']) && $_POST['action'] === 'actualizarImagen'){
    $cod_user = $_POST['cod_user'];
    
    if(!isset($_FILES['user_pic'])) {
        echo "bad";
        exit;
    }

    $file = $_FILES['user_pic'];
    $allowed_types = ['image/png', 'image/jpg', 'image/jpeg'];

    if (!in_array($file['type'], $allowed_types)) {
        echo "bad";
        exit;
    }

    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/assets/images/avatar/';
    $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $new_filename = substr(str_shuffle(md5(uniqid(mt_rand(), true))), 0, 20) . '.' . $file_extension;
    $upload_path = $upload_dir . $new_filename;

    if (move_uploaded_file($file['tmp_name'], $upload_path)) {
        $obc = new cTrons();
        $result = $obc->actualizarImagenUsuario($cod_user, $new_filename);
        
        echo "ok|".$new_filename;
       

    } else {
        echo "bad";
    }
    exit;
    
}


// Add this new case to handle the USDT transfer

if(isset($_POST['action']) && $_POST['action'] === 'transferUSDT') {
    $sender_cod_user = $_SESSION['cod_user'];
    $receiver_email = $_POST['mailToSend'];
    $amount = number_format((float)$_POST['amountToSend'], 2, '.', ''); // Format to 2 decimal places
    $symbol_coin = $_POST['symbol_coin'];

    $obc = new cTrons();
    
    // Get receiver's cod_user
    $receiver_data = $obc->getUserByEmail($receiver_email);
    if (!$receiver_data) {
        echo "user_not_found";
        exit;
    }
    $receiver_cod_user = $receiver_data['cod_user'];

    // Check sender's balance
    $sender_coin_data = $obc->getUserCoinData($sender_cod_user);
    if ($sender_coin_data['amount_coin'] < $amount) {
        echo "insufficient_funds";
        exit;
    }

    // Perform transfer
    $transfer_result = $obc->updateCoinAmounts($sender_cod_user, $receiver_cod_user, $amount, $symbol_coin);
    
    if ($transfer_result) {
        echo "ok";
    } else {
        echo "bad";
    }
    exit;
}

