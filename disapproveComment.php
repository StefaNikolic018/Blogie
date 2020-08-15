<?php include_once("Includes/db.php"); ?>
<?php include_once("Includes/funkcije.php"); ?>
<?php include_once("Includes/sesije.php"); ?>
<?php potvrda_login(); ?>
<?php
if (isset($_GET["id"])) {
    $con;
    $id = $_GET["id"];
    $sql = "SELECT * FROM komentari WHERE id=:id";
    $stmt = $con->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $rez = $stmt->rowCount();
    if ($rez != 1) {
        $_SESSION["ErrorMsg"] = "Pogrešan zahtev!";
        Redirect_to("komentari.php");
    } else {

        $admin = $_SESSION["korisnicko"];
        $sql = "SET @p0='off', @p1='".$admin."', @p2=".$id.";CALL p_odobravanjeKomentara(@p0,@p1,@p2);";
        $exec = $con->query($sql);
        if ($exec) {
            $_SESSION["SuccessMsg"] = "Neodobren komentar!";
            Redirect_to('komentari.php');
        } else {
            $_SESSION["ErrorMsg"] = "Greska sa bazom, pokusajte ponovo!";
            Redirect_to('komentari.php');
        }
    }
}
?>