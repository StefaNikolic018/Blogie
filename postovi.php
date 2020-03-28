<?php require_once("Includes/db.php"); ?>
<?php require_once("Includes/funkcije.php"); ?>
<?php require_once("Includes/sesije.php");?>
<?php
potvrda_login();
?>
<?php 
if(isset($_POST["posalji"])){
    $naslov=$_POST["naslov"];
    $kategorija=$_POST["kategorija"];
    $slika=$_FILES["slika"]["name"];
    $lokacija="Uploads/".basename($slika);
    $post=$_POST['post'];
    $admin=$_SESSION["korisnicko"];
    $vreme=time();
    $vremestr=strftime("%Y-%d-%B %H:%M:%S",$vreme);
    
    if(empty($naslov)){
        $_SESSION["ErrorMsg"] = "Morate popuniti sva polja!";
        Redirect_to("postovi.php");
    }elseif(strlen($naslov)<4){
        $_SESSION["ErrorMsg"]="Naslov treba biti duzi od 3 karaktera!";
        Redirect_to("postovi.php");
    }elseif(strlen($post)>999){
        $_SESSION["ErrorMsg"]="Post ne sme biti duzi od 999 karaktera!";
        Redirect_to("postovi.php");
    }
    else{
        //Query za INSERT Postova u Bazu ako je sve u redu
        $con;
        $sql="INSERT INTO postovi(vremedatum,naslov,kategorija,autor,slika,post) VALUES(:vremedatum,:naslov,:kategorija,:autor,:slika,:post)";
        $stmt=$con->prepare($sql);
        $stmt->bindValue(':vremedatum',$vremestr);
        $stmt->bindValue(':naslov',$naslov);
        $stmt->bindValue(':kategorija',$kategorija);
        $stmt->bindValue(':autor',$admin);   
        $stmt->bindValue(':slika',$slika);
        $stmt->bindValue(':post',$post);
        $exec=$stmt->execute();
        move_uploaded_file($_FILES["slika"]["tmp_name"],$lokacija);
        if($exec){
            $_SESSION["SuccessMsg"]="Uspesno dodat post '".$naslov."' (Ceka potvrdu admina)";
            Redirect_to("postoviSvi.php");
        }else{
            $_SESSION["ErrorMsg"]="Problem sa bazom, pokusajte ponovo!";
            Redirect_to("postovi.php");
        }
    }

}
?>
<!-- NAVBAR -->
<?php include("navbarprivatni.php"); ?>
<title>Dodaj post</title>
    <!--NAVBAR KRAJ-->

    <!--HEADER-->
    <header class="bg-dark text-white py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center" style="font-family:'Archivo Black', sans-serif;color:#b7d5d4"><i class="fas fa-edit" style="color:darkgray"></i> Dodaj post</h2>
                </div>
            </div>
        </div>
    </header>
    <!--HEADER KRAJ-->

    <!--MAIN -->
    <section class="container py-2 mb-4">
    <div class="row">
    <div class="col-sm-4"></div>
        <div class="col-sm-4">    <?php 
            echo ErrorMsg();
            echo SuccessMsg();      
            ?></div>
        <div class="col-sm-4"></div>
        <div class="col-lg-12">
            <form action="postovi.php" method="post" enctype="multipart/form-data">
                <div class="card bg-secondary text-white">
                    <div class="card-body bg-dark">
                        <div class="form-group">
                            <label for="title"><span class="FieldInfo">Naslov:</span></label>
                            <input type="text" name="naslov" id="naslov" class="form-control" placeholder="Dodajte naslov kategorije">
                        </div>
                        <div class="form-group">
                            <label for="naslovkategorije"><span class="FieldInfo">Izaberi kategoriju:</span></label>
                            <select name="kategorija" id="naslovkategorije" class="form-control">
                                <?php 
                                $con;
                                $sql="SELECT id,naslov FROM kategorije";
                                $stmt=$con->query($sql);
                                while($DataRows=$stmt->fetch()){
                                    $id=$DataRows["id"];
                                    $naslov=$DataRows["naslov"];
                                ?>
                                <option><?php echo $naslov?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group mb-1">
                        <label for="imageSelect"><span class="FieldInfo">Slika:</span></label>
                            <div class="custom-file">
                            <input type="File" class="custom-file-input" name="slika" id="imageSelect">
                            <label for="imageSelect" class="custom-file-label">Dodajte sliku</label>    
                        </div>
                        <div class="form-group">
                            <label for="post"><span class="FieldInfo">Post:</span></label>
                            <textarea name="post" id="post" cols="30" rows="3" placeholder="Unesite text posta" class="form-control"></textarea>
                        </div>
                        </div>
                        <div class="row">
            <div class="col-lg-6">
                <a href="dashboard.php" class="btn btn-block mt-2 mb-2" style="background-color:gray"><i class="fas fa-arrow-left"></i>Dashboard</a>
            </div>
            <div class="col-lg-6">
            <button type="submit" name="posalji" class="btn btn-block mt-2 mb-2" style="background:#b7d5d4"><i class="fas fa-check"></i>Objavi</button>
            </div>
        </div>
                    </div>
                </div>
            </form>
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