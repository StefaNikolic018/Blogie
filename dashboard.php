<?php require_once("Includes/db.php"); ?>
<?php require_once("Includes/funkcije.php"); ?>
<?php require_once("Includes/sesije.php"); ?>
<?php
potvrda_login();
?>
<?php include("navbarprivatni.php");?>
<title>Dashboard</title>
<!--HEADER-->
    <header class="bg-dark text-white py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center" style="font-family: 'Archivo Black', sans-serif;"><i class="fas fa-cog" style="color:gray"></i>Dashboard</h1>
                    <hr>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 mb-2">
                    <a href="postovi.php" class="btn btn-block" style="background-color:#444C4E">
                        <i class="fas fa-edit"></i> Dodaj novi post
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 mb-2">
                    <a href="kategorije.php" class="btn btn-block" style="background-color:teal">
                        <i class="fas fa-folder-plus"></i> Dodaj novu kategoriju
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 mb-2">
                    <a href="admins.php" class="btn  btn-block" style="background-color:steelblue">
                        <i class="fas fa-user-plus"></i> Dodaj novog admina
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 mb-2">
                    <a href="komentari.php" class="btn btn-block" style="background: #b7d5d4; color:#444C4E">
                        <i class="fas fa-comments"></i> Upravljaj komentarima
                    </a>
                </div>
            </div>
            <hr>
        </div>
    </header>
    <!--HEADER KRAJ-->

    <!-- MAIN -->

    <section class="container py-2 mb-4">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4"> <?php
                                    echo ErrorMsg();
                                    echo SuccessMsg();
                                    ?></div>

            <div class="col-sm-4"></div>
            <!-- LEVA STRANA  -->
            <div class="col-lg-2" style="font-family:'Archivo Black', sans-serif;">
                <div class="card text-center text-white mb-3" style="background:#444C4E">
                    <div class="card-body" style="box-shadow:0 0 0,0 0 5px black,0 0 0,0 0 10px black;">
                        <h1 class="lead">Postovi
                        </h1>
                        <h4 class="display-5">
                            <i class="fab fa-readme"></i>
                            <?php
                            show('postovi');
                            ?>
                        </h4>
                    </div>
                </div>


                <div class="card text-center text-white mb-3" style="background:teal;">
                    <div class="card-body" style="box-shadow:0 0 0,0 0 5px black,0 0 0,0 0 10px black;">
                        <h1 class="lead" >Kategorije
                        </h1>
                        <h4 class="display-5">
                            <i class="fas fa-folder-plus"></i>
                            <?php
                            show('kategorije');
                            ?>
                        </h4>
                    </div>
                </div>


                <div class="card text-center text-white mb-3" style="background:steelblue">
                    <div class="card-body" style="box-shadow:0 0 0,0 0 5px black,0 0 0,0 0 10px black;">
                        <h1 class="lead"> Admins
                        </h1>
                        <h4 class="display-5">
                            <i class="fas fa-users"></i>
                            <?php
                            show('admins');
                            ?>
                        </h4>
                    </div>
                </div>


                <div class="card text-center mb-3" style="background:#b7d5d4;color:#444C4E;">
                    <div class="card-body" style="box-shadow:0 0 0,0 0 5px black,0 0 0,0 0 10px black;">
                        <h1 class="lead">Komentari
                        </h1>
                        <h4 class="display-5">
                            <i class="fas fa-comments"></i>
                            <?php
                            show('komentari');
                            ?>
                        </h4>
                    </div>
                </div>
            </div>
            <!-- LEVA STRANA KRAJ -->

            <!-- DESNA STRANA -->
            <div class="col-lg-10">
                <h3 class="text-center" style="font-family:'Archivo Black',sans-serif;color:#444C4E;">Najnoviji postovi</h3>
                <table class="table table-striped table-hover" >
                    <thead class="thead-dark" >
                        <tr>
                            <th>#</th>
                            <th>Naslov</th>
                            <th>Datum</th>
                            <th>Autor</th>
                            <th>Komentari</th>
                            
                        </tr>
                    </thead>
                    <?php
                    $con;
                    $sql = "SELECT * FROM postovi ORDER BY id desc LIMIT 5";
                    $stmt = $con->query($sql);
                    $br = 0;
                    while ($DataRows = $stmt->fetch()) {
                        $id = $DataRows['id'];
                        $naslov = $DataRows['naslov'];
                        $vremedatum = $DataRows['vremedatum'];
                        $autor = $DataRows['autor'];
                        $br++;
                    ?>
                        <tbody>
                            <tr>
                                <th><?php echo $br ?></th>
                                <th><a href="fullpost.php?id=<?php echo $id?>" target="blank"><?php echo substr($naslov,0,8).'..'; ?></a></th>
                                <th><?php echo substr($vremedatum,0,11).'..'; ?></th>
                                <th><?php echo $autor ?></th>
                                <th>
                                    &nbsp; &nbsp;<span class="badge badge-success"><?php kom('on', $id); ?></span>
                                    &nbsp; <span class="badge badge-danger"><?php kom('off', $id); ?></span></th>
                            </tr>
                        </tbody>
                    <?php } ?>
                </table>
            </div>

            <!-- DESNA STRANA KRAJ -->


        </div>

    </section>

    <!-- MAIN KRAJ-->

    <!--FOOTER-->
    <div style="height: 5px; background-color: #b7d5d4"></div>
    <footer class="bg-dark text-white pt-2">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="lead text-center">Theme by | <i class="fas fa-dollar-sign" style="color:gold"></i>tefa<i class="fab fa-neos" style="color:steelblue"></i>ikolic | &copy; All rights reserved | <span id="year"> </span></p>
                </div>

            </div>
        </div>
    </footer>
    <div style="height: 5px; background-color: #b7d5d4"></div>

    <!--FOOTER KRAJ-->
    <script>
        $('#year').text(new Date().getFullYear());
    </script>
</body>

</html>