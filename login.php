<?php require_once("Includes/db.php"); ?>
<?php require_once("Includes/funkcije.php"); ?>
<?php require_once("Includes/sesije.php");?>
<?php if(isset($_SESSION["korisnicko"])){
       if ($_SERVER["REQUEST_URI"] == "/cms/login.php"){
            Redirect_to("dashboard.php");
            $_SESSION["ErrorMsg"]="Morate se izlogovati !";
        }
        else{
            return true;
        }
    } ?>
<?php 
if(isset($_POST["posalji"])){
    $korisnickoime=$_POST["korisnickoime"];
    $lozinka=$_POST["lozinka"];
    if(empty($korisnickoime)||empty($lozinka)){
        $_SESSION["ErrorMsg"]="Popunite sva polja!";
        Redirect_to("login.php");
    } else {
        //Proveravamo da li postoji korisnik
        $con;
        $sql="SELECT * FROM admins WHERE korisnickoime='$korisnickoime'";
        //Sprecavanje SQL INJECTION-a
        $stmt=$con->prepare($sql);
        $stmt->bindValue(':korisnickoime',$korisnickoime);
        $stmt->execute();
        while($DataRows=$stmt->fetch()){
            //Fetch korisnickih podataka
            $korisnicko=$DataRows["korisnickoime"];
            $korisnickiid=$DataRows["id"];
            $ime=$DataRows["ime"];
            if(empty($korisnicko)){
                //Ako korisnik ne postoji
                $_SESSION["ErrorMsg"]="Korisnik ne postoji, pokusajte ponovo, ili se registrujte !";
                Redirect_to("login.php");
            }
            else{
                $lozinka1=$DataRows['lozinka'];
                if(!password_verify($lozinka,$lozinka1)){
                    //Pogresna lozinka
                    $_SESSION["ErrorMsg"]="Pogresna lozinka, pokusajte ponovo!";
                    Redirect_to("login.php");
                }
                else{
                    //Ispravna lozinka
                    $_SESSION["korisnickiid"]=$korisnickiid;
                    $_SESSION["korisnicko"]=$korisnicko;
                    $_SESSION["ime"]=$ime;
                    $_SESSION["SuccessMsg"]="Dobro dosli {$korisnickoime} !";
                    if(isset($_SESSION["url"])){
                        Redirect_to($_SESSION["url"]);
                    }
                    else{
                        Redirect_to("dashboard.php");
                    }
                }
            }
        }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/36c359f9b8.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <title>Login</title>
<style>

        .nav-item {
            color: #b7d5d4;
        }

        .nav-link:hover {
            color: white;
        }

        a:link {
            text-decoration: none;
            text-decoration-line: none;
            color: inherit;
        }

        a:visited {
            color: inherit;
        }

        .nav-link {
            font-family: 'Archivo Black', sans-serif;
        }

        body {


            font-family: 'Archivo Black', sans-serif;

            font-family: 'Roboto', sans-serif;




        }
    
        
        
    </style>




    <link href="https://fonts.googleapis.com/css?family=Archivo+Black|Roboto&display=swap" rel="stylesheet">
</head>

<body style="background: rgb(55,62,64);
background: radial-gradient(circle, rgba(250,250,250,5) 50%, rgba(55,62,64,0.8520542005864846) 100%);">
    <!--NAVBAR-->
    <div style="height: 5px; background-color: #b7d5d4"></div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-center">
        <div class="container text-center">
            <h3 class="text-center mr-3 " style="

    font-family: 'Archivo Black', sans-serif; color:#B5CADC;text-shadow: 0 0 5px #373e40, 0 0 5px #373e40, 0 0 5px #373e40, 0 0 5px #373e40;

"><i class="fab fa-btc" style="color:gold"></i>lo<i class="fab fa-google" style="color:steelblue"></i>ie</h1>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navcol">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navcol">

        </div>
        </div>
    </nav>
    <div style="height: 5px; background-color:#b7d5d4"></div>
    <!--NAVBAR KRAJ-->

    <!--HEADER-->

    <!--HEADER KRAJ-->
    <!-- MAIN START -->

    <section class="container py-2 mb-4 mt-5">

        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="card bg-secondary">
                <div class="card-header text-center text-dark" style="background: #b7d5d4;">
                    <h3 style="font-family:'Archivo Black',sans-serif;">Dobro došli !</h3>
                </div>
                    <div class="card-body bg-dark">
                    <?php 
                    echo ErrorMsg();
                    echo SuccessMsg();
                    ?>
                    <form action="login.php" method="post">
                        <div class="form-group">
                            <label for="username">
                                <span class="FieldInfo">
                                    Korisnicko ime:
                                </span>
                            </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-light" style="background:#b7d5d4"><i class="fas fa-user" ></i></span>
                                </div>
                                <input type="text" class="form-control" name="korisnickoime" id="username" placeholder="Unesite korisnicko ime">
                            </div>
                            <div class="form-group">
                            <label for="password">
                                <span class="FieldInfo">
                                    Lozinka:
                                </span>
                            </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-light " style="background:#b7d5d4"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control" name="lozinka" id="password" placeholder="Unesite vasu lozinku">
                            </div>
                            <div class="input-group mb-3">
                                <div class="checkbox">
                                <input type="checkbox" name="upamti"> <label for="checkbox"> Upamti me</label>
                                </div>
                            </div>
                        </div>
                        <input type="submit" name="posalji" class="btn btn-block" style="background:#b7d5d4" value="Login">
                    </form>
                </div>
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </section>

    <!-- MAIN KRAJ -->


    <!--FOOTER-->
    <div style="position: absolute; bottom:0; width:100%" class="futer">
<?php include("futerprivatni.php"); ?>
</div>
<!--FOOTER KRAJ-->
<script>$('#year').text(new Date().getFullYear());</script>
</body>
</html>