<?php
$servername = "localhost";
$username = "sigsto14";
$password = "ZW_6W5CiiC";
$dbname = "sigsto14_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection

$mysqli = new mysqli("localhost","sigsto14","ZW_6W5CiiC","sigsto14_db");


$title = $_POST['title'];
$userID = $_POST['userID'];
$desc = $_POST['desc'];

$content = '';
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else {
$sql = "INSERT INTO playlists (listTitle, listDescription, userID)
VALUES ('{$title}', '{$desc}', '{$userID}')";


if (mysqli_query($conn, $sql)) {
   session_start();

echo 'Spellista uppdaterad';
	
		
}
else {
    exit(json_encode('fail'));
}
}


?>