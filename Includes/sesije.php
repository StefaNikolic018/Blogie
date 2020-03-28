<?php 
session_start();

function ErrorMsg(){
    if(isset($_SESSION['ErrorMsg'])){
        $izlaz='<div class="alert alert-danger">';
        $izlaz.=htmlentities($_SESSION["ErrorMsg"])."</div>";
        $_SESSION["ErrorMsg"]=null;
        return $izlaz;
    }
}

function SuccessMsg(){
    if(isset($_SESSION['SuccessMsg'])){
        $izlaz='<div class="alert alert-success">';
        $izlaz.=htmlentities($_SESSION["SuccessMsg"])."</div>";
        $_SESSION["SuccessMsg"]=null;
        return $izlaz;
    }
}
?>