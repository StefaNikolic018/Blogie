<?php include_once("Includes/db.php"); ?>
<?php include_once("Includes/funkcije.php"); ?>
<?php include_once("Includes/sesije.php"); ?>
<?php potvrda_login(); ?>
<?php
if (isset($_GET["id"])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM kategorije WHERE id=:id";
    $stmt = $con->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $rez = $stmt->rowCount();
    if ($rez != 1) {
        $_SESSION["ErrorMsg"] = "Pogrešan zahtev!";
        Redirect_to("kategorije.php");
    } else {
        $sql = "DELETE FROM kategorije WHERE id='$id'";
        $exec = $con->query($sql);
        $stmt = $exec->execute();
        if ($stmt) {
            $_SESSION["SuccessMsg"] = "Obrisana kategorija!";
            Redirect_to('kategorije.php');
        } else {
            $_SESSION["ErrorMsg"] = "Greska sa bazom, pokusajte ponovo!";
            Redirect_to('kategorije.php');
        }
    }
}
?>