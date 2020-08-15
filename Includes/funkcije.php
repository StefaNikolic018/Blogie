<?php 

function Redirect_to($lokacija) {
    header("Location:".$lokacija);
    exit;
}

function Korisnicko_postoji($korisnicko){
    require_once("Includes/db.php");
    global $con;
    $sql="SELECT korisnickoime FROM admins WHERE korisnickoime=:korisnicko";
    $stmt=$con->prepare($sql);
    $stmt->bindValue(':korisnicko',$korisnicko);
    $stmt->execute();
    $res=$stmt->rowcount();
    if($res==1){
        return false;
    }
    else{
        return true;
    }
}
function potvrda_login(){
    if(isset($_SESSION["korisnicko"])){        
            return true;
    }
    else {
        $_SESSION["url"]=$_SERVER["PHP_SELF"];
        $_SESSION["ErrorMsg"]="Morate biti ulogovani da bi pristupili resursima ove stranice!";
        Redirect_to("login.php");
    }
}

function show($izbor){
    global $con;
    $i=$izbor;
    $sql="SELECT COUNT(*) FROM $i";
    $stmt=$con->query($sql);
    $total=$stmt->fetch();
    echo array_shift($total);
}

function kom($izbor,$id){
    global $con;
    $id=$id;
    $i=$izbor;
    if($i=='off'){
        $sql="SELECT COUNT(*) FROM komentari WHERE status='$i' AND postid=$id";
    }
    elseif($i=='on'){
        $sql="SELECT COUNT(*) FROM komentari WHERE status='$i' AND postid=$id";
    }
    
    $stmt=$con->query($sql);
    $total=$stmt->fetch();
    echo array_shift($total);
}
?>