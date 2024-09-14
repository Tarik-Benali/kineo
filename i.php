<?php
  
  include("auth/auth.php");
  include("includes/functions.php");

  $ceCabinet = $_SESSION['nomDeCeCabinet'];
  if(isset($_SESSION['idDeCeMedecin'])){
          $medecin = $_SESSION['username'];
          $idMedecin = $_SESSION['idDeCeMedecin'];
        }
        $ceMoment = date("Y-m-d H:i:s");
        $aujourdh = date("d-m-Y");



	global $con;

	$link = $con;
/*
	$nomPatient 	= mysqli_real_escape_string($link, $_REQUEST['nom']);
    $agePatient 	= mysqli_real_escape_string($link, $_REQUEST['age']);
    $prenomPatient 	= mysqli_real_escape_string($link, $_REQUEST['prenom']);*/

    $nomPatient 	= "BENALI AMAR";
    $agePatient 	= "28";
    $prenomPatient 	= "Tarik";


     //------------------------------------------------------ Impression ordanance ----------------------------------------------------------
?>
<html>
<style type="text/css">	
	p.impact {
	  font-family: Impact, Charcoal, serif;
	}
</style>


<body onload="window.print(); window.close();" >
	<!--	Il faut changer le nom aussi dans le popup des consultations du jour chemin: -->


<hr style="border: 1px black solid; margin-top: -10px">
 <div style="display: flex; flex-wrap: nowrap; justify-content: space-between; margin-top: -8px;margin-bottom: -18px;">
 	
	<div  style="margin-top: -8px;">
			
		<?php echo "<img src='impression/ord/entete/virtuhos_mono_cabinet.PNG'/>"; ?>
		
	</div>

	<div style="margin-top: 50px">
		<p style="font-family:  'Times New Roman', Times,serif; font-size: 14px;">
			<?php echo "<b>Nom:</b>    &nbsp;&nbsp;&nbsp;" . $nomPatient;?> <br> 
			<?php echo "<b>Prenom:</b> " . $prenomPatient;		?> 						<br>
			<?php echo "<b>Age:</b>    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $agePatient . " ans";?><br>
			<?php echo "<b>Le: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> " . $aujourdh;?>				</p>
			
	</div>

</div> 
<hr style="border: 1px black solid;">

<center><h1 style="color:black; font-family:serif;">Ordonnance</h1></center>

<br><br><br>

	
<?php 


	//$number = count($_POST["medic"]);
/*
	if (isset($_REQUEST['idCons'])) {

		$idCons = $_REQUEST['idCons'];
		$MotifC = $_REQUEST['motif'];

		switch ($MotifC) {
		  case 'consultation':

		  	insertionOrdonnance($ceCabinet, $idMedecin, $ceMoment, $number, $idCons, "1");	
			break;

		  case 'renouvellement':

			//insertConsRenouvOrd($ceCabinet, $idCons, $idPatient****, $idRendezvous**, $idMedecin, "", $ceMoment, "Renouvellement Ordonnance");
			insertionOrdonnance($ceCabinet, $idMedecin, $ceMoment, $number, $idCons, "1");
			break;	
		}

	 }
	 elseif (!isset($_REQUEST['idCons'])){
	  	
	  	$idCons = date("YmdHis");
	  	insertionOrdonnance($ceCabinet, $idMedecin, $ceMoment, $number, $idCons, "1");
	  }

*/ 
  
	
	    
	 	echo "<div style=\"display: flex; flex-wrap: nowrap; justify-content: space-between;\">


			 	<div style=\"margin-left: 50px; color:black;\">

			      		<p style=\"color:black; font-family:serif;\">

			      			Test Médicament
					    </p>&nbsp;
				        <br>

				        <p style=\"color:black; font-family:serif;\">

			      			Test Médicament
					    </p>&nbsp;
				        <br>


				        <p style=\"color:black; font-family:serif;\">

			      			Test Médicament
					    </p>&nbsp;
				        <br>

				        <p style=\"color:black; font-family:serif;\">

			      			Test Médicament
					    </p>&nbsp;
				        <br>

				        <p style=\"color:black; font-family:serif;\">

			      			Test Médicament
					    </p>&nbsp;
				        <br>

				        <p style=\"color:black; font-family:serif;\">

			      			Test Médicament
					    </p>&nbsp;
				        <br>


				        <p style=\"color:black; font-family:serif;\">

			      			Test Médicament
					    </p>&nbsp;
				        <br>

				        <p style=\"color:black; font-family:serif;\">

			      			Test Médicament
					    </p>&nbsp;
				        <br>

	      		</div>


	        	<div>

			        <p style=\"color:black; font-family:serif;\">
			        	1000mg 
			        </p>
			        <br>


					<p style=\"color:black; font-family:serif;\">
			        	1000mg 
			        </p>
			        <br>

			        <p style=\"color:black; font-family:serif;\">
			        	1000mg 
			        </p>
			        <br>


			        <p style=\"color:black; font-family:serif;\">
			        	1000mg 
			        </p>
			        <br>

			        <p style=\"color:black; font-family:serif;\">
			        	1000mg 
			        </p>
			        <br>


					<p style=\"color:black; font-family:serif;\">
			        	1000mg 
			        </p>
			        <br>

			        <p style=\"color:black; font-family:serif;\">
			        	1000mg 
			        </p>
			        <br>


			        <p style=\"color:black; font-family:serif;\">
			        	1000mg 
			        </p>
			        <br>

	        	</div>


	        	<div style=\"margin-right: 30px;\">

	        			<p style=\"color:black; font-family:serif;\"> 

		        			1/2 par jour.

		        		</p>

		        		<br>

		        		<p style=\"color:black; font-family:serif;\"> 

		        			1/2 par jour.

		        		</p>

		        		<br>

		        		<p style=\"color:black; font-family:serif;\"> 

		        			1/2 par jour.

		        		</p>

		        		<br>

		        		<p style=\"color:black; font-family:serif;\"> 

		        			1/2 par jour.

		        		</p>

		        		<br>

		        		<p style=\"color:black; font-family:serif;\"> 

		        			1/2 par jour.

		        		</p>

		        		<br>

		        		<p style=\"color:black; font-family:serif;\"> 

		        			1/2 par jour.

		        		</p>

		        		<br>

		        		<p style=\"color:black; font-family:serif;\"> 

		        			1/2 par jour.

		        		</p>

		        		<br>

		        		<p style=\"color:black; font-family:serif;\"> 

		        			1/2 par jour.

		        		</p>

		        		<br>

		        </div>";

	        

	             
	    echo "</div>";
	          
?>





</body>
</html>
