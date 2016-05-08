<?php
$servername = "localhost";
$username = "sigsto14";
$password = "ZW_6W5CiiC";
$dbname = "sigsto14_db";
$PLAYLISTIDS = '';
$divme = '';
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection

$mysqli = new mysqli("localhost","sigsto14","ZW_6W5CiiC","sigsto14_db");

$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp'); // valid extensions
$valid_extensions2 = array('mp3', 'ogg', 'wav', 'mpeg');
$path = 'pictures/'; // upload directory
$path2 = 'sounds/'; 

if(isset($_FILES['image']))
{
 $img = $_FILES['image']['name'];
 $tmp = $_FILES['image']['tmp_name'];
  
 // get uploaded file's extension
 $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
 
 // can upload same image using rand function
 $final_image = rand(1000,1000000).$img;
 
 // check's valid format
 if(in_array($ext, $valid_extensions)) 
 {     
  $path = $path.strtolower($final_image); 
   
  if(move_uploaded_file($tmp,$path)) 
  {

   echo '<img src="http://ideweb2.hh.se/~sigsto14/Test/' . $path . '" style="width:40px; height 30px;" /> Bild uppladdad!';
   $imageLink = 'http://ideweb2.hh.se/~sigsto14/Test/' . $path;
  }
 } 
 else 
 {
  echo 'invalid file';
 }


}
if(isset($_FILES['audio']))
{
 $audio = $_FILES['audio']['name'];
 $tmp2 = $_FILES['audio']['tmp_name'];
  
 // get uploaded file's extension
 $ext2 = strtolower(pathinfo($audio, PATHINFO_EXTENSION));
 
 // can upload same image using rand function
 $final_audio = rand(1000,1000000).$audio;
 
 // check's valid format
 if(in_array($ext2, $valid_extensions2)) 
 {     
  $path2 = $path2.strtolower($final_audio); 
   
  if(move_uploaded_file($tmp2,$path2)) 
  {

   echo '<audio controls>
  <source src="http://ideweb2.hh.se/~sigsto14/Test/' . $path2 .'" type="audio/ogg">
  <source src="http://ideweb2.hh.se/~sigsto14/Test/' . $path2 .'" type="audio/mpeg">
Your browser does not support the audio element.
</audio> ';
$audioLink = 'http://ideweb2.hh.se/~sigsto14/Test/' . $path2;
  }


 } 
 else 
 {
  echo 'invalid file';
 }


}
?>