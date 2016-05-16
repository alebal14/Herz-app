<?php
//sida för lägga till pod i spellista

//skapa connection till databas
$servername = "localhost";
$username = "sigsto14";
$password = "ZW_6W5CiiC";
$dbname = "sigsto14_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$mysqli = new mysqli("localhost","sigsto14","ZW_6W5CiiC","sigsto14_db");
//script som ska med i utmatning
$script = '<script type="text/javascript" src="http://ideweb2.hh.se/~sigsto14/Test/js/main.js"></script>';
//inmatat listID
$listID = $_POST['listID'];
//inmatat podID
$soundID = $_POST['soundID'];
//tom innehållsvariabel som skall fyllas på
$content = '';
//counter för att räkna resultat i loop, börjar på 0
$counter = 0;
if (!$conn) {
	// om kontakt ej etableras
    die("Connection failed: " . mysqli_connect_error());
}
//variabler



//om kontakt mot databas etableras
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
//om quern utförts (uppdatering skett)
if (mysqli_query($conn, $sql)) {
	//hämta info om ljud o lista
$infoQ = <<<END
SELECT * FROM sounds, playlists
WHERE sounds.soundID = '{$soundID}'
AND playlists.listID = '{$listID}'
END;

$infoG = $mysqli->query($infoQ);
if($infoG->num_rows > 0){
	//om resultat
	//hämtar resultat
$info = $infoG->fetch_object();
//lägger till i content (feedback)
$content = utf8_encode($info->title) . ' tillagd i ' . $info->listTitle;
}
else {
//om ej lyckades
	$content = 'Något gick fel, försök igen';
}
//mata ut content
	echo $content;
	}
	else {
		// om ej lyckades mata ut (kollar mot detta i ajax)
		echo 'napp';
	}
}
}

?>