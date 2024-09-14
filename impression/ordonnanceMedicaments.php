<?php
  
  include("../auth/auth.php");
  include("../includes/functions.php");

  $nomPatient 	= "";
  $agePatient 	= "";
  $prenomPatient = "";

  $ceCabinet = $_SESSION['nomDeCeCabinet'];
  if(isset($_SESSION['idDeCeMedecin'])){
          $medecin = $_SESSION['username'];
          $idMedecin = $_SESSION['idDeCeMedecin'];
        }
        $ceMoment = date("Y-m-d H:i:s");
        $aujourdh = date("d-m-Y");


 if (!empty($_REQUEST["medic"])){

	global $con;

	$link = $con;

	$nomPatient 	= mysqli_real_escape_string($link, $_REQUEST['nom']);
    $agePatient 	= mysqli_real_escape_string($link, $_REQUEST['age']);
    $prenomPatient 	= mysqli_real_escape_string($link, $_REQUEST['prenom']);


     //------------------------------------------------------ Impression ordanance ----------------------------------------------------------
?>
<html>
<style type="text/css">	
	p.impact {
	  font-family: Impact, Charcoal, serif;
	}
</style>


<body onload="window.print(); window.close();" >

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

<center><h1 style="color:black; font-family:serif;">Ordonnance</h1></center>

<br><br><br>

	
<?php 
if($link === false){  die("ERROR: Could not connect. " . mysqli_connect_error()); }



	$number = count($_POST["medic"]);

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

	 
  
	 if($number > 0)  
	 {  
	    
	 	echo "<div style=\"display: flex; flex-wrap: nowrap; justify-content: space-between;\">"; 

	      	echo "<div style=\"margin-left: 50px; color:black;\">";

	      		for($i=0; $i<$number; $i++)  
			      { 

			      			if(trim($_POST["medic"][$i] != ''))  
					           { 

					           	echo "<p style=\"color:black; font-family:serif;\">";

					           	$nomMedic = $_POST["medic"][$i]; 
				           		
				           		print_r($_POST["medic"][$i]);

				           		$dozDeCeMedic = $_POST["doz"][$i];

				           		$freqDeCeMedi = $_POST["freq"][$i];

				                echo "</p>&nbsp; ";

				                echo "<br>";
					                                  
					           }   
					relationMedicConsul($ceCabinet, $idCons, $nomMedic, $dozDeCeMedic, $freqDeCeMedi);        
			      }
	      	echo "</div>";


	        echo "<div>";

	        for($i=0; $i<$number; $i++)  
		      { 		        

				        if(trim($_POST["medic"][$i] != ''))  
				           { 

				           	echo "<p style=\"color:black; font-family:serif;\">";

				           		print_r($_POST["doz"][$i]);
		                	
		                	echo "</p>";

		                	echo "<br>";
				                                  
				           }           
		      }
	        echo "</div>";


	        echo "<div>";

	        for($i=0; $i<$number; $i++)  
			      { 
				      	if(trim($_POST["medic"][$i] != ''))  
					           { 

					           	echo "<p style=\"color:black; font-family:serif;\">";

					           		print_r($_POST["freq"][$i]);

					           	echo "</p>";

					           	echo "<br>";

					           	$indice = $i + 1;          	
					                                  
					           }           
			      }
	        echo "</div>";

	        echo "<div>";


	        for($i=0; $i<$number; $i++)  
			      { 
				      	if(trim($_POST["medic"][$i] != ''))  
					           {

					           	$qttB = $_POST["qtt"][$i];

					           	if ($qttB =="") {

					           		$qttB ="1";

					           	}
					           	echo "<p style=\"color:black; font-family:serif;\">Qt: ";

					           		print_r($qttB);

					           	echo "</p>";

					           	echo "<br>";

					           	$indice = $i + 1;          	
					                                  
					           }           
			      }
	        echo "</div>";

	        

	             
	    echo "</div>";
	          
	 }  
	 else  
	 {  
	      echo "Aucun examen";  
	 }

mysqli_close($link);
}
?>

</body>
</html>
