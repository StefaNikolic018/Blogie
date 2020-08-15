<!--NAVBAR-->
<?php include_once("Includes/db.php"); 
include_once("Includes/funkcije.php");
include_once("Includes/sesije.php");
ob_start();
?>
<!DOCTYPE html>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/36c359f9b8.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <style>
        .heading {
            font-weight: bold;
        }

        .nav-item {
            color: white;
        }

        .nav-link:hover {
            color: #b7d5d4;
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

<body style="  background: rgb(55,62,64);
background: radial-gradient(circle, rgba(250,250,250,5) 50%, rgba(55,62,64,0.8520542005864846) 100%);  ">

<div class="container">
    <div style="height: 5px;    background: rgb(255,193,7);
background: radial-gradient(circle, rgba(255,193,7,0.7960317916228992) 21%, rgba(183,213,212,1) 100%);   "></div>
    <nav class="navbar navbar-expand-lg " style="  background: rgb(55,62,64);
background: linear-gradient(90deg, rgba(55,62,64,0.9472922958245799) 87%, rgba(183,213,212,0.8996732482055322) 95%);   ">
        <h4 class="mr-5 mt-1" style="font-family:'Archivo Black',sans-serif;color:#b7d5d4;text-shadow: 0 0 2px #373e40, 0 0 2px #373e40, 0 0 2px #373e40, 0 0 2px #373e40;"><a href="blog.php?stranica=1"><i class="fab fa-btc" style="color:gold"></i>lo<i class="fab fa-google" style="color:steelblue"></i>ie</a></>
            </h3>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navcol">
                <span class="navbar-toggler-icon"> <i class="fas fa-hamburger" style="font-size: 25px; color:#b7d5d4;"></i> </span>
            </button>
            <div class="collapse navbar-collapse" id="navcol">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="blog.php?stranica=1" class="nav-link">Početna</a>
                    </li>
                    <li class="nav-item">
                        <a href="onama.php" class="nav-link">O nama</a>
                    </li>
                    <li class="nav-item">
                        <a href="kontakt.php" class="nav-link">Kontakt</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <form action="" class="form-inline d-none d-sm-block" action="blog.php">
                        <div class="form-group">
                            <input type="text" name="pretraga" placeholder="Pretraga" class="form-control mr-2">
                            <button class="btn nav-link " style="background:#373e40;font-family: 'Archivo Black';color:#b7d5d4;" name="pretrazi">Pretraži</button>
                        </div>

                    </form>
                </ul>
            </div>
    </nav>
    <div style="height: 5px;    background: rgb(255,193,7);
background: radial-gradient(circle, rgba(255,193,7,0.7960317916228992) 21%, rgba(183,213,212,1) 100%);   "></div>
</div>
<!--NAVBAR KRAJ-->