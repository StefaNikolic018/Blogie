<?php require_once("Includes/db.php"); ?>
<?php require_once("Includes/funkcije.php"); ?>
<?php require_once("Includes/sesije.php"); ?>
<?php
potvrda_login();
?>
<!-- NAVBAR -->
<?php include("navbarprivatni.php"); ?>
<title>Postovi</title>
    <!--NAVBAR KRAJ-->

    <!--HEADER-->
    <header class="bg-dark text-white py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center" style="font-family:'Archivo Black',sans-serif;color:#b7d5d4"><i class="fab fa-readme" style="color:darkgray"></i> Pregled postova</h1>
                    <hr>
                </div>
                
                <div class="col-md-4"></div>
                <div class="col-lg-4 ">
                    <a href="postovi.php" class="btn btn-block" style="background-color:darkgray;color:#343A40;">
                    <i class="fas fa-edit"></i> Dodaj novi post
                    </a>
                    <hr>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </header>
    <!--HEADER KRAJ-->

    <!-- MAIN -->

    <section class="container py-2 mb-4">
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">    <?php 
            echo ErrorMsg();
            echo SuccessMsg();      
            ?></div>
        <div class="col-sm-4"></div>

    <div class="col-lg-12 table-responsive">
        <table class="table table-striped table-hover ">
        <thead class="thead-dark">     
        <tr>
                <th>#</th>
                <th>Naslov</th>
                <th>Kategorija</th>
                <th>Datum</th>
                <th>Autor</th>
                <th>Slika</th>
                <th>Komentari</th>
                <th>Akcija</th>
                <th>Live </th>
            </tr>
            </thead>
            <br>
        <tbody>
            <?php 
            $con;
            $sql="SELECT * FROM postovi";
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
                <td>
                    <?php 
                        if (strlen($naslov)>20){
                            $naslov=substr($naslov,0,18)."..";
                            echo $naslov;
                        }
                        else{
                            echo $naslov;
                        } ?>
                </td>
                <td>
                <?php
                        if (strlen($kategorija)>8){
                            $kategorija=substr($kategorija,0,8)."..";
                            echo $kategorija;
                        }
                        else{
                            echo $kategorija;
                        } ?>
                 </td>
                <td>
                    <?php 
                        if (strlen($datumvreme)>11){
                            $datumvreme=substr($datumvreme,0,11)."..";
                            echo $datumvreme;
                        }
                        else{
                            echo $datumvreme;
                        } ?>                    
                </td>
                <td><?php echo $admin; ?></td>
                <td style="max-width:30%;"><img src="Uploads/<?php echo $slika; ?>" alt="Slika" style="max-width: 100%" height="50px"></td>
                <th>
                       &nbsp; &nbsp;<span class="badge badge-success"><?php kom('on',$id); ?></span>
                       &nbsp; <span class="badge badge-danger"><?php kom('off',$id); ?></span></th>
                <td><a href="editpost.php?id=<?php echo $id; ?>"><i class="fas fa-edit" style="color:forestgreen"></i></a>&nbsp; &nbsp;<a href="deletepost.php?id=<?php echo $id; ?>" style="color:tomato"><i class="fas fa-trash"></i></a></td>
                <td>&nbsp; <a href="fullpost.php?id=<?php echo $id; ?>"><i class="fas fa-eye"></i></a></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    </div>

    </section>
    
    <!-- MAIN KRAJ-->

    <!--FOOTER-->
<?php include("futerprivatni.php"); ?>

<!--FOOTER KRAJ-->
<script>$('#year').text(new Date().getFullYear());</script>
</body>
</html>