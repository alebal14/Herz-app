<?php
//skapar connection

$servername = "localhost";
$username = "sigsto14";
$password = "ZW_6W5CiiC";
$dbname = "sigsto14_db";
$conn = mysqli_connect($servername, $username, $password, $dbname);
$mysqli = new mysqli("localhost","sigsto14","ZW_6W5CiiC","sigsto14_db");

//variabel för inmatat id för pod
$soundID = $_POST['soundID'];

if (!$conn) {
	// om ej connection etableras
    die("Connection failed: " . mysqli_connect_error());
}
//om vi kommer åt databasen
else {
	//query för att ta bort ljudet
$sql = "DELETE FROM sounds WHERE soundID = '{$soundID}'";

if ($conn->query($sql) === TRUE) {
//om detta lyckas mata ut sant (kollar mot detta i ajax)
    echo "Sant";
} else {
	// om ej lyckas (kollar mot detta i ajax)
    echo "Någonting gick fel";
}
//stänger connection
$conn->close();

}
?>
