<!--SIDE AREA START-->
<div class="col-sm-4 mb-3">
    <!--    <div class="card mt-4">
                    <div class="card-body">
                        <img src="Images/usput.png" class="d-block img-fluid mb-3" alt="Oglas">
                        <div class="text-center">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet eveniet odio expedita est suscipit assumenda ipsa aliquam quibusdam earum asperiores ut, neque molestiae, vitae obcaecati culpa alias veniam consectetur esse.
                        </div>

                    </div>
                </div> -->
    <br>
    <div class="card mb-3" style="background-color:rgba(183,213,212,80%)">
        <div class="card-header bg-dark text-light">
            <h2 class="lead text-center" style="font-family:'Archivo Black', sans-serif;">Prijavi se !</h2>
        </div>
        <div class="card-body">
            <button class="btn btn-block text-center mb-1" style="background:#EDC12D;color:#373e40;" name="uclanise">Učlani se na forum</button>
            <a href="login.php"><button class="btn btn-block text-center" style="background-color: steelblue;color:#373e40;" name="login">Login</button></a>
            <br>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="" placeholder="Unesite email" value="">
                <div class="input-group-append">
                    <button class="btn btn-sm text-center text-white" style="background:#373e40;" name="dugme">Pretplatite se</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card" style="font-family: 'Archivo Black', sans-serif;background:rgba(183,213,212,80%);">
        <div class="card-header bg-dark text-light">
            <h1 class="lead text-center"> Kategorije </h1>
        </div>
        <div class="card-body">
            <?php
            //KATEGORIJE U SIDE SECTION-U
            $con;
            $sql = "SELECT * FROM kategorije";
            $stmt = $con->query($sql);
            $br = 0;
            while ($DataRows = $stmt->fetch()) {
                $id = $DataRows["id"];
                $naslov = $DataRows["naslov"];
                $br++;
            ?>
                <h5 style="color:#373e40;text-shadow: 0 0 0.5px white, 0 0 0.5px white, 0 0 0.5px white, 0 0 0.5px white;">
                    <a class="nav-link" href="blog.php?kategorija=<?php echo $naslov; ?>">
                        <?php echo $br . ". " . $naslov; ?>
                    </a>
                </h5>
                <hr>
            <?php } ?>
        </div>

    </div>
    <br>
    <div class="card" style="font-family: 'Archivo Black', sans-serif;background:rgba(183,213,212,80%);">
        <div class="card-header bg-dark">
            <h2 class="lead text-center text-light">Skorašnji postovi</h2>
        </div>
        <div class="card-body ">
            <?php
            $con;
            $sql = "SELECT * FROM postovi ORDER BY id desc LIMIT 0,5";
            $stmt = $con->query($sql);
            $br = 0;
            while ($DataRows = $stmt->fetch()) {
                $id = $DataRows["id"];
                $naslov = $DataRows["naslov"];
                $vremedatum = $DataRows["vremedatum"];
                $slika = $DataRows["slika"];
                $autor = $DataRows["autor"];
                $kategorija = $DataRows["kategorija"];
                $br++;
            ?>
                <div class="media ">
                    <h3 style="color:#373e40;"><?php echo $br; ?>. </h3> &nbsp;<img src="Uploads/<?php echo $slika; ?>" alt="Slika" class="d-block img-fluid align-self-start" style="width:120px; height:120px; border:4px solid #373e40;box-shadow:0 0 0,0 0 5px black,0 0 0,0 0 10px black;">
                    <div class="media-body ml-2">
                        <h6 class="lead">
                            <a href="fullpost.php?id=<?php echo $id; ?>"><?php echo $naslov; ?></a>
                        </h6>
                        <hr>
                        <a style="color:gold;text-shadow: 0 0 1px #373e40, 0 0 1px #373e40, 0 0 1px #373e40, 0 0 1px #373e40;" href="blog.php?kategorija=<?php echo $kategorija; ?>"><?php echo $kategorija; ?></a><br>
                        <small class="header">Napisao: <a style="color:steelblue" href="javniprofil.php?korisnicko=<?php echo $autor; ?>"><?php echo $autor; ?></a></br> <?php echo $vremedatum; ?></small>
                    </div>
                </div>
                <hr>
            <?php } ?>
        </div>
    </div>
</div>
<!--SIDE AREA KRAJ-->