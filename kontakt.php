
    <!-- NAVBAR -->
    <?php include("javninavbar.php"); ?>
<title>Kontakt </title>
    <!-- NAVBAR KRAJ -->


    <div class="container mb-3 mt-3 rounded" style="  background: rgb(183,213,212);
background: radial-gradient(circle, rgba(183,213,212,0.7035948168329832) 21%, rgba(55,62,64,1) 100%); ">
        <div class="row">
            <!--MAIN AREA START-->
            <div class="col-sm-8 mt-2">
                <!-- KONTAKT FORMA -->
                <!--Section: Contact v.2-->
                <div class="card rounded mt-3 px-3" style="background:rgba(183,213,212,80%);">
<section class="mb-4">

    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4" style="font-family: 'Archivo Black',sans-serif;color:#373e40;text-shadow: 0 0 2px white, 0 0 2px white, 0 0 2px white, 0 0 2px white;">Kontaktirajte nas</h2>
    <!--Section description-->
    <hr>
    <div class="row">  
        

        <!--Grid column-->
        <div class="col-md-9 mb-md-0 mb-5 px-4 text-center">
            <form id="contact-form" name="contact-form" action="mail.php" method="POST">

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0 ">
                            <input type="text" id="name" name="ime" class="form-control" placeholder="Unesite ime">
                            <label for="name" class="text-muted">Vaše ime</label>
                        </div>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <input type="text" id="email" name="email" class="form-control" placeholder="Unesite email">
                            <label for="email" class="text-muted">Email</label>
                        </div>
                    </div>

                    <!--Grid column-->

                </div>
                <br>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <input type="text" id="subject" name="naslov" class="form-control" placeholder="Unesite naslov">
                            <label for="subject" class="text-muted">Naslov</label>
                        </div>
                    </div>
                </div>
                <br>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-12">

                        <div class="md-form">
                            <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea" placeholder="Unesite poruku"></textarea>
                            <label for="message" class="text-muted">Vaša poruka</label>
                        </div>

                    </div>
                </div>
                <!--Grid row-->

            </form>

            <div class="text-center text-md-left">
                <a class="btn " style="background:steelblue;font-family:'Archivo Black',sans-serif;float:right;color:rgb(183,213,212)">Pošalji</a>
            </div>

            <div class="status"></div>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-3 text-center text-muted">
            <ul class="list-unstyled mb-0">
                <b>
                <li><i class="fas fa-map-marker-alt fa-2x" style="color:steelblue;text-shadow: 0 0 5px white, 0 0 5px white, 0 0 5px white, 0 0 5px white;font-size:60px;"></i>
                    <p>Niš, 18000, Srbija</p>
                </li>

                <li><i class="fas fa-phone mt-4 fa-2x" style="color:#305252;text-shadow: 0 0 5px white, 0 0 5px white, 0 0 5px white, 0 0 5px white;font-size:60px;"></i>
                    <p>+381 61 232323</p>
                </li>

                <li><i class="fas fa-envelope mt-4 fa-2x" style="color:gold;text-shadow: 0 0 5px white, 0 0 5px white, 0 0 5px white, 0 0 5px white;font-size:60px;"></i>
                    <p>bloggie@gmail.com</p>
                </li>
</b>
            </ul>
        </div>
        <!--Grid column-->
        
    </div>
    <hr>
    <div class="text-center w-responsive mx-auto" style="color:#373e40">
     <b> Da li imate nekih pitanja? Nemojte se ustručavati da pitate. Naš tim će vam se obratiti u najkraćem mogućem roku !</b>
    </div>

            <div class="card-body text-center">
            
                <a href="https://www.instagram.com"><i class="fab fa-instagram" style=" color:#8a3ab9; font-size:80px;text-shadow: 0 0 3px white, 0 0 3px white, 0 0 3px white, 0 0 3px white;"></i></a>&nbsp; &nbsp; &nbsp; &nbsp;
                <a href="https://www.facebook.com"><i class="fab fa-facebook-square" style=" color:#4267B2; font-size:80px;text-shadow: 0 0 3px white, 0 0 3px white, 0 0 3px white, 0 0 3px white;"></i></a>&nbsp; &nbsp; &nbsp; &nbsp;
                <a href="https://www.twitter.com"><i class="fab fa-twitter" style="color:#1DA1F2; font-size:80px;text-shadow: 0 0 3px white, 0 0 3px white, 0 0 3px white, 0 0 3px white;"></i></a>
                </div>

</section>
<!--Section: Contact v.2-->
                </div>
                <!-- KONTAKT FORMA KRAJ -->

            </div>

            <!--SIDE AREA START-->
            <?php include("sidearea.php"); ?>
            <!--SIDE AREA KRAJ-->
            



        </div>

    </div>
    <!-- FOOTER -->
    <?php include("futer.php"); ?>
    <!-- FOOTER KRAJ -->


</body>

</html>