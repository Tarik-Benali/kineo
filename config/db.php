<?php
$con = mysqli_connect("localhost","root","","virtuhos_kine");
if (mysqli_connect_errno())
  {
  echo "échec de connexion à MySQL: " . mysqli_connect_error();
  }
?>