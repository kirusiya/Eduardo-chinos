<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

include('./conex/conex.php');
include('./clases/tron.php');

$website = 'https://tronvault.io';

if(
	isset($_SESSION['cod_user']) and $_SESSION['cod_user']!="" &&
	isset($_SESSION['nom_user']) and $_SESSION['nom_user']!=""

){
	//good
	$cod_user = $_SESSION['cod_user'];
	$nom_user = $_SESSION['nom_user'];
	
}else{
	echo "<script>window.location.href = '".$website."/login/'</script>";
	
}

?>

