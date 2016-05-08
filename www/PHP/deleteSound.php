<?php


$servername = "localhost";
$username = "sigsto14";
$password = "ZW_6W5CiiC";
$dbname = "sigsto14_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection

$mysqli = new mysqli("localhost","sigsto14","ZW_6W5CiiC","sigsto14_db");

$soundID = $_POST['soundID'];



if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//om vi kommer åt databasen
else {
$sql = "DELETE FROM sounds WHERE soundID = '{$soundID}'";

if ($conn->query($sql) === TRUE) {

    echo "Sant";
} else {
    echo "Någonting gick fel";
}

$conn->close();

}
?>
