<?php
// Include the database configuration file
include("includes/functions.php");
if (isset($_SESSION['idDeCeCabinet'])) {

    $nomCabinet       = $_SESSION['nomDeCeCabinet'];

    
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = crypterNomDeLaBase($nomCabinet);
// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


$statusMsg = '';
$backlink = ' <a href="./">Go back</a>';
// File upload path
$targetDir = "uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
if(isset($_POST["file"])){
    // Allow certain file formats
    echo "Rah kayen";
}else{
    echo "rah makanch";
}
if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if (!file_exists($targetFilePath)) {
        if(in_array($fileType, $allowTypes)){
                // Upload file to server
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                // Insert image file name into database
                $insert = $db->query("INSERT into enteteOrd (nom, dateDajout) VALUES ('".$fileName."', NOW())");
                if($insert){
                    $statusMsg = "The file <b>".$fileName. "</b> has been uploaded successfully." . $backlink;
                }else{
                    $statusMsg = "File upload failed, please try again." . $backlink;
                } 
            }else{
                $statusMsg = "Sorry, there was an error uploading your file." . $backlink;
            }
        }else{
            $statusMsg = "Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload." . $backlink;
        }
    }else{
            $statusMsg = "The file <b>".$fileName. "</b> is already exist." . $backlink;
        }
}else{
    $statusMsg = 'Please select a file to upload.' . $backlink;
}
// Display status message
echo $statusMsg;

}
?>