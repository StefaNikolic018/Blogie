    <!-- NAVBAR -->

    <?php include("javninavbar.php"); ?>
    <title>Blog</title>

    <!-- NAVBAR KRAJ -->

    <div class="container mb-3 mt-3 rounded" style="   background: rgb(183,213,212);
background: radial-gradient(circle, rgba(183,213,212,0.7035948168329832) 21%, rgba(55,62,64,1) 100%);    ">
        <div class="row">

            <!--MAIN AREA START-->
            <div class="col-sm-8 mt-3">
                <h1 style="       font-family: 'Archivo Black',sans-serif;text-shadow:0 0 1px #b7d5d4,0 0 1px #b7d5d4,0 0 1px #b7d5d4,0 0 1px #b7d5d4;color:#373e40;">Blog</h1>

                <hr>
                <h1 class="lead"><span style="background:#b7d5d4;">&nbsp;</span> <b>Budite uvek u toku !</b></h1>

                <?php
                echo ErrorMsg();
                echo SuccessMsg();
                ?>
                <?php
                if (isset($_GET["pretrazi"])) 
                {
                    // KADA PRETRAZUJEMO blog.php?pretraga=...
                    $pretraga = $_GET["pretraga"];
                    $sql = "SELECT * FROM postovi 
                    WHERE vremedatum LIKE :search
                    OR kategorija LIKE :search
                    OR naslov LIKE :search
                    OR post LIKE :search ";
                    $stmt = $con->prepare($sql);
                    $stmt->bindValue(':search', '%' . $pretraga . '%');
                    $stmt->execute();
                } 
                elseif (!empty($_GET["stranica"]) && !isset($_GET["kategorija"])) 
                {
                    // KADA NE PRETRAZUJEMO VEC POKAZUJEMO POSTOVE 
                    $sql = "SELECT COUNT(id) AS br FROM postovi";
                    $stmt = $con->query($sql);
                    $br1 = $stmt->fetch();
                    $str1 = ceil(array_shift($br1) / 4);
                    if ($_GET["stranica"] < 0  || $_GET["stranica"] > $str1 || !is_numeric($_GET["stranica"])) 
                    {
                        $stranica = 1;
                        $od = ($stranica * 4) - 4;
                        $do = $stranica * 4;
                        $sql = "SELECT * FROM postovi ORDER BY id desc LIMIT $od,$do";
                        $stmt = $con->query($sql);
                    } 
                    else 
                    {
                        $stranica = $_GET["stranica"];
                        $od = ($stranica * 4) - 4;
                        $do = $stranica * 4;
                        $sql = "SELECT * FROM postovi ORDER BY id desc LIMIT $od,$do";
                        $stmt = $con->query($sql);
                    }
                    //KADA LISTAMO PO KATEGORIJI
                } elseif (empty($_GET["stranica"]) && isset($_GET["kategorija"])) {
                    $kat=$_GET["kategorija"];

                    //IZLISTAVANJE PUTEM PROCEDURE
                    // $sql="SET @p0=".$kat."; CALL `p_postoviKategorije`(@p0); ";
                    // $stmt=$con->query($sql);
                    // $stmt->bindValue($kat,":kategorija");
                    // $stmt->execute();

                    //KLASICNO IZLISTAVANJE
                    $sql="SELECT * FROM postovi WHERE kategorija=:kategorija";
                    $stmt=$con->prepare($sql);
                    $stmt->bindValue(":kategorija",$kat);
                    $stmt->execute();
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
                    //BROJ KOMENTARA
                    $sql1 = "SELECT f_brKomentara(".$id.")";
                    $stmt1 = $con->query($sql1);
                    $br = $stmt1->fetch();
                    $br=array_shift($br);
                    ?>
                    <div class="card" style="   background: rgb(55,62,64);
background: radial-gradient(circle, rgba(55,62,64,0.8520542005864846) 21%, rgba(183,213,212,1) 100%);   ">
                        <div class="card-body">

                            <h3 class="card-title" style="       font-family: 'Archivo Black',sans-serif; color:#373e40;text-shadow:0 0 1px #b7d5d4,0 0 1px #b7d5d4,0 0 1px #b7d5d4,0 0 1px #b7d5d4; "><?php echo htmlentities($naslov); ?><span style="float:right;" class="badge badge-dark text-light"><i class="fas fa-comments"></i> <?php echo $br; ?></span></h4>
                            <hr>
                            <b><h5 style="color:#383F41;"><span class="btn-warning">&nbsp;</span> Napisao: <a style="color:steelblue;font-family: 'Archivo Black',sans-serif;text-shadow: 0 0 1px #373e40, 0 0 1px #373e40, 0 0 1px #373e40, 0 0 1px #373e40;" href="javniprofil.php?korisnicko=<?php echo htmlentities($autor); ?>"><?php echo htmlentities($autor); ?></a><span style="float:right"><?php echo htmlentities($vremedatum); ?></span> </h5></b>
                            <hr>
                            <div class="text-center">
                                <img style="max-height:308px; border:4px solid #373e40;box-shadow:0 0 0,0 0 5px black,0 0 0,0 0 10px black;" src="<?php echo htmlentities($slika); ?>" alt="Slika" class="img-fluid card-top mb-2">
                            </div>
                            <h5 class="card-title text-center">Kategorija: <b><a style="color:gold; font-family: 'Archivo Black',sans-serif;text-shadow: 0 0 0.5px #373e40, 0 0 0.5px #373e40, 0 0 0.5px #373e40, 0 0 0.5px #373e40;" href="blog.php?kategorija=<?php echo $kategorija ?>"><?php echo htmlentities($kategorija); ?></a></b></h5>
                            <hr>
                            <h6 class="card py-2 px-2 rounded" style="color:#b7d5d4; background:#373e40;" >
                                <?php if (strlen($post) > 150) {
                                    $post = substr($post, 0, 150) . "..";
                                    echo htmlentities($post);
                                } else {
                                    echo htmlentities($post);
                                } ?>
                                                            <a href="fullpost.php?id=<?php echo $id; ?>" >
                                <span class="btn" style="background:#b7d5d4; font-family:'Archivo Black', sans-serif;color:#373e40;float:right">Pročitaj</span>
                            </a>
                            </h6>
                        </div>
                    </div>
                    <br>
                    <hr>
                <?php }
                ?>

                <!-- MENJANJE STRANICA -->
                <?php
                //PRVO PITAMO DA LI NE PRETRAZUJEMO POMOCU SEARCH VEC SAMO DA NAM LISTA POSTOVE
                if (!isset($_GET["pretrazi"]) && !isset($_GET["kategorija"])) {
                    $con;
                    $sql = "SELECT f_Pagination()";
                    $stmt = $con->query($sql);
                    $br = $stmt->fetch();
                    $brstr = array_shift($br);
                    $str = $_GET["stranica"];
                    //AKO POKUSAMO DA PRISTUPIMO STRANICI KOJA NE POSTOJI
                    if ($str > $brstr || $str < 1) {
                        Redirect_to("blog.php?stranica=1");
                    }
                    $napred = (int) $str + 1;
                    $nazad = (int) $str - 1;
                ?>
                    <nav class="text-center" style="color:#B3D0CF;">
                        <ul class="pagination pagination-lg" >
                            <?php if($str==1){

                            } else {
                                echo '<li class="page-item" >
                                <a href="blog.php?stranica=1" class="page-link"> <i class="fas fa-angle-double-left" style="color:steelblue;font-size:25px"></i> </a> </li>';
                                echo '<li class="page-item" >
                                <a href="blog.php?stranica='.$nazad.'" class="page-link"> <i class="fas fa-angle-left" style="color:steelblue;font-size:25px"></i> </a> </li>';
                                
                            }?>
<?php
                                                        for ($i = 1; $i <= $brstr; $i++) {
                                                        ?> <li class="page-item">
                                                <a href="blog.php?stranica=<?php echo $i; ?>" style="<?php if ($i == $stranica) {
                                                                                                                    echo 'background:steelblue;color:#B3D0CF;';
                                                                                                                } else {
                                                                                                                    'color:steelblue;';
                                                                                                                }
                                                                                                                 ?>" class="page-link"><?php echo $i; ?></a>
                            </li>

                        <?php   }
                        ?>
                        <?php if($str==$brstr){

                        }else{
                            echo '<a href="blog.php?stranica='.$napred.'" class="page-link" style="color:steelblue"> <i class="fas fa-angle-right" style="color:steelblue;font-size:25px"></i> </a> </li>';
                            echo '<a href="blog.php?stranica='.$brstr.'" class="page-link" style="color:steelblue"> <i class="fas fa-angle-double-right" style="color:steelblue;font-size:25px"></i> </a> </li>';
                        } ?>

                    <?php } else {
                } ?>
                        </ul>
                    </nav>

                    <!-- MENJANJE STRANICA KRAJ -->

            </div>
            <!--MAIN AREA KRAJ-->

            <!-- SIDE AREA -->

            <?php include("sidearea.php"); ?>

            <!-- SIDE AREA KRAJ -->

        </div>
    </div>

    <!-- FUTER -->
    <?php include("futer.php"); ?>
    <!-- FUTER KRAJ -->

    </body>

    </html>