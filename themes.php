<?php
    include("auth/auth.php");
    include("includes/functions.php");

    if (isset($_SESSION['identifiant'])) {



                $identifiant  = $_SESSION["identifiant"];                                               

                getTheme($identifiant);

                $theme  = $_SESSION['theme'];

            if ($theme == ""){

                $_SESSION['theme']  = "bg";

                $theme              = $_SESSION['theme'];

            }                                     
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Virtuhos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles -->
    <script type="text/javascript" src="jquery/ajax-jquery-2.0.0.js"></script>

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/loader-style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">


    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/minus.png">

    <style>
    * {
      box-sizing: border-box;
    }

    .row > .column {
      padding: 0 8px;
    }

    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    .column {
      float: left;
      width: 25%;
      margin-bottom: 20px;
      padding-bottom: 2px;
    }

    /* The Modal (background) */
    .modal {
      display: none;
      position: fixed;
      padding-top: 20px;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: black;
    }

    /* Modal Content */
    .modal-content {
      position: relative;
      background-color: #fefefe;
      margin: auto;
      padding: 0;
      width: 100%;
      max-width: 55%;
    }

    /* The Close Button */
    .close {
      color: white;
      position: absolute;
      top: 10px;
      right: 25px;
      font-size: 35px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: #999;
      text-decoration: none;
      cursor: pointer;
    }

    .mySlides {
      display: none;
    }

    .cursor {
      cursor: pointer;
    }

    /* Next & previous buttons */
    .prev,
    .next {
      cursor: pointer;
      position: absolute;
      top: 50%;
      width: auto;
      padding: 16px;
      margin-top: -50px;
      color: white;
      font-weight: bold;
      font-size: 20px;
      transition: 0.6s ease;
      border-radius: 0 3px 3px 0;
      user-select: none;
      -webkit-user-select: none;
    }

    /* Position the "next button" to the right */
    .next {
      right: 0;
      border-radius: 3px 0 0 3px;
    }

    /* On hover, add a black background color with a little bit see-through */
    .prev:hover,
    .next:hover {
      background-color: rgba(0, 0, 0, 0.8);
    }

    /* Number text (1/3 etc) */
    .numbertext {
      color: #f2f2f2;
      font-size: 12px;
      padding: 8px 12px;
      position: absolute;
      top: 0;
    }

    img {
      margin-bottom: -4px;
    }

    .caption-container {
      text-align: center;
      background-color: black;
      padding: 2px 16px;
      color: white;
    }

    .demo {
      opacity: 0.6;
    }

    .active,
    .demo:hover {
      opacity: 1;
    }

    img.hover-shadow {
      transition: 0.3s;
    }

    .hover-shadow:hover {
      box-shadow: 0 20px 40px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    </style>
</head>



<?php include("fragmentsPages/bodyTheme.php"); ?>
    <!-- Preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!-- TOP NAVBAR -->
    <!-- TOP NAVBAR -->


    <?php include("fragmentsPages/barDeNavigation.php"); ?> 



    <!-- SIDE MENU -->
    <?php
        if (isset($_SESSION['idDeCeMedecin'])) {

            include("fragmentsPages/menuPrincipal.php");
        }
    ?> 

    


    <!--  PAPER WRAP -->
    <div class="wrap-fluid">
        <div class="container-fluid paper-wrap bevel tlbr">

 <!------------------------------------------------------ Titre de Page ------------------------------------------------------------------>



            <!-- CONTENT -->
            <!--TITLE -->
            <div class="row">
                <div id="paper-top">
                    <div class="col-sm-3">
                        <h2 class="tittle-content-header">
                            <span class="entypo-menu"></span>
                            <span><?php if(isset($idMedecin)) {echo "Dr, ";} echo $_SESSION['username'] ; ?>&nbsp;!
                            </span>
                        </h2>

                    </div>
                </div>
            </div>
            <!--/ TITLE -->

            <!-- BREADCRUMB -->
            <ul id="breadcrumb">
                <li>
                    <span class="entypo-home"></span>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Paramètres compte</a>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Thèmes</a>
                </li>
            </ul>

            <!-- END OF BREADCRUMB -->


        <div class="content-wrap">

                    <div class="col-sm-12">



                        <h2 style="text-align:center">Thèmes Virtuhos</h2>

                        <hr>

                        <br>

                        <div class="row">
                          <div class="column">
                            <img src="assets/img/bgmodal/bgtest1.png" style="width:100%" onclick="openModal();currentSlide(1)" class="hover-shadow cursor">
                          </div>
                          <div class="column">
                            <img src="assets/img/bgmodal/bgtest2.png" style="width:100%" onclick="openModal();currentSlide(2)" class="hover-shadow cursor">
                          </div>
                          <div class="column">
                            <img src="assets/img/bgmodal/bgtest3.png" style="width:100%" onclick="openModal();currentSlide(3)" class="hover-shadow cursor">
                          </div>
                          <div class="column">
                            <img src="assets/img/bgmodal/bgtest4.png" style="width:100%" onclick="openModal();currentSlide(4)" class="hover-shadow cursor">
                          </div>

                        </div>  

                        <div class="row">  
                          
                          <div class="column">
                            <img src="assets/img/bgmodal/bgtest5.png" style="width:100%" onclick="openModal();currentSlide(5)" class="hover-shadow cursor">
                          </div>
                          <div class="column">
                            <img src="assets/img/bgmodal/bgtest6.png" style="width:100%" onclick="openModal();currentSlide(6)" class="hover-shadow cursor">
                          </div>
                          <div class="column">
                            <img src="assets/img/bgmodal/bgtest7.png" style="width:100%" onclick="openModal();currentSlide(7)" class="hover-shadow cursor">
                          </div>
                          <div class="column">
                            <img src="assets/img/bgmodal/bgtest8.png" style="width:100%" onclick="openModal();currentSlide(8)" class="hover-shadow cursor">
                          </div>
                        </div>  

                        <div class="row">   
                          <div class="column">
                            <img src="assets/img/bgmodal/bgtest9.png" style="width:100%" onclick="openModal();currentSlide(9)" class="hover-shadow cursor">
                          </div>
                          <div class="column">
                            <img src="assets/img/bgmodal/bgtest10.png" style="width:100%" onclick="openModal();currentSlide(10)" class="hover-shadow cursor">
                          </div>
                          <div class="column">
                            <img src="assets/img/bgmodal/bgtest11.png" style="width:100%" onclick="openModal();currentSlide(11)" class="hover-shadow cursor">
                          </div>
                        </div>

 <!------------------------------------------------   Modal des thèmes -------------------------------------------------------------------->

                        <div id="myModal" class="modal">
                          <span class="close cursor" onclick="closeModal()">&times;</span>
                          <div class="modal-content">

                            <div class="mySlides">
                              <div class="numbertext">1 / 11</div>
                              <img src="assets/img/bgmodal/full_screen/bgtest1.jpg" style="width:100%">
                              <a href="<?php echo "fonctionnalites/mod/modTheme.php?id=".$identifiant."&theme=bgtest1" ?>">
                                  <button style="margin-left: 45%" class="btn btn-info">Selectionner</button>
                              </a> 
                            </div>

                            <div class="mySlides">
                              <div class="numbertext">2 / 11</div>
                              <img src="assets/img/bgmodal/full_screen/bgtest2.jpg" style="width:100%">
                              <a href="<?php echo "fonctionnalites/mod/modTheme.php?id=".$identifiant."&theme=bgtest2" ?>">   
                                <button style="margin-left: 45%" class="btn btn-info">Selectionner</button>
                              </a>  
                            </div>

                            <div class="mySlides">
                              <div class="numbertext">3 / 11</div>
                              <img src="assets/img/bgmodal/full_screen/bgtest3.jpg" style="width:100%">
                              <a href="<?php echo "fonctionnalites/mod/modTheme.php?id=".$identifiant."&theme=bgtest3" ?>">
                                <button style="margin-left: 45%" class="btn btn-info">Selectionner</button>
                              </a>  
                            </div>
                            
                            <div class="mySlides">
                              <div class="numbertext">4 / 11</div>
                              <img src="assets/img/bgmodal/full_screen/bgtest4.jpg" style="width:100%">
                              <a href="<?php echo "fonctionnalites/mod/modTheme.php?id=".$identifiant."&theme=bgtest4" ?>">
                                <button style="margin-left: 45%" class="btn btn-info">Selectionner</button>
                              </a>
                            </div>
                            
                            <div class="mySlides">
                              <div class="numbertext">5 / 11</div>
                              <img src="assets/img/bgmodal/full_screen/bgtest5.jpg" style="width:100%">
                              <a href="<?php echo "fonctionnalites/mod/modTheme.php?id=".$identifiant."&theme=bgtest5" ?>">
                                <button style="margin-left: 45%" class="btn btn-info">Selectionner</button>
                              </a>  
                            </div>

                            <div class="mySlides">
                              <div class="numbertext">6 / 11</div>
                              <img src="assets/img/bgmodal/full_screen/bgtest6.jpg" style="width:100%">
                              <a href="<?php echo "fonctionnalites/mod/modTheme.php?id=".$identifiant."&theme=bgtest6" ?>">
                                <button style="margin-left: 45%" class="btn btn-info">Selectionner</button>
                              </a>  
                            </div>

                            <div class="mySlides">
                              <div class="numbertext">7 / 11</div>
                              <img src="assets/img/bgmodal/full_screen/bgtest7.jpg" style="width:100%">
                              <a href="<?php echo "fonctionnalites/mod/modTheme.php?id=".$identifiant."&theme=bgtest7" ?>">
                                <button style="margin-left: 45%" class="btn btn-info">Selectionner</button>
                              </a>  
                            </div>
                            
                            <div class="mySlides">
                              <div class="numbertext">8 / 11</div>
                              <img src="assets/img/bgmodal/full_screen/bgtest8.jpg" style="width:100%">
                              <a href="<?php echo "fonctionnalites/mod/modTheme.php?id=".$identifiant."&theme=bgtest8" ?>">
                                <button style="margin-left: 45%" class="btn btn-info">Selectionner</button>
                              </a>  
                            </div>

                            <div class="mySlides">
                              <div class="numbertext">9 / 11</div>
                              <img src="assets/img/bgmodal/full_screen/bgtest9.jpg" style="width:100%">
                              <a href="<?php echo "fonctionnalites/mod/modTheme.php?id=".$identifiant."&theme=bgtest9" ?>">
                                <button style="margin-left: 45%" class="btn btn-info">Selectionner</button>
                              </a>  
                            </div>

                            <div class="mySlides">
                              <div class="numbertext">10 / 11</div>
                              <img src="assets/img/bgmodal/full_screen/bgtest10.jpg" style="width:100%">
                              <a href="<?php echo "fonctionnalites/mod/modTheme.php?id=".$identifiant."&theme=bgtest10" ?>">
                                <button style="margin-left: 45%" class="btn btn-info">Selectionner</button>
                              </a>  
                            </div>
                            
                            <div class="mySlides">
                              <div class="numbertext">11 / 11</div>
                              <img src="assets/img/bgmodal/full_screen/bgtest11.jpg" style="width:100%">
                              <a href="<?php echo "fonctionnalites/mod/modTheme.php?id=".$identifiant."&theme=bgtest11" ?>"> 
                                <button style="margin-left: 45%" class="btn btn-info">Selectionner</button>
                              </a>  
                            </div>
                            
                            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                            <a class="next" onclick="plusSlides(1)">&#10095;</a>

                            <div class="caption-container">
                              <p id="caption"></p>
                            </div>

                            <!------------------   Slider des thèmes ---------------------------------->


                            <div class="column">
                              <img class="demo cursor" src="assets/img/bgmodal/bgtest1.png" style="width:100%" onclick="currentSlide(1)">
                            </div>
                            <div class="column">
                              <img class="demo cursor" src="assets/img/bgmodal/bgtest2.png" style="width:100%" onclick="currentSlide(2)">
                            </div>
                            <div class="column">
                              <img class="demo cursor" src="assets/img/bgmodal/bgtest3.png" style="width:100%" onclick="currentSlide(3)">
                            </div>
                            <div class="column">
                              <img class="demo cursor" src="assets/img/bgmodal/bgtest4.png" style="width:100%" onclick="currentSlide(4)">
                            </div>
                            <div class="column">
                              <img class="demo cursor" src="assets/img/bgmodal/bgtest5.png" style="width:100%" onclick="currentSlide(5)">
                            </div>
                            <div class="column">
                              <img class="demo cursor" src="assets/img/bgmodal/bgtest6.png" style="width:100%" onclick="currentSlide(6)">
                            </div>
                            <div class="column">
                              <img class="demo cursor" src="assets/img/bgmodal/bgtest7.png" style="width:100%" onclick="currentSlide(7)">
                            </div>
                            <div class="column">
                              <img class="demo cursor" src="assets/img/bgmodal/bgtest8.png" style="width:100%" onclick="currentSlide(8)">
                            </div>
                            <div class="column">
                              <img class="demo cursor" src="assets/img/bgmodal/bgtest9.png" style="width:100%" onclick="currentSlide(9)">
                            </div>
                            <div class="column">
                              <img class="demo cursor" src="assets/img/bgmodal/bgtest10.png" style="width:100%" onclick="currentSlide(10)">
                            </div>
                            <div class="column">
                              <img class="demo cursor" src="assets/img/bgmodal/bgtest11.png" style="width:100%" onclick="currentSlide(11)">

                            </div>
                          </div>

                    </div>
            </div>
           


            <!-- /END OF CONTENT -->

            <!-- FOOTER -->
       
            <?php include("fragmentsPages/footer.php"); ?>

            <!-- / END OF FOOTER -->


        </div>
    </div>
    <!--  END OF PAPER WRAP -->

    <!-- RIGHT SLIDER CONTENT -->

    <?php include("fragmentsPages/menuSecondaire.php"); ?>


    <!-- END OF RIGHT SLIDER CONTENT-->


    <!-- MAIN EFFECT -->
    <script type="text/javascript" src="assets/js/preloader.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/app.js"></script>
    <script type="text/javascript" src="assets/js/load.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>








    <!-- /MAIN EFFECT -->
    <!-- GAGE -->
    <script type="text/javascript" src="assets/js/toggle_close.js"></script>






    <script>
        function openModal() {
          document.getElementById("myModal").style.display = "block";
        }

        function closeModal() {
          document.getElementById("myModal").style.display = "none";
        }

        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
          showSlides(slideIndex += n);
        }

        function currentSlide(n) {
          showSlides(slideIndex = n);
        }

        function showSlides(n) {
          var i;
          var slides = document.getElementsByClassName("mySlides");
          var dots = document.getElementsByClassName("demo");
          var captionText = document.getElementById("caption");
          if (n > slides.length) {slideIndex = 1}
          if (n < 1) {slideIndex = slides.length}
          for (i = 0; i < slides.length; i++) {
              slides[i].style.display = "none";
          }
          for (i = 0; i < dots.length; i++) {
              dots[i].className = dots[i].className.replace(" active", "");
          }
          slides[slideIndex-1].style.display = "block";
          dots[slideIndex-1].className += " active";
          captionText.innerHTML = dots[slideIndex-1].alt;
        }
        </script>

</body>

</html>
<?php
}
else
{
header('location: login.php');
}

?>