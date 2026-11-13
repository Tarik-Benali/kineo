<?php
  
  include("../auth/auth.php");
  include("../includes/functions.php");

  global $con;

  $link = $con;

  $nomPatient 	= "";
  $agePatient 	= "";
  $prenomPatient = "";

  if(isset($_SESSION['idDeCeMedecin'])){

  		  $ceCabinet = $_SESSION['nomDeCeCabinet'];
          $medecin = $_SESSION['username'];
          $idMedecin = $_SESSION['idDeCeMedecin'];
        }
        $ceMoment = date("Y-m-d H:i:s");
        $aujourdh = date("d-m-Y");


        if (isset($_REQUEST['idCons'])) {

			$idCons = $_REQUEST['idCons'];
			$MotifC = $_REQUEST['motif'];

			switch ($MotifC) {
			  case 'consultation':

			  	insertionOrdonnance($ceCabinet, $idMedecin, $ceMoment, "0", $idCons, "2");	
				break;

			  case 'orientation':

				//insertConsOrienta($ceCabinet, $idCons, $idPatient****, $idRendezvous**, $idMedecin, "", $ceMoment, "orientation");
				insertionOrdonnance($ceCabinet, $idMedecin, $ceMoment, "0", $idCons, "2");
				break;	
			}

		 }
		 elseif (!isset($_REQUEST['idCons'])){
		  	
		  	$idCons = date("YmdHis");
		  	insertionOrdonnance($ceCabinet, $idMedecin, $ceMoment, "0", $idCons, "2");
		  }

		  if ($_REQUEST['nom'] || $_REQUEST['age'] || $_REQUEST['prenom']) {

		    $nomPatient 	= mysqli_real_escape_string($link, $_REQUEST['nom']);
		    $agePatient 	= mysqli_real_escape_string($link, $_REQUEST['age']);
		    $prenomPatient 	= mysqli_real_escape_string($link, $_REQUEST['prenom']);
	     }

     //------------------------------------------------------ Impression Lettre d'orientation  -----------------------------------------------
?>
<html>
<style type="text/css">	
	p.impact {
	  font-family: Impact, Charcoal, serif;
	}
</style>
<body onload="window.print()">

<hr style="border: 1px black solid; margin-top: -10px">
 <div style="display: flex; flex-wrap: nowrap; justify-content: space-between; margin-top: -8px;margin-bottom: -18px;">
 	
	<div  style="margin-top: -8px;">
		<!--	Il faut changer le nom aussi dans le popup des consultations du jour chemin: -->	
		<?php echo "<img src='impression/ord/entete/virtuhos_mono_cabinet.PNG'/>"; ?>
		
	</div>

	<div style="margin-top: 50px">
		<p style="font-family:  'Times New Roman', Times,serif; font-size: 14px;">
			<?php echo "<b>Nom:</b>    &nbsp;&nbsp;&nbsp;" 							. $nomPatient;		?> 	<br> 
			<?php echo "<b>Prenom:</b> " 											. $prenomPatient;	?> 	<br>
			<?php echo "<b>Age:</b>    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" 	. $agePatient;		?>	<br>
			<?php echo "<b>Le: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> " 	. $aujourdh;		?>		</p>
			
	</div>

</div> 
<hr style="border: 1px black solid;">
<br>
<center><h1 style="color:black; font-family:serif;">Lettre d'Orientation</h1></center>

<br><br><br><br><br>


<div style="display: flex; flex-wrap: nowrap;">
<?php 

if (isset($_REQUEST["lettre"])){

    $rapport  = mysqli_real_escape_string($link, $_REQUEST['lettre']);
    $rapport  = str_replace("\\r\\n","<br>",$rapport);

		 
			 	echo "<div style=\"padding-left:5%;\">";	

				 	echo "<p style=\"color:black; font-family:serif; font-size: 1.275em;\">";

				 	  $rapport  = str_replace("\'","'",$rapport);
				      echo $rapport; 

				    echo "</p>";

			    echo "</div>";	     
			
	mysqli_close($link);
	}
	
?>
</div>



</body>
</html>