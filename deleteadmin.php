<?php include_once("Includes/db.php"); ?>
<?php include_once("Includes/funkcije.php"); ?>
<?php include_once("Includes/sesije.php"); ?>
<?php potvrda_login(); ?>
<?php
if (isset($_GET["id"])) {

    $con;
    $id = $_GET["id"];
    $sql = "SELECT * FROM admins WHERE id=:id";
    $stmt = $con->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    $rez = $stmt->rowCount();
    if ($rez != 1) {
        $_SESSION["ErrorMsg"] = "Pogrešan zahtev!";
        Redirect_to("admins.php");
    } else {
        $id = $_GET["id"];
        $sql = "DELETE FROM admins WHERE id='$id'";
        $exec = $con->query($sql);
        $stmt = $exec->execute();
        if ($stmt) {
            $_SESSION["SuccessMsg"] = "Obrisan admin!";
            Redirect_to('admins.php');
        } else {
            $_SESSION["ErrorMsg"] = "Greska sa bazom, pokusajte ponovo!";
            Redirect_to('admins.php');
        }
    }
}
?>