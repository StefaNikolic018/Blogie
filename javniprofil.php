<?php include_once("Includes/db.php"); ?>
<?php include_once("Includes/funkcije.php"); ?>
<?php include_once("Includes/sesije.php"); ?>
<?php
$con;
$korisnicko = $_GET["korisnicko"];
$sql = "SELECT * FROM admins";
$stmt = $con->query($sql);
$sql = "SELECT * FROM admins WHERE korisnickoime=:korisnicko";
$stmt = $con->prepare($sql);
$stmt->bindValue(':korisnicko', $korisnicko);
$stmt->execute();
$admin = $stmt->fetch();
if (empty($admin)) {
    $_SESSION["ErrorMsg"] = "Pogrešan zahtev, pokušajte ponovo!";
    Redirect_to("blog.php?stranica=1");
}
?>

    
    <!-- NAVBAR-->
    <?php include("javninavbar.php"); ?>
    <title><?php echo $admin["korisnickoime"]; ?></title>
    <!--NAVBAR KRAJ -->


    <!-- MAIN START -->
    <section class="container py-2 mb-2 mt-2 rounded d-flex flex-column" style="background: rgb(255,215,0);
background: radial-gradient(circle, rgba(255,215,0,1) 0%, rgba(70,130,180,1) 100%);min-height:80.3vh;">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">


            </div>
            <div class="col-sm-4 "></div>
        </div>
        <div class="row mt-5">
            <div class="col-md-3 mt-3">
                <div class="card mb-3 rounded bg-dark" style="box-shadow:0 0 0,0 0 5px black,0 0 0,0 0 10px black;">
                    <div class="card-header bg-dark text-light">
                        <h3 class="text-center" style="color:gold;font-family: 'Archivo Black', sans-serif;text-shadow:0 0 1px black,0 0 1px black,0 0 1px black,0 0 0,0 0 1px black;"><i class="fas fa-user" style="color:white; font-size:30px"></i> <?php echo $admin["korisnickoime"]; ?> </h3>
                        <hr>
                        <small>
                            <h6 class="text-center" style="color:steelblue;"><b><?php echo $admin["zvanje"]; ?></b></h6>
                        </small>
                    </div>
                    <div class="card-body text-center" style="background: rgb(52,58,64);
background: linear-gradient(90deg, rgba(52,58,64,0.9837068616509104) 13%, rgba(0,0,0,0.6055556011467087) 50%, rgba(0,0,0,0.7568161053483894) 83%);">
                        <img style="height:200px; min-height:200px; width:200px; border: 3px solid white; margin:auto;box-shadow:0 0 0,0 0 5px black,0 0 0,0 0 10px black;" src="Uploads/<?php echo $admin["slika"]; ?>" alt="slika" class="img-fluid rounded-circle d-block mb-3">
                        <hr>
                        <h6 class="text-center text-light"><?php echo $admin["vremedatum"]; ?> </h6>
                    </div>
                </div>
            </div>
            
                <!-- POSTOVI START -->
                <div class="col-md-6 " >
                    
                        <?php 
                        $con;
                        $sql="SELECT COUNT(id) AS br FROM postovi WHERE autor=:autor";
                        $stmt=$con->prepare($sql);
                        $stmt->bindValue(':autor',$korisnicko);
                        $stmt->execute();
                        $rez=$stmt->fetch(); ?>
                        <h4 class="text-center" style="font-family: 'Archivo Black', sans-serif;text-shadow:0 0 1px white,0 0 1px white,0 0 1px white,0 0 1px white;">Postovi (<?php echo array_shift($rez); ?>)</h4>
                <div class="mb-2">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php
                            $con;
                            $sql = "SELECT * FROM postovi WHERE autor=:korisnicko";
                            $stmt = $con->prepare($sql);
                            $stmt->bindValue(':korisnicko', $korisnicko);
                            $stmt->execute();
                            $br = 0;
                            while ($postovi = $stmt->fetch()) {
                                $br++;
                            ?>
                                <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $br; ?>" class="<?php if ($br == 1) {
                                                                                                                            echo "active";
                                                                                                                        } ?>"></li>
                            <?php } ?>
                        </ol>
                        <div class="carousel-inner rounded" style="box-shadow:0 0 5px black,0 0 5px black,0 0 5px black,0 0 10px black;height: 400px; max-height:400px">
                            <?php
                            $con;
                            $sql = "SELECT * FROM postovi WHERE autor=:korisnicko";
                            $stmt = $con->prepare($sql);
                            $stmt->bindValue(':korisnicko', $korisnicko);
                            $stmt->execute();
                            $br = 0;
                            while ($postovi = $stmt->fetch()) {
                                 ++$br;
                            ?>
                                <div class="carousel-item <?php if ($br == 1) {
                                                                echo "active";
                                                            } ?>">
                                    <img class="d-block w-100" src="Uploads/<?php echo $postovi["slika"]; ?>" style="height: 400px; max-height:400px" alt="Slajd broj <?php echo $br; ?>">
                                    <div class="carousel-caption d-none d-md-block rounded " style="  background: rgb(127,127,128);
background: linear-gradient(0deg, rgba(127,127,128,0.6979925759366247) 0%, rgba(10,7,0,0.804435152967437) 91%);   max-height:150px; height:150px; box-shadow:0 0 0,0 0 5px black,0 0 0,0 0 10px black;">
                                        <h4 style="color:gold; font-family: 'Anton', sans-serif;text-shadow:0 0 1px black,0 0 1px black,0 0 1px black,0 0 1px black;font-family:'Archivo Black',sans-serif;"><a class="" href="fullPost.php?id=<?php echo $postovi["id"]; ?>"><?php echo $postovi["naslov"]; ?></a> <i class="fas fa-comments text-white"> (<?php kom('on', $postovi["id"]); ?>) </i></h4>
                                        <div>
                                            <small class=" text-center" style="color:steelblue;text-shadow:0 0 0,0 0 2px black,0 0 0,0 0 2px black;"><?php echo $postovi["vremedatum"]; ?></small>
                                            <p class="text-light" style="text-shadow:0 0 1px black,0 0 1px black,0 0 1px black,0 0 1px black;"><?php if (strlen($postovi["post"]) > 50) {
                                                                        echo substr($postovi["post"], 0, 49) . "..";
                                                                    } else {
                                                                        echo $postovi["post"];
                                                                    } ?></p>
                                        </div>

                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true" style="filter:invert(100%);"></span>
                                    <span class="sr-only">Prethodni</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true" style="filter:invert(100%);"></span>
                                    <span class="sr-only">Sledeći</span>
                                </a>
                            <?php }
                             ?>
                        </div>

                        <!-- POSTOVI KRAJ -->

                    </div>
                </div>

            </div>
            
            <div class="col-sm-3 mt-3" >
                <div class="card mb-3 bg-dark rounded" style="box-shadow:0 0 0,0 0 5px black,0 0 0,0 0 10px black;">
                    <div class="card-header bg-dark text-white">
                        <h3 class="text-center" style="font-family: 'Archivo Black', sans-serif;text-shadow:0 0 2px black,0 0 2px black,0 0 2px black,0 0 2px black;">Biografija</h3>
                    </div>
                    <div class="card-body bg-light" style="height:350px; max-height:350px;">
                        <?php echo $admin["bio"]; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- MAIN KRAJ -->


    <!--FOOTER-->
    <?php include("futer.php"); ?>
    <!-- FOOTER KRAJ  -->
</body>

</html>