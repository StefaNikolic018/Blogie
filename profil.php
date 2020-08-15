<?php require_once("Includes/db.php"); ?>
<?php require_once("Includes/funkcije.php"); ?>
<?php require_once("Includes/sesije.php");?>
<?php
potvrda_login();
?>
<?php 
//HVATAM PODATKE ADMINA
$con;
$id=$_SESSION["korisnickiid"];
$sql="SELECT * FROM admins WHERE id='$id'";
$stmt=$con->query($sql);
$admin=$stmt->fetch();
//ZAVRSAVAM HVATANJE PODATAKA ADMINA

//PITAM DA LI JE PRITISNUTO DUGME ZA IZMENU PODATAKA ADMINA
if(isset($_POST["posalji"])){
    $ime=$_POST["ime"];
    $zvanje=$_POST["zvanje"];
    $slika=$_FILES["slika"]["name"];
    $lokacija="Uploads/".basename($slika);
    $bio=$_POST['bio'];
    $vreme=time();
    $vremestr=strftime("%Y-%d-%B %H:%M:%S",$vreme);
    //PROVERAVAM DA LI JE IME PRAZNO
    if(empty($ime) || empty($bio) || empty($zvanje)){
        $_SESSION["ErrorMsg"] = "Morate popuniti sva polja!";
        Redirect_to("profil.php");
    //PROVERAVAM DA LI ZVANJE IMA MANJE OD 20 KARAKTERA
    }elseif(strlen($zvanje)>20){
        $_SESSION["ErrorMsg"]="Zvanje ne sme biti duze od 20 karaktera!";
        Redirect_to("profil.php");
    //PROVERAVAM DA LI JE BIOGRAFIJA DUZA OD 500 KARAKTERA
    }elseif(strlen($bio)>499){
        $_SESSION["ErrorMsg"]="Biografija ne sme biti duza od 499 karaktera!";
        Redirect_to("profil.php");
    }
    else{
        //Query za UPDATE ADMINA ako je sve u redu
        $con;
        //PROVERAVAM DA LI JE UBACENA SLIKA, AKO JESTE SLEDI UPDATE ADMINS TABELE
        if(!empty($slika)){
            $sql="UPDATE admins SET ime=:ime, zvanje=:zvanje, slika=:slika, bio=:bio WHERE id=:id";
            $stmt=$con->prepare($sql);
            $stmt->bindValue(':ime',$ime);
            $stmt->bindValue(':zvanje',$zvanje);
            $stmt->bindValue(':slika',$slika);
            $stmt->bindValue(':bio',$bio);   
            $stmt->bindValue(':id',$admin["id"]);
            $exec=$stmt->execute();
            move_uploaded_file($_FILES["slika"]["tmp_name"],$lokacija);
            if($exec){
                $_SESSION["SuccessMsg"]="Uspesno ste izmenili profil ! ";
                Redirect_to("profil.php");
            }else{
                $_SESSION["ErrorMsg"]="Problem sa bazom, pokusajte ponovo!";
                Redirect_to("profil.php");
            }
        //AKO SLIKA NIJE UBACENA, ONDA IZOSTAVLJAMO ISTU KAKO BI BILA DEFAULT SLIKA               
        } else {
            $sql="UPDATE admins SET ime=:ime, zvanje=:zvanje, bio=:bio WHERE id=:id";
            $stmt=$con->prepare($sql);
            $stmt->bindValue(':ime',$ime);
            $stmt->bindValue(':zvanje',$zvanje);
            $stmt->bindValue(':bio',$bio);   
            $stmt->bindValue(':id',$admin["id"]);
            $exec=$stmt->execute();
            move_uploaded_file($_FILES["slika"]["tmp_name"],$lokacija);
            if($exec){
                $_SESSION["SuccessMsg"]="Uspesno ste izmenili profil ! ";
                Redirect_to("profil.php");
            }else{
                $_SESSION["ErrorMsg"]="Problem sa bazom, pokusajte ponovo!";
                Redirect_to("profil.php");
            }
    }
}

}
?>
<!-- NAVBAR -->
<?php include("navbarprivatni.php"); ?>
<title><?php echo $admin["korisnickoime"];?></title>
    <!--NAVBAR KRAJ-->

    <!--HEADER-->
    <header class="bg-dark py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="color:#b7d5d4">
                    <h1 class="text-center" style="font-family:'Archivo Black',sans-serif;" ><i class="fas fa-user-circle" style="color:steelblue"></i> Profil</h1>
                </div>
            </div>
        </div>
    </header>
    <!--HEADER KRAJ-->

    <!--MAIN -->
    <section class="container py-2 mb-4 ">
    <div class="row">
    <div class="col-sm-4"></div>
        <div class="col-sm-4">    <?php 
            echo ErrorMsg();
            echo SuccessMsg();      
            ?></div>
        <div class="col-sm-4"></div>
    </div>
    <div class="row">
    <div class="col-md-3">
        <div class="card mb-3 mt-2" style="box-shadow:0 0 0,0 0 5px black,0 0 0,0 0 10px black;">
            <div class="card-header bg-secondary text-light">
                <h3 class="text-center" style="font-family:'Archivo Black',sans-serif;color:gold;"> <?php echo $admin["korisnickoime"]; ?> </h3>
                <hr>
                <small><p class="text-center">Dodat: <?php echo $admin["vremedatum"];?></p></small>
            </div>
            <div class="card-body bg-dark text-light">
                <img src="Uploads/<?php echo $admin["slika"];?>" alt="slika" class="img-fluid d-block mb-3 rounded" style="border:2px solid #444C4E">
                <small class="text-muted"><?php echo $admin["zvanje"];?></small>
                <hr>
                <div class=" px-2"> 
                    <?php echo $admin["bio"]; ?>
                    <hr>
                </div>
            </div>
        </div>
    </div>
        <div class="col-md-9">
            <form action="profil.php" method="post" enctype="multipart/form-data">
                <div class="card bg-dark text-white text-center mt-2" style="box-shadow:0 0 0,0 0 5px black,0 0 0,0 0 10px black;">
                    <div class="card-header bg-secondary text-light">
                        <h4 style="font-family:'Archivo Black',sans-serif;">Izmeni profil</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" name="ime" class="form-control" value="<?php echo $admin['korisnickoime']?>">
                        </div>
                        <div class="form-group">
                            <input type="text" name="zvanje" placeholder="Vaše profesionalno zvanje" class="form-control" >
                            <small class="text-muted">Dodajte profesionalno zvanje kao "Inžinjer" ili "Arhitekta".
                            <span class="text-danger">Koristite samo slova (maksimalno 20 karaktera) !</span>
                            </small>
                            
                        </div>
                        <div class="form-group">
                            <textarea name="bio" cols="30" rows="4" placeholder="Unesite kratku biografiju" class="form-control"></textarea>
                        </div>
                        <div class="form-group mb-1">
                            <div class="custom-file">
                            <input type="File" class="custom-file-input" name="slika" id="imageSelect">
                            <label for="imageSelect" class="custom-file-label">Dodajte sliku</label>    
                        </div>
                    </div>

                        

                        <div class="row">
            <div class="col-lg-6">
                <a href="dashboard.php" class="btn btn-block mt-2 mb-2" style="background-color:gray"><i class="fas fa-arrow-left"></i>Dashboard</a>
            </div>
            <div class="col-lg-6">
            <button type="submit" style="background-color: #b7d5d4" name="posalji" class="btn btn-block mt-2 mb-2"><i class="fas fa-check"></i>Objavi</button>
            </div>
        </div>
                    </div>
                </div>
            </form>
            <hr>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h3 class="text-center" style="font-family:'Archivo Black',sans-serif;">Postovi admina:</h3>
        <table class="table table-striped table-hover">
        <thead class="thead-dark">     
        <tr>
                <th>#</th>
                <th>Naslov</th>
                <th>Kategorija</th>
                <th>Datum</th>
                <th>Komentari</th>
            </tr>
            </thead>
            <br>
        <tbody>
            <?php 
            $con;
            $autor=$_SESSION["korisnicko"];
            $sql="SELECT * FROM postovi WHERE autor='$autor' ORDER BY id desc";
            // $sql="SET @p0='".$autor."'; CALL p_listanjePostova(@p0)";

            $br=0;
            $stmt=$con->query($sql);
            while($DataRows = $stmt->fetch()){
                $id         =$DataRows["id"];
                $datumvreme =$DataRows["vremedatum"];
                $naslov     =$DataRows["naslov"];
                $kategorija =$DataRows["kategorija"];
                $admin      =$DataRows["autor"];
                $slika      =$DataRows["slika"];
                $komentar   =$DataRows["post"];
                $br++;
            ?>
            <tr>
                <td><?php echo $br; ?></td>
                <td style="max-width: 30px">
                    <img src="Uploads/<?php echo $slika; ?>" alt="Slika" style="max-width: 100%;border:1px solid black;" height="50px">
                    <br>
                    <?php 
                        if (strlen($naslov)>20){
                            $naslov=substr($naslov,0,18)."..";
                            echo $naslov;
                        }
                        else{
                            echo $naslov;
                        } ?>
                </td>
                <td style="max-width: 30px">
                <?php
                        if (strlen($kategorija)>8){
                            $kategorija=substr($kategorija,0,8)."..";
                            echo $kategorija;
                        }
                        else{
                            echo $kategorija;
                        } ?>
                 </td>
                <td style="max-width: 30px">
                    <?php 
                        if (strlen($datumvreme)>11){
                            $datumvreme=substr($datumvreme,0,11)."..";
                            echo $datumvreme;
                        }
                        else{
                            echo $datumvreme;
                        } ?>                    
                </td>
                <th style="max-width: 30px">
                       &nbsp; &nbsp;<span class="badge badge-success"><?php kom('on',$id); ?></span>
                       &nbsp; <span class="badge badge-danger"><?php kom('off',$id); ?></span></th>
            </tr>
            <?php
                    } ?>
            </tbody>
        </table>
    </div>
        </div>
        
    </div>
    
    </section>
    
    <!-- MAIN KRAJ -->

    <!--FOOTER-->
<?php include("futerprivatni.php"); ?>
<!--FOOTER KRAJ-->
<script>$('#year').text(new Date().getFullYear());</script>
</body>
</html>