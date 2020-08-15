<?php include_once("Includes/db.php"); ?>
<?php include_once("Includes/funkcije.php"); ?>
<?php include_once("Includes/sesije.php"); ?>
<?php potvrda_login(); ?>
<?php
$con;
if (isset($_GET["id"])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM komentari WHERE id=:id";
    $stmt = $con->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $rez = $stmt->rowCount();
    if ($rez != 1) {
        $_SESSION["ErrorMsg"] = "Pogrešan zahtev!";
        Redirect_to("komentari.php");
    } else {
        $sql = "SET @p0=".$id."; CALL p_brisanjeKomentara(@p0);";
        $stmt = $con->query($sql);
        $exec = $stmt->execute();
        if ($exec) {
            $_SESSION["SuccessMsg"] = "Obrisan komentar!";
            Redirect_to('komentari.php');
        } else {
            $_SESSION["ErrorMsg"] = "Greska sa bazom, pokusajte ponovo!";
            Redirect_to('komentari.php');
        }
    }
}
?>