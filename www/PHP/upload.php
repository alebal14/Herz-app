<?php
$servername = "localhost";
$username = "sigsto14";
$password = "ZW_6W5CiiC";
$dbname = "sigsto14_db";


$conn = mysqli_connect($servername, $username, $password, $dbname);
//skapar connection

$mysqli = new mysqli("localhost","sigsto14","ZW_6W5CiiC","sigsto14_db");

$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp'); // vad som tillåts bild
$valid_extensions2 = array('mp3', 'ogg', 'wav', 'mpeg'); // vad som tillåts ljud
$path = 'pictures/'; // var de ska
$path2 = 'sounds/';  // var de ska




if(isset($_FILES['image']))
{
 $img = $_FILES['image']['name'];
 $tmp = $_FILES['image']['tmp_name'];
  
 // hämta file extension
 $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
 
 // kan inte ladda upp samma filer twice
 $final_image = rand(1000,1000000).$img;
 
 // kollar valid format
 if(in_array($ext, $valid_extensions)) 
 {     
  $path = $path.strtolower($final_image); 
   
  if(move_uploaded_file($tmp,$path)) 
  {

   $imageLink = 'http://ideweb2.hh.se/~sigsto14/Test/' . $path;

  }
 } 
 else 
 {
  $imageLink = '';
  $error = 'invalid file';
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

$audioLink = 'http://ideweb2.hh.se/~sigsto14/Test/' . $path2;
  }


 } 
 else 
 {
  $audioLink = '';
  $error = 'invalid file';
 }
if(!isset($_FILES['audio']) || (!isset($_FILES['image']))) {
echo $error;
}
else {
echo $audioLink . ',' . $imageLink;
}


}
?>