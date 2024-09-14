<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "cabinetmedical");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
//$first_name = mysqli_real_escape_string($link, $_REQUEST['first_name']);
//$last_name = mysqli_real_escape_string($link, $_REQUEST['last_name']);
$name = mysqli_real_escape_string($link, $_REQUEST['name']);
$prenom = mysqli_real_escape_string($link, $_REQUEST['prenom']);
$email = mysqli_real_escape_string($link, $_REQUEST['email']);
$phone = mysqli_real_escape_string($link, $_REQUEST['phone']);
$date = mysqli_real_escape_string($link, $_REQUEST['date']);
$heure = mysqli_real_escape_string($link, $_REQUEST['heure']);
$doc = mysqli_real_escape_string($link, $_REQUEST['doc']);
 
// Attempt insert query execution
$sql = "INSERT INTO rdv (nomP,prenoP,mail,tel,dateRDV,heureRDV,medecin) VALUES ('$name','$prenom','$email','$phone','$date','$heure','$doc')"; 
if(mysqli_query($link, $sql)){
    //echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>