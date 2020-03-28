<?php require_once("Includes/db.php"); ?>
<?php require_once("Includes/funkcije.php"); ?>
<?php require_once("Includes/sesije.php");?>
<?php
potvrda_login();
?>
<?php 
if(isset($_POST['posalji'])){
    $korisnickoime=$_POST['korisnickoime'];
    $ime=$_POST["ime"];
    $lozinka=$_POST["lozinka"];
    $potvrda=$_POST["potvrda"];
    $admin=$_SESSION["korisnicko"];
    $vreme=time();
    $vremestr=strftime("%Y-%d-%B %H:%M:%S",$vreme);
    
    if(empty($korisnickoime)||empty($lozinka)||empty($potvrda)){
        $_SESSION["ErrorMsg"] = "Morate popuniti sva polja!";
        Redirect_to("admins.php");
    }elseif(strlen($lozinka)<4){
        $_SESSION["ErrorMsg"]="Lozinka treba biti duza od 3 karaktera!";
        Redirect_to("admins.php");
    }elseif($potvrda!=$lozinka){
        $_SESSION["ErrorMsg"]="Lozinka i potvrda iste treba da se poklapaju!";
        Redirect_to("admins.php");
    }
    elseif(!Korisnicko_postoji($korisnickoime)){
        $_SESSION["ErrorMsg"]="Korisnicko ime postoji, izaberite drugo!";
        Redirect_to("admins.php");
    }
    else{
        //Unos admina u tabelu baze ako je sve u redu
        $con;
        $sql="INSERT INTO admins(vremedatum,korisnickoime,lozinka,ime,dodao) VALUES(:vremedatum,:korisnickoime,:lozinka,:ime,:dodao)";
        $stmt=$con->prepare($sql);
        $stmt->bindValue(':korisnickoime',$korisnickoime);
        $stmt->bindValue(':dodao',$admin);
        $stmt->bindValue(':lozinka',password_hash($_POST["lozinka"],PASSWORD_BCRYPT));
        $stmt->bindValue(':vremedatum',$vremestr);
        if(!empty($ime)){
            $stmt->bindValue(':ime',$ime);
        } else {
            $stmt->bindValue(':ime','anonimno');
        }
        $exec=$stmt->execute();
        if($exec){
            $_SESSION["SuccessMsg"]="Admin {$ime} je uspesno dodat !";
            Redirect_to("admins.php");
        }else{
            $_SESSION["ErrorMsg"]="Problem sa bazom, pokusajte ponovo!";
            Redirect_to("admins.php");
        }
    }

}
?>
<!-- NAVBAR  -->

<?php include("navbarprivatni.php"); ?>
<title>Admin menadžer </title>
<!-- NAVBAR KRAJ -->

    <!--HEADER-->
    <header class="bg-dark text-white py-2">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="text-center" style="font-family:'Archivo Black', sans-serif;color:#b7d5d4"><i class="fas fa-user-plus" style="color:steelblue"></i> Admin menadžer</h1>
                </div>
            </div>
        </div>
    </header>
    <!--HEADER KRAJ-->

    <!--MAIN -->
    <section class="container py-2 mb-4">
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <?php 
            echo ErrorMsg();
            echo SuccessMsg();      
            ?>
            <form action="admins.php" method="post" class="">
                <div class="card bg-secondary text-white mt-2" style="box-shadow:0 0 0,0 0 5px black,0 0 0,0 0 10px black;">
                    <div class="card-header">
                        <h3 class="text-center" style="font-family:'Archivo Black',sans-serif;">Dodaj novog admina</h3>
                    </div>
                    <div class="card-body bg-dark">
                        <div class="form-group">
                            <label for="username"><span class="FieldInfo">Korisničko ime:</span> </label>
                            <input type="text" name="korisnickoime" id="korisnickoime" class="form-control" placeholder="Unesite korisnicko ime">
                        </div>
                        <div class="form-group">
                            <label for="name"><span class="FieldInfo">Ime:</span> </label>
                            <input type="text" name="ime" id="ime" class="form-control" placeholder="Unesite ime">
                            <small class="text-muted">*Opciono</small>
                        </div>
                        <div class="form-group">
                            <label for="password"><span class="FieldInfo">Lozinka:</span> </label>
                            <input type="password" maxlength="255" name="lozinka" id="lozinka" class="form-control" placeholder="Unesite lozinku">
                        </div>
                        <div class="form-group">
                            <label for="confirmpassword"><span class="FieldInfo">Potvrda lozinke:</span> </label>
                            <input type="password" maxlength="255" name="potvrda" id="potvrda" class="form-control" placeholder="Potvrdite lozinku">
                        </div>
                        <div class="row">
            <div class="col-lg-6">
                <a href="dashboard.php" class="btn btn-block mt-2 mb-2" style="background-color:gray"><i class="fas fa-arrow-left"></i>Dashboard</a>
            </div>
            <div class="col-lg-6">
            <button type="submit" name="posalji" style="background-color: #b7d5d4" class="btn btn-block mt-2 mb-2"><i class="fas fa-check"></i></button>
            </div>
        </div>
        
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-2"></div>
    </div>
    <hr>
    <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4"> <?php echo ErrorMsg();
            echo SuccessMsg(); ?></div>
            <div class="col-sm-4"></div>
            <div class="col-lg-12">
            <h3 class="text-center" style="font-family:'Archivo Black', sans-serif;">Obriši administratora </h3>
            <hr>   
            <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th style="max-width: 15px">#</th>
                            <th style="max-width: 40px">Koris.</th>
                            <th style="max-width: 40px;">Ime</th>
                            <th style="max-width: 30px;">Datum</th>
                            <th style="max-width: 30px;">Dodao</th>
                            <th><i class="fas fa-trash"></i></th>
                        </tr>
                    </thead>
                
                <?php 
                $con;
                $sql='SELECT * FROM admins ORDER BY id desc';
                $exec=$con->query($sql);
                $br=0;
                while($DataRows=$exec->fetch()){
                    $id=$DataRows["id"];
                    $vreme=$DataRows["vremedatum"];
                    $ime=$DataRows["ime"];
                    $korisnickoime=$DataRows["korisnickoime"];
                    $odobrio=$DataRows["dodao"];
                    $br++;
                ?>
                <tbody>
                    <tr>
                        <th style="max-width: 15px"><?php echo htmlentities($br); ?>)</th>
                        <th style="max-width: 40px"><?php echo htmlentities($korisnickoime); ?></th>
                        <th style="max-width: 40px;"><?php echo htmlentities($ime); ?></th>
                        <th style="max-width: 30px;"><?php echo htmlentities(substr($vreme,0,11)); ?></th>
                        <th style="max-width: 30px;"><?php echo htmlentities($odobrio) ?></th>
                        <td><a href="deleteadmin.php?id=<?php echo $id; ?>" style="color:tomato" class="text-center"><i class="fas fa-trash"></i></a></td>
                    </tr>
                </tbody>
                <?php } ?>
            </table>
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