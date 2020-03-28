
    <!-- NAVBAR -->
    <?php include("javninavbar.php"); ?>
<title>Full post </title>
    <!-- NAVBAR KRAJ -->

    <?php
$con;
$pretragaid = $_GET["id"];
$sql = "SELECT * FROM postovi";
$stmt = $con->query($sql);
$stmt->execute();
$postoji = false;
while ($niz = $stmt->fetch()) {
    if ($niz["id"] == $pretragaid) {
        $postoji = true;
        break;
    } else {
        $postoji = false;
    }
}
if (!$postoji) {
    $_SESSION["ErrorMsg"] = "Pogrešan zahtev !";
    Redirect_to("blog.php?stranica=1");
}

if (isset($_POST["posalji"])) {
    $ime = $_POST["ime"];
    $email = $_POST["email"];
    $komentar = $_POST["komentar"];
    $vreme = time();
    $vremestr = strftime("%Y-%d-%B %H:%M:%S", $vreme);

    if (empty($ime) || empty($email) || empty($komentar)) {
        $_SESSION["ErrorMsg"] = "Sva polja moraju biti popunjena !";
        Redirect_to("fullpost.php?id=" . $pretragaid);
    } elseif (strlen($komentar) > 500) {
        $_SESSION["ErrorMsg"] = "Komentar mora imati manje od 500 karaktera!";
        Redirect_to("fullpost.php?id=" . $pretragaid);
    } else {
        //Ako je sve u redu dodajemo komentar u bazu
        $con;
        $sql = "INSERT INTO komentari(vremedatum,ime,email,komentar,dozvoljenod,status,postid) VALUES(:vreme,:ime,:email,:komentar,'pending','off',:pretragaid)";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':vreme', $vremestr);
        $stmt->bindValue(':ime', $ime);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':komentar', $komentar);
        $stmt->bindValue(':pretragaid', $pretragaid);
        $exec = $stmt->execute();

        if ($exec) {
            $_SESSION["SuccessMsg"] = "Uspesno ste komentarisali ! (Vas komentar ceka potvrdu)";
            Redirect_to("fullpost.php?id=" . $pretragaid);
        } else {
            $_SESSION["ErrorMsg"] = "Greska sa bazom, pokusajte ponovo!";
            Redirect_to("fullpost.php?id=" . $pretragaid);
        }
    }
}
?>


    <div class="container mb-3 mt-3 rounded" style="  background: rgb(70,130,180);
