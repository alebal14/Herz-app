<?php

$servername = "localhost";
$username = "sigsto14";
$password = "ZW_6W5CiiC";
$dbname = "sigsto14_db";
$PLAYLISTIDS = '';
$divme = '';
$counter = 0;
$listIDs = '';

$script = '<script type="text/javascript" src="http://ideweb2.hh.se/~sigsto14/Test/js/playlist.js"></script>
';
$soundDelete = '';
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection

$mysqli = new mysqli("localhost","sigsto14","ZW_6W5CiiC","sigsto14_db");

//sätter variabel username
$userID = $_POST['userID'];

$playlistsContent = '<button id="OPENPLU" class="plist" type="submit">Skapa spellista<span class="caret"></span></button><button id="CLOSEPLU" class="plist hidden" type="submit">Skapa spellista
<span class="caret caret-reversed"></span></button><div id="PLU" class="hidden">
<form id="PL" action="" method="post" name="PL">
                   <input type="hidden" id="userID" name="userID" value="' . $userID . '">
                   <input type="hidden" id="links" name="links">
                    <p class="logintext">Spellistans titel:</p>
                    <input class="logininput" id="title" type="text" name="title" placeholder="Spellistans titel" />
                    <p class="logintext">Beskrivning:</p>
                    <input class="logininput" id="desc" type="text" name="desc" placeholder="Beskrivning" />
                
  <button type="submit">Skapa spellista</button>
 </form></div>';
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


else { 


// börjar med en query för att hämta ut playlists
$playlistsQ  = <<<END
SELECT * FROM playlists WHERE
userID = '{$userID}'

END;

// kör query mot db

$playlistG = $mysqli->query($playlistsQ);

//kollar om det får några resultat

if($playlistG->num_rows >0){
	// hämtar resultatraden
while($playlists = $playlistG->fetch_object()){
	$counter++;
	if($counter < 6){
	$listIDs .= $playlists->listID . ',';
}
$listItems = array_values(explode(',',$listIDs,13));
}
//kollar mot hur många resultat det är o gör olika formulär efter det
if($counter > 0){
$listID = $listItems[0];
	// hämtar ut listtitlen med hjälp av id't
	$listTitleQ = <<<END
	SELECT listTitle FROM playlists
	WHERE listID = '{$listID}'
END;
// hämtar resultatet (vi vet det finns eftersom det finns ett ID)
$listTitleG = $mysqli->query($listTitleQ);
$listTitle = $listTitleG->fetch_object();


$playlistsContent .=  '<form action="" method="post" id="playlist1"><input type="hidden" value="' . $listID . '" id="listID" name="listID">
<button id="OPEN" class="plist" type="button">' . $listTitle->listTitle . '<span class="caret"></span></button><button id="CLOSE" class="plist hidden" type="button">' . $listTitle->listTitle . '
<span class="caret caret-reversed"></span></button></form></div><div id="podcastbox1" class="hidden"><br><br><br></div>';
}

if($counter > 1){
$listID = $listItems[1];
	// hämtar ut listtitlen med hjälp av id't
	$listTitleQ = <<<END
	SELECT listTitle FROM playlists
	WHERE listID = '{$listID}'
END;
// hämtar resultatet (vi vet det finns eftersom det finns ett ID)
$listTitleG = $mysqli->query($listTitleQ);
$listTitle = $listTitleG->fetch_object();
$playlistsContent .=  ' <form action="" method="post" id="playlist2"><input type="hidden" value="' . $listID . '" id="listID2" name="listID2">
<button id="OPEN2" class="plist" type="button">' . $listTitle->listTitle . '<span class="caret"></span></button><button id="CLOSE2" class="plist hidden" type="button">' . $listTitle->listTitle . '
<span class="caret caret-reversed"></span></button></form><div id="podcastbox2" class="hidden"><br><br><br></div>';
}
if($counter > 2){
$listID = $listItems[2];
	// hämtar ut listtitlen med hjälp av id't
	$listTitleQ = <<<END
	SELECT listTitle FROM playlists
	WHERE listID = '{$listID}'
END;
// hämtar resultatet (vi vet det finns eftersom det finns ett ID)
$listTitleG = $mysqli->query($listTitleQ);
$listTitle = $listTitleG->fetch_object();
$playlistsContent .=  ' <form action="" method="post" id="playlist3"><input type="hidden" value="' . $listID . '" id="listID3" name="listID3">
<button id="OPEN3" class="plist" type="button">' . $listTitle->listTitle . '<span class="caret"></span></button><button id="CLOSE2" class="plist hidden" type="button">' . $listTitle->listTitle . '
<span class="caret caret-reversed"></span></button></form><div id="podcastbox3" class="hidden"><br><br><br></div>';
}
if($counter > 3){
$listID = $listItems[3];
	// hämtar ut listtitlen med hjälp av id't
	$listTitleQ = <<<END
	SELECT listTitle FROM playlists
	WHERE listID = '{$listID}'
END;
// hämtar resultatet (vi vet det finns eftersom det finns ett ID)
$listTitleG = $mysqli->query($listTitleQ);
$listTitle = $listTitleG->fetch_object();
$playlistsContent .=  ' <form action="" method="post" id="playlist4"><input type="hidden" value="' . $listID . '" id="listID4" name="listID4">
<button id="OPEN4" class="plist" type="button">' . $listTitle->listTitle . '<span class="caret"></span></button><button id="CLOSE4" class="plist hidden" type="button">' . $listTitle->listTitle . '
<span class="caret caret-reversed"></span></button></form><div id="podcastbox4" class="hidden"><br><br><br></div>';
}
if($counter > 4){
$listID = $listItems[4];
	// hämtar ut listtitlen med hjälp av id't
	$listTitleQ = <<<END
	SELECT listTitle FROM playlists
	WHERE listID = '{$listID}'
END;
// hämtar resultatet (vi vet det finns eftersom det finns ett ID)
$listTitleG = $mysqli->query($listTitleQ);
$listTitle = $listTitleG->fetch_object();
$playlistsContent .=  ' <form action="" method="post" id="playlist5"><input type="hidden" value="' . $listID . '" id="listID5" name="listID5">
<button id="OPEN5" class="plist" type="button">' . $listTitle->listTitle . '<span class="caret"></span></button><button id="CLOSE5" class="plist hidden" type="button">' . $listTitle->listTitle . '
<span class="caret caret-reversed"></span></button></form><div id="podcastbox5" class="hidden"><br><br><br></div>';
}
}
else {
	//om det inte finns något

}


echo $script;
echo $playlistsContent;
echo '</div>';


}

?>