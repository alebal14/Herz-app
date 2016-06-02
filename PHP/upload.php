<?php
//php för att ladda upp filer på servern

//kopplar mot databas (ej egentligen nödvändigt?)
$servername = "localhost";
$username = "sigsto14";
$password = "ZW_6W5CiiC";
$dbname = "sigsto14_db";
$conn = mysqli_connect($servername, $username, $password, $dbname);
$mysqli = new mysqli("localhost","sigsto14","ZW_6W5CiiC","sigsto14_db");


//variabler

$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp'); // vad som tillåts bild
$valid_extensions2 = array('mp3', 'ogg', 'wav', 'mpeg'); // vad som tillåts ljud
$path = 'pictures/'; // vart de ska
$path2 = 'sounds/';  // vart de ska




if(isset($_FILES['image']))
{
  //om image inmatat
 $img = $_FILES['image']['name'];
 $tmp = $_FILES['image']['tmp_name'];
  
 // hämta file extension
 $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
 
 // kan inte ladda upp samma filer twice
 $final_image = rand(1000,1000000).$img;
 
 // kollar valid format
 if(in_array($ext, $valid_extensions)) 
 {     
  //lägger till path
  $path = $path.strtolower($final_image); 
   
  if(move_uploaded_file($tmp,$path)) 
  {
    //gör variabel av pathen med filnamnet

   $imageLink = 'http://ideweb2.hh.se/~sigsto14/Test/' . $path;

  }
 } 
 else 
 {
  //om det ej går
  $imageLink = '';
  $error = 'invalid file';
 }


}
if(isset($_FILES['audio']))
{
  //om ljud inmatat
 $audio = $_FILES['audio']['name'];
 $tmp2 = $_FILES['audio']['tmp_name'];
  
//hämtar extension
 $ext2 = strtolower(pathinfo($audio, PATHINFO_EXTENSION));
 

 $final_audio = rand(1000,1000000).$audio;
 
 // kollar valid format
 if(in_array($ext2, $valid_extensions2)) 
 {     
  //sätter path
  $path2 = $path2.strtolower($final_audio); 
   
  if(move_uploaded_file($tmp2,$path2)) 
  {
    //gör variabel av absolute path

$audioLink = 'http://ideweb2.hh.se/~sigsto14/Test/' . $path2;
  }

 } 
 else 
 {
  //om ej går
  $audioLink = '';
  $error = 'invalid file';
 }
if(!isset($_FILES['audio']) || (!isset($_FILES['image']))) {
  // om ej inmatat
echo $error;
}
else {
  //om det gått att ladda upp echo länkarna
echo $audioLink . ',' . $imageLink;
}


}
?>