background: radial-gradient(circle, rgba(70,130,180,0.3030345927433473) 43%, rgba(255,215,0,0.5047152650122548) 100%);  ">
        <div class="row">
            <!--MAIN AREA START-->
            <div class="col-sm-8 mt-2">
                <hr>
                <h1 class="lead " style="font-family:'Archivo Black', sans-serif;color:#373e40;"><span style="background:#b7d5d4;">&nbsp;</span> SAZNAJTE SVE ŠTO VAS INTERESUJE</h1>
                <?php
                echo ErrorMsg();
                echo SuccessMsg();
                ?>
                <?php
                $con;
                if (isset($_GET["pretrazi"])) {
                    // KADA PRETRAZUJEMO
                    $pretraga = $_GET["pretraga"];
                    $sql = "SELECT * FROM postovi 
            WHERE vremedatum LIKE :search
            OR kategorija LIKE :search
            OR naslov LIKE :search
            OR post LIKE :search ";
                    $stmt = $con->prepare($sql);
                    $stmt->bindValue(':search', '%' . $pretraga . '%');
                    $stmt->execute();
                } else {
                    // KADA NE PRETRAZUJEMO POKAZUJEMO POSTOVE
                    $pretragaid = $_GET["id"];
                    if (!isset($pretragaid)) {
                        $_SESSION["ErrorMsg"] = "Pogresan zahtev !";
                        Redirect_to("blog.php");
                    } else {
                        $sql = "SELECT * FROM postovi WHERE id='$pretragaid'";
                        $stmt = $con->query($sql);
                    }
                }
                while ($DataRows = $stmt->fetch()) {
                    $id = $DataRows["id"];
                    $vremedatum = $DataRows["vremedatum"];
                    $naslov = $DataRows["naslov"];
                    $kategorija = $DataRows["kategorija"];
                    $autor = $DataRows["autor"];
                    $slika = "Uploads/" . $DataRows["slika"];
                    $post = $DataRows["post"];
                ?>
                    <?php
                    $con;
                    $sql = "SELECT COUNT(id) AS br FROM komentari WHERE postid=$pretragaid AND status='on'";
                    $stmt = $con->query($sql);
                    $br = $stmt->fetch();
                    ?>
                    <br>
                    <div class="card" style="background: rgb(55,62,64);
background: radial-gradient(circle, rgba(55,62,64,0.8520542005864846) 21%, rgba(183,213,212,1) 100%); ">
                        <div class="card-body">
                            <h4 class="card-title" style="font-family:'Archivo Black', sans-serif"><?php echo htmlentities($naslov); ?><span style="float:right;" class="badge badge-dark text-light"><i class="fas fa-comments"></i> <?php echo $br["br"]; ?> </span></h4>
                            <hr>
                            <h5 class="text-light"><span class="btn-warning">&nbsp;</span> Napisao: <a style="font-family:'Archivo Black', sans-serif;color: steelblue;text-shadow: 0 0 0.5px #373e40, 0 0 0.5px #373e40, 0 0 0.5px #373e40, 0 0 0.5px #373e40;" href="javniprofil.php?korisnicko=<?php echo $autor; ?>"><?php echo $autor; ?></a> <span style="float:right" class="text-muted"><?php echo htmlentities($vremedatum); ?> </span> </h5>
                            <hr>
                            <div class="text-center">
                                <img style="max-height:450px; border:4px solid #373e40;box-shadow:0 0 0,0 0 5px black,0 0 0,0 0 10px black;" src=" <?php echo htmlentities($slika); ?>" alt="Slika" class="img-fluid card-top">
                                <h4 class="text-light"><a style="color: gold; font-family:'Archivo Black', sans-serif;text-shadow: 0 0 0.5px #373e40, 0 0 0.5px #373e40, 0 0 0.5px #373e40, 0 0 0.5px #373e40;" href="blog.php?kategorija=<?php echo $kategorija; ?>"><?php echo $kategorija; ?></a></h4>
                            </div>
                            <hr>
                            <p class="card px-2 py-2 rounded" style="color:#383F41; background:rgba(164,190,190,90%);">
                               <b> <?php echo htmlentities($post); ?></b>
                            </p>
                            <hr>
                        </div>
                    </div>
                    <br>
                <?php } ?>
                <!-- KOMENTARI START -->

                <!-- FETCH KOMENTARA -->
                <span class="FieldInfo" style="color: steelblue"><i class="fas fa-comment"></i> Komentari (<?php echo $br["br"]; ?>) :</span>
                <hr>
                <?php
                $con;
                $sql = "SELECT * FROM komentari WHERE postid='$pretragaid' AND status='on'";
                $stmt = $con->query($sql);
                while ($DataRows = $stmt->fetch()) {
                    $ime = $DataRows["ime"];
                    $vreme = $DataRows["vremedatum"];
                    $komentar = $DataRows["komentar"];
                ?>
                    <div>
                        <div class="media CommentBlock rounded bg-light" style="color:steelblue">
                            <img class="d-block img-fluid align-self-start ml-2 mt-2" style="max-width:30px;max-height:30px;" src="Images/user.png" alt="user">
                            <div class="media-body ml-2 mr-4">
                                <h3 class="lead mt-2">
                                    <span style="font-family: 'Archivo Black', sans-serif;">
                                        <?php echo $ime; ?>
                                        </span>
                                    <span style="float:right" class="small text-muted"><?php echo $vreme ?></span>
                                </h3>
                                <hr>
                                <div class="card rounded py-2 px-2 mb-3"
                                style="background:rgba(164,190,190,50%);">
                                <p><?php echo $komentar ?></p>
                                                 
                            </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                <?php } ?>
                <!-- FETCH KOMENTARA KRAJ -->
                <div>

                    <form action="fullpost.php?id=<?php echo $pretragaid; ?>" method="post">
                        <div class="card mb-3 CommentBlock bg-light">
                            <div class="card-header">
                                <h5 class="FieldInfo" style="color:steelblue">
                                    Podelite vaše mišljenje
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"style="color:steelblue;"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" name="ime" placeholder="Ime">
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-envelope" style="color:steelblue;"></i>
                                            </span>
                                        </div>
                                        <input type="email" class="form-control" name="email" placeholder="Email">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <textarea name="komentar" id="" cols="30" rows="5" class="form-control" placeholder="Unesite komentar"></textarea>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn" style="background:steelblue;color:#b7d5d4;" name="posalji">Pošalji</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

                <!-- KOMENTARI KRAJ -->
            </div>
            <!--MAIN AREA KRAJ-->

            <!--SIDE AREA START-->
            <?php include("sidearea.php"); ?>
            <!--SIDE AREA KRAJ-->

        </div>
    </div>


    <!-- FOOTER -->
    <?php include("futer.php"); ?>
    <!-- FOOTER KRAJ -->

</body>

</html>