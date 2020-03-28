<?php require_once("Includes/db.php"); ?>
<?php require_once("Includes/funkcije.php"); ?>
<?php require_once("Includes/sesije.php");?>
<?php 
$_SESSION["korisnickiid"]=null;
$_SESSION["korisnicko"]=null;
$_SESSION["ime"]=null;
$_SESSION["url"]=null;
session_destroy();
Redirect_to("login.php");


?>