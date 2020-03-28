<?php require_once("Includes/db.php"); ?>
<?php require_once("Includes/funkcije.php"); ?>
<?php require_once("Includes/sesije.php");?>
<?php
potvrda_login();
?>
<?php 
if(isset($_POST['posalji'])){
    $naslov=$_POST['naslov'];
    $admin=$_SESSION["korisnicko"];
    $vreme=time();
    $vremestr=strftime("%Y-%d-%B %H:%M:%S",$vreme);
    
    if(empty($naslov)){
        $_SESSION["ErrorMsg"] = "Morate popuniti sva polja!";
        Redirect_to("kategorije.php");
    }elseif(strlen($naslov)<4){
        $_SESSION["ErrorMsg"]="Naslov treba biti duzi od 3 karaktera!";
        Redirect_to("kategorije.php");
    }elseif(strlen($naslov)>50){
        $_SESSION["ErrorMsg"]="Naslov ne sme biti duzi od 50 karaktera!";
        Redirect_to("kategorije.php");
    }
    else{
        $sql="INSERT INTO kategorije(naslov,autor,datumvreme) VALUES(:naslov,:autor,:vreme)";
        $stmt=$con->prepare($sql);
        $stmt->bindValue(':naslov',$naslov);
        $stmt->bindValue(':autor',$admin);
        $stmt->bindValue(':vreme',$vremestr);
        $exec=$stmt->execute();
        if($exec){
            $_SESSION["SuccessMsg"]="Uspesno dodata kategorija '".$naslov."'";
            Redirect_to("kategorije.php");
        }else{
            $_SESSION["ErrorMsg"]="Problem sa bazom, pokusajte ponovo!";
            Redirect_to("kategorije.php");
        }
    }

}
?>
<!-- NAVBAR -->
<?php include("navbarprivatni.php"); ?>
<title> Kategorije </title>
    <!--NAVBAR KRAJ-->

    <!--HEADER-->
    <header class="bg-dark text-white py-2">
        <div class="container">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <h1 class="text-center" style="font-family:'Archivo Black', sans-serif;color:#b7d5d4"><i class="fas fa-folder-plus" style="color:teal"></i> Upravljaj kategorijama</h1>
                </div>
                <div class="col-sm-2"></div>
            </div>
        </div>
    </header>
    <!--HEADER KRAJ-->

    <!--MAIN -->
    <section class="container py-2 mb-4 mt-2">
    <div class="row">
    <div class="col-sm-4"></div>
        <div class="col-sm-4">    <?php 
            echo ErrorMsg();
            echo SuccessMsg();      
            ?></div>
        <div class="col-sm-4"></div>
        <div class="col-sm-2"></div>
        <div class="col-lg-8" >
            <form action="kategorije.php" method="post" class="">
                <div class="card bg-secondary text-white" style="box-shadow:0 0 0,0 0 5px black,0 0 0,0 0 10px black;">
                    <div class="card-header">
                        <h3 style="font-family: 'Archivo Black', sans-serif">Dodaj novu kategoriju</h3>
                    </div>
                    <div class="card-body bg-dark">
                        <div class="form-group">
                            <label for="title"><span class="FieldInfo">Naslov:</span> </label>
                            <input type="text" name="naslov" id="naslov" class="form-control" placeholder="Dodajte naslov kategorije">
                        </div>
                        <div class="row">
            <div class="col-lg-6">
                <a href="dashboard.php" class="btn btn-block mt-2 mb-2" style="background-color:gray"><i class="fas fa-arrow-left"></i>Dashboard</a>
            </div>
            <div class="col-lg-6">
            <button type="submit" name="posalji" style="background-color: #b7d5d4" class="btn btn-block mt-2 mb-2"><i class="fas fa-check"></i></button>
            </div>
        </div>
        <div class="col-sm-2"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <hr>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
            <h3 class="text-center" style="font-family: 'Archivo Black',sans-serif;">Obriši kategoriju </h3>
            <hr>
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Naslov</th>
                            <th>Autor</th>
                            <th>Datum&Vreme</th>
                            <th>Brisanje</th>
                        </tr>
                    </thead>
                
                <?php 
                $con;
                $sql='SELECT * FROM kategorije ORDER BY id desc';
                $exec=$con->query($sql);
                $br=0;
                while($DataRows=$exec->fetch()){
                    $id=$DataRows["id"];
                    $vreme=$DataRows["datumvreme"];
                    $ime=$DataRows["autor"];
                    $naslov=$DataRows["naslov"];
                    $br++;
                ?>
                <tbody>
                    <tr>
                        <th><?php echo htmlentities($br); ?></th>
                        <th><?php echo htmlentities(substr($naslov,0,7)); ?></th>
                        <th><?php echo htmlentities($ime); ?></th>
                        <th><?php echo htmlentities(substr($vreme,0,11).'..') ?></th>
                        <td>&nbsp; &nbsp; &nbsp;<a href="deletekategorije.php?id=<?php echo $id; ?>" style="color:tomato"><i class="fas fa-trash"></i></a></td>
                    </tr>
                </tbody>
                <?php } ?>
            </table>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </section>
    <!-- MAIN KRAJ -->

    <!--FOOTER-->

    <?php include("futerprivatni.php"); ?>

<!--FOOTER KRAJ-->
<script>$('#year').text(new Date().getFullYear());</script>
</body>
</html>