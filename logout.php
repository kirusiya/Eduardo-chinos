<?php

session_start();

unset($_SESSION["cod_user"]);
unset($_SESSION["nom_user"]);

session_destroy();
$website = "https://tronvault.io";
echo "<script>window.location.href = '".$website."/login/';</script>";

?>

