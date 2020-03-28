<?php require_once("Includes/db.php"); ?>
<?php require_once("Includes/funkcije.php"); ?>
<?php require_once("Includes/sesije.php"); ?>
<?php
potvrda_login();
?>
<?php
$con;
$id = $_GET["id"];
$sql = "SELECT * FROM postovi WHERE id=:id";
$stmt = $con->prepare($sql);
$stmt->bindValue(':id', $id);
$stmt->execute();
$rez = $stmt->rowCount();
if ($rez != 1) {
    $_SESSION["ErrorMsg"] = "Pogrešan zahtev!";
    Redirect_to("postoviSvi.php");
} else {
    //FETCH imena slike koju zelimo da obrisemo iz foldera
    $sql = "SELECT slika FROM postovi WHERE id='$id'";
    $stmt = $con->query($sql);
    while ($DataRows = $stmt->fetch()) {
        $slikazabrisanje = $DataRows["slika"];
    }
    $mestoslike = "Uploads/" . $slikazabrisanje;
    unlink($mestoslike);
    //Brisanje posta iz baze podataka
    $sql = "DELETE FROM postovi WHERE id='$id'";
    $stmt = $con->query($sql);
    $exec = $stmt->execute();
    if ($exec) {
        $_SESSION["SuccessMsg"] = "Uspesno ste obrisali post!";
        Redirect_to("postoviSvi.php");
    } else {
        $_SESSION["ErrorMsg"] = "Greska sa izvrsavanjem, pokusajte ponovo!";
        Redirect_to("postoviSvi.php");
    }
}

?>