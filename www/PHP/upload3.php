<?php
$servername = "localhost";
$username = "sigsto14";
$password = "ZW_6W5CiiC";
$dbname = "sigsto14_db";


$conn = mysqli_connect($servername, $username, $password, $dbname);
//skapar connection

$mysqli = new mysqli("localhost","sigsto14","ZW_6W5CiiC","sigsto14_db");

$valid_extensions2 = array('mp3', 'ogg', 'wav', 'mpeg'); // vad som tillåts ljud

$path2 = 'sounds/';  // var de ska


if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
        move_uploaded_file($_FILES['file']['tmp_name'], 'sounds/' . $_FILES['file']['name']);
    }
?>