<?php
//PHP för att skapa spellista

//skapa connection med databas
$servername = "localhost";
$username = "sigsto14";
$password = "ZW_6W5CiiC";
$dbname = "sigsto14_db";
$conn = mysqli_connect($servername, $username, $password, $dbname);
$mysqli = new mysqli("localhost","sigsto14","ZW_6W5CiiC","sigsto14_db");

//variabler om inmatning
$title = $_POST['title'];
$userID = $_POST['userID'];
$desc = $_POST['desc'];

$content = '';
if (!$conn) {
	//om ej kontakt med databas etableras
    die("Connection failed: " . mysqli_connect_error());
}
else {
	//insertquery
$sql = "INSERT INTO playlists (listTitle, listDescription, userID)
VALUES ('{$title}', '{$desc}', '{$userID}')";


if (mysqli_query($conn, $sql)) {
   //om insert lyckats echo ut

echo 'Spellista uppdaterad';
	
		
}
else {
	//om ej lyckat echo ut
    exit(json_encode('fail'));
}
}


?>