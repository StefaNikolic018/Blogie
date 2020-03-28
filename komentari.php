<?php require_once("Includes/db.php"); ?>
<?php require_once("Includes/funkcije.php"); ?>
<?php require_once("Includes/sesije.php");?>
<?php
potvrda_login();
?>
<!-- NAVBAR -->
<?php include("navbarprivatni.php"); ?>
<title> Menadžer komentara </title>
    <!--NAVBAR KRAJ-->

    <!--HEADER-->
    <header class="bg-dark text-white py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center" style="font-family:'Archivo Black',sans-serif;color:#b7d5d4"><i class="fas fa-comments text-light"></i> Menadžer komentara</h1>
                </div>
            </div>
        </div>
    </header>
    <!--HEADER KRAJ-->


    <!--MAIN KRAJ-->
    <section class="container py-2 mb-4">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4"> <?php echo ErrorMsg();
            echo SuccessMsg(); ?></div>
            <div class="col-sm-4"></div>
            <div class="col-sm-2"></div>
            <div class="col-sm-8 mt-2">
            <h3 class="text-center" style="font-family:'Archivo Black',sans-serif;">Neodobreni komentari <i style="color:red"class="fas fa-times"></i></h3>
                <table class="table table-striped table-hover text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Korisnik</th>
                            <th style="max-width: 50px;">Datum</th>
                            <th>Komentar</th>
                            <th>Akcije</th>
                            <th>Live</th>
                        </tr>
                    </thead>
                
                <?php 
                $con;
                $sql='SELECT * FROM komentari WHERE status="off" ORDER BY id desc';
                $exec=$con->query($sql);
                $br=0;
                while($DataRows=$exec->fetch()){
                    $id=$DataRows["id"];
                    $vreme=$DataRows["vremedatum"];
                    $ime=$DataRows["ime"];
                    $komentar=$DataRows["komentar"];
                    $post=$DataRows["postid"];
                    $br++;
                ?>
                <tbody>
                    <tr>
                        <th><?php echo htmlentities($br); ?></th>
                        <th><?php echo htmlentities($ime); ?></th>
                        <th style="max-width: 50px;" class="px-1"><?php echo htmlentities($vreme); ?></th>
                        <th><?php if(strlen($komentar)>10){ echo htmlentities(substr($komentar,0,10)."..."); } else{ echo htmlentities($komentar);} ; ?></th>
                        <td><a href="approveComment.php?id=<?php echo $id; ?>"><i class="fas fa-check" style="color:forestgreen"></i></a> <a href="deleteComment.php?id=<?php echo $id; ?>" style="color:tomato"><i class="fas fa-trash"></i></a></td>
                <td><a class="btn " data-toggle="collapse" href="#multiCollapseExample<?php echo $br;?>" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"><i class="fas fa-eye"></i></a></td>
                    </tr>
                    <tr>
                        <th>

  <div class="col-lg-12">
    <div class="collapse multi-collapse" id="multiCollapseExample<?php echo $br;?>">
      <div class="card" style="background-color: slategray">
            <div class="card-body">
                <hr>
                <small class="text-light"><span class="bg-dark">&nbsp;</span> Napisao: <?php echo $ime; ?> </small>
                <span style="float:right;" class="badge badge-dark text-light"> <?php echo $vreme; ?></span>
                <hr>
                <p class="card-text">
                    <?php echo $komentar; ?>
                </p>
                <hr>
                Post id: <?php $post; ?>
            </a>
            <hr>
            </div>
      </div>
    </div>
  </div>

                        </th>
                    </tr>
                </tbody>
                <?php } ?>
            </table>
            </div>
            <div class="col-sm-2"></div>
        </div>
        <hr>
    <div class="row">
        <div class="col-sm-2"></div>
    <div class="col-sm-8 mt-2">
            <h3 class="text-center" style="font-family:'Archivo Black',sans-serif;">Odobreni komentari <i style="color:green;" class="fas fa-check"></i></h3>
                <table class="table table-striped table-hover text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th >#</th>
                            <th>Korisnik</th>
                            <th style="max-width: 50px;">Datum</th>
                            <th>Komentar</th>
                            <th>Akcije</th>
                            <th>Live</th>
                        </tr>
                    </thead>
                
                <?php 
                $con;
                $sql='SELECT * FROM komentari WHERE status="on" ORDER BY id desc';
                $exec=$con->query($sql);
                $br=0;
                while($DataRows=$exec->fetch()){
                    $id=$DataRows["id"];
                    $vreme=$DataRows["vremedatum"];
                    $ime=$DataRows["ime"];
                    $komentar=$DataRows["komentar"];
                    $post=$DataRows["postid"];
                    $br++;
                ?>
                <tbody>
                    <tr>
                        <th><?php echo htmlentities($br); ?></th>
                        <th><?php echo htmlentities($ime); ?></th>
                        <th style="max-width: 60px;" class="px-1"><?php echo htmlentities($vreme); ?></th>
                        <th><?php if(strlen($komentar)>10){ echo htmlentities(substr($komentar,0,10)."..."); } else{ echo htmlentities($komentar);} ; ?></th>
                        <td><a href="disapproveComment.php?id=<?php echo $id; ?>">&nbsp;<i class="fas fa-times" style="color:red"></i></a>&nbsp; &nbsp;<a href="deleteComment.php?id=<?php echo $id; ?>" style="color:tomato"><i class="fas fa-trash"></i></a></td>
                <td class="text-center"> <a class="btn"href="fullpost.php?id=<?php echo $post; ?>&kom=<?php echo $id;?>">&nbsp;<i class="fas fa-eye"></i></a></td>
                    </tr>
                </tbody>
                <?php } ?>
            </table>
            </div>
            <div class="col-sm-8"></div>
        </div>
        </section>
    

    <!--MAIN KRAJ-->

    <!--FOOTER-->
   <?php include("futerprivatni.php");?>
<!--FOOTER KRAJ-->
<script>$('#year').text(new Date().getFullYear());</script>
</body>
</html>