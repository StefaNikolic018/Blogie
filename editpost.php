<?php require_once("Includes/db.php"); ?>
<?php require_once("Includes/funkcije.php"); ?>
<?php require_once("Includes/sesije.php"); ?>
<?php
potvrda_login();
?>
<?php
$idposta = $_GET['id'];
$sql = "SELECT * FROM postovi WHERE id=:id";
$stmt = $con->prepare($sql);
$stmt->bindValue(':id', $idposta);
$stmt->execute();
$rez = $stmt->rowCount();
if ($rez != 1) {
    $_SESSION["ErrorMsg"] = "Pogrešan zahtev!";
    Redirect_to("postoviSvi.php");
} elseif (isset($_POST["posalji"])) {
    $idposta = $_GET['id'];
    $naslov = $_POST["naslov"];
    $kategorija = $_POST["kategorija"];
    $slika = $_FILES["slika"]["name"];
    $lokacija = "Uploads/" . basename($slika);
    $post = $_POST['post'];
    $admin = "Stefan";
    $vreme = time();
    $vremestr = strftime("%Y-%d-%B %H:%M:%S", $vreme);

    if (empty($naslov)) {
        $_SESSION["ErrorMsg"] = "Morate popuniti sva polja!";
        Redirect_to("editpost.php");
    } elseif (strlen($naslov) < 4) {
        $_SESSION["ErrorMsg"] = "Naslov treba biti duzi od 3 karaktera!";
        Redirect_to("editpost.php");
    } elseif (strlen($post) > 999) {
        $_SESSION["ErrorMsg"] = "Post ne sme biti duzi od 999 karaktera!";
        Redirect_to("editpost.php");
    } else {
        //Query za UPDATE Postova u Bazu ako je sve u redu
        $con;
        if (!empty($slika)) {
            $sql = "UPDATE postovi SET vremedatum=:vremedatum, naslov=:naslov, kategorija=:kategorija, autor=:autor, slika=:slika, post=:post WHERE id=:idposta";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':vremedatum', $vremestr);
            $stmt->bindValue(':naslov', $naslov);
            $stmt->bindValue(':kategorija', $kategorija);
            $stmt->bindValue(':autor', $admin);
            $stmt->bindValue(':slika', $slika);
            $stmt->bindValue(':post', $post);
            $stmt->bindValue(':idposta', $idposta);
            $exec = $stmt->execute();
            move_uploaded_file($_FILES["slika"]["tmp_name"], $lokacija);
            if ($exec) {
                $_SESSION["SuccessMsg"] = "Uspesno ste izmenili post ! ";
                Redirect_to("fullpost.php?id=" . $idposta);
            } else {
                $_SESSION["ErrorMsg"] = "Problem sa bazom, pokusajte ponovo!";
                Redirect_to("fullpost.php?id=" . $idposta);
            }
        } else {
            $sql = "UPDATE postovi SET vremedatum=:vremedatum, naslov=:naslov, kategorija=:kategorija, autor=:autor, post=:post WHERE id=:idposta";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':vremedatum', $vremestr);
            $stmt->bindValue(':naslov', $naslov);
            $stmt->bindValue(':kategorija', $kategorija);
            $stmt->bindValue(':autor', $admin);
            $stmt->bindValue(':post', $post);
            $stmt->bindValue(':idposta', $idposta);
            $exec = $stmt->execute();
            move_uploaded_file($_FILES["slika"]["tmp_name"], $lokacija);
            if ($exec) {
                $_SESSION["SuccessMsg"] = "Uspesno ste izmenili post ! ";
                Redirect_to("fullpost.php?id=" . $idposta);
            } else {
                $_SESSION["ErrorMsg"] = "Problem sa bazom, pokusajte ponovo!";
                Redirect_to("fullpost.php?id=" . $idposta);
            }
        }
    }
}
?>

    <!--NAVBAR-->
<?php include("navbarprivatni.php");?>
<title>Izmena posta </title>
    <!--NAVBAR KRAJ-->

    <!--HEADER-->
    <header class="bg-dark text-white py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center" style="font-family:'Archivo Black',sans-serif;"><i class="fas fa-edit" style="color:darkgray"></i> Izmena posta</h1>
                </div>
            </div>
        </div>
    </header>
    <!--HEADER KRAJ-->

    <!--MAIN -->
    <section class="container py-2 mb-4 mt-2">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <?php
                echo ErrorMsg();
                echo SuccessMsg();
                //FETCHING informacija vezanih za konkretni post
                $con;
                $idposta = $_GET['id'];
                $sql1 = "SELECT * FROM postovi WHERE id='$idposta'";
                $stmt = $con->query($sql1);
                while ($DataRows = $stmt->fetch()) {
                    $naslov1 = $DataRows["naslov"];
                    $kategorija1 = $DataRows["kategorija"];
                    $post1 = $DataRows["post"];
                    $slika1 = $DataRows["slika"];
                }
                ?>
                <form action="editpost.php?id=<?php echo $idposta ?>" method="post" enctype="multipart/form-data">
                    <div class="card bg-secondary text-white">
                        <div class="card-body bg-dark">
                            <div class="form-group">
                                <label for="title"><span class="FieldInfo">Naslov:</span></label>
                                <input type="text" name="naslov" id="naslov" class="form-control" placeholder="Dodajte naslov kategorije" value="<?php echo $naslov1; ?>">
                            </div>
                            <div class="form-group">
                                <label for="naslovkategorije"><span class="FieldInfo">Izaberi kategoriju:</span></label>
                                <select name="kategorija" id="naslovkategorije" class="form-control">
                                    <?php
                                    $con;
                                    $sql = "SELECT id,naslov FROM kategorije";
                                    $stmt = $con->query($sql);
                                    while ($DataRows = $stmt->fetch()) {
                                        $id = $DataRows["id"];
                                        $naslov = $DataRows["naslov"];
                                    ?>
                                        <option <?php echo ($naslov == $kategorija1) ? 'selected="selected"' : ''; ?>><?php echo $naslov ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group mb-1">
                                <label for="imageSelected"><span class="FieldInfo">Izabrana slika:</span></label>
                                <img height="250px" width="250px" style="border:3px solid black;" src="Uploads/<?php echo $slika1; ?>" alt="Izabrana slika">
                            </div>
                            <div class="form-group mb-1">
                                <label for="imageSelect"><span class="FieldInfo">Slika:</span></label>
                                <div class="custom-file">
                                    <input type="File" class="custom-file-input" name="slika" id="imageSelect">
                                    <label for="imageSelect" class="custom-file-label">Dodajte sliku</label>
                                </div>
                                <div class="form-group">
                                    <label for="post"><span class="FieldInfo">Post:</span></label>
                                    <textarea name="post" id="post" cols="30" rows="5" placeholder="Unesite text posta" class="form-control"><?php echo $post1; ?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <a href="dashboard.php" class="btn btn-block mt-2 mb-2" style="background-color: gray"><i class="fas fa-arrow-left"></i>Dashboard</a>
                                </div>
                                <div class="col-lg-6">
                                    <button type="submit" name="posalji" class="btn btn-success btn-block mt-2 mb-2"><i class="fas fa-check"></i>Objavi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </section>
    <!-- MAIN KRAJ -->

    <!--FOOTER-->

<?php include("futerprivatni.php"); ?>

    <!--FOOTER KRAJ-->
    <script>
        $('#year').text(new Date().getFullYear());
    </script>
</body>

</html>