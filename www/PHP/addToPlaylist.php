<?php
$servername = "localhost";
$username = "sigsto14";
$password = "ZW_6W5CiiC";
$dbname = "sigsto14_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection

$mysqli = new mysqli("localhost","sigsto14","ZW_6W5CiiC","sigsto14_db");
$listID = $_POST['listID'];
$soundID = $_POST['soundID'];

$counter = 0;
$script = '<script type="text/javascript" src="http://ideweb2.hh.se/~sigsto14/Test/js/main.js"></script>';
$content = '';
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


else { 
//först hitta spellistan som menas o hämta ut den
	$playlistQ = <<<END
SELECT * FROM playlists
WHERE listID = '{$listID}'
END;
// kör queryn 
$playlistG = $mysqli->query($playlistQ);
//kollar om finns res
if($playlistG->num_rows > 0){
	//om finns res
	//hämtar object
	$playlist = $playlistG->fetch_object();
	//vi behöver specifikt soundIDS, hämtar ut.
	$soundIDS = $playlist->soundIDs;
	if($soundIDS == ''){
		$newValue = $soundIDS . $soundID;
	}
	else {
	$newValue = $soundIDS . ', ' . $soundID;
}
//query för att uppdatera
	$sql = <<<END
UPDATE playlists
SET soundIDs = '{$newValue}'
WHERE listID = '{$listID}'
END;
if (mysqli_query($conn, $sql)) {
	echo 'japp';
	}
	else {
		echo 'napp';
	}
}
}

?>