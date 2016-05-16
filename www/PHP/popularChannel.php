<?php
//PHP för att hämta populär kanal
//koppling databas
$servername = "localhost";
$username = "sigsto14";
$password = "ZW_6W5CiiC";
$dbname = "sigsto14_db";
$conn = mysqli_connect($servername, $username, $password, $dbname);
$mysqli = new mysqli("localhost","sigsto14","ZW_6W5CiiC","sigsto14_db");

//variabler
//variabel för att välja playlist
$selectPL = '<select class="listID" id="listID"><option value="default">Välj spellista</option>';
//räknare för att knna capa resultat
$counter = 0;
//script som ska matas ut
$script = '<script type="text/javascript" src="http://ideweb2.hh.se/~sigsto14/Test/js/main4.js"></script>';
//inmatat användarnamn
$username = $_POST['username'];
//tomma som ska fyllas på sernare
$ADD = '';
$title = '';
$content = '';

if (!$conn) {
  //om kontakt ej etableras
    die("Connection failed: " . mysqli_connect_error());
}

else {
  //om vi kommer åt databas

  //hämtar ut spellista där user id är samma som userid där username är
$playlistsQ = <<<END
SELECT * FROM playlists
INNER JOIN users
ON users.userID = playlists.userID
WHERE users.username = '{$username}'
END;
//hämta playlists 
$playlistG = $mysqli->query($playlistsQ);
//om resultat
if($playlistG->num_rows > 0){
  //hämtar object
$playlists = $playlistG->fetch_object();
//lägger till första value som option i select
  $selectPL .= '<option value="' . $playlists->listID . '">' . $playlists->listTitle . '</option>';
//en loop för alla object
  while($playlists = $playlistG->fetch_object()){
    //lägger till i select
$selectPL .= '<option value="' . $playlists->listID . '">' . $playlists->listTitle . '</option>';
  }
  //stänger select
  $selectPL .= '</select>';
}

else {
  //om inga spellistor
  $selectPL = 'Du har inga spellistor än. Skapa under "Sparade spellistor"';
}

//query för o hämta populär kanal
$popChanQ = <<<END

SELECT *, COUNT(subscribe.channelID) AS occurances FROM subscribe INNER JOIN channels ON channels.channelID = subscribe.channelID GROUP BY subscribe.channelID ORDER BY occurances DESC LIMIT 1;
END;

//kör query
$popChanG = $mysqli->query($popChanQ);
//kollar resultat
if($popChanG->num_rows >0){
	//hämtar resultaten
$popChan = $popChanG->fetch_object();
//lägger till i popchan
$popChannel = '<h2>' . $popChan->channelname .'</h2><br><p>' . $popChan->information . '<br><h3>Podcasts:</h3><br>';
//gör query i sounds med channelID
$channelID = $popChan->channelID;
$chanSoundsQ = <<<END
SELECT * FROM sounds
WHERE channelID = '{$channelID}'
END;
//Hämtar ljuden
$chanSoundsG = $mysqli->query($chanSoundsQ);
if($chanSoundsG->num_rows >0){
	$chanSounds = $chanSoundsG->fetch_object();
$title = utf8_encode($chanSounds->title);
$desc = utf8_encode($chanSounds->description);
	$popChannel .= '
<audio id="audioPC" preload="none" tabindex="0" controls="" >
  <source src="' . $chanSounds->URL . '">
  Your Fallback goes here
</audio></pre>
<ul id="playlistPC"><br>
  <li class="active">
            <a href="' . $chanSounds->URL . '">'
            . $title . '
            </a><p>' . $desc . '</p>
 </li>'. $selectPL . '<button type="button" class="addTrigger btn-success">+</button><input type="hidden" id="soundID" name="soundID" class="soundID" value="' . $chanSounds->soundID . '"> ';

        //while med fler res 
        while($chanSounds = $chanSoundsG->fetch_object()){
        	$counter++;
        	if($counter < 5){
$title = utf8_encode($chanSounds->title);
$desc = utf8_encode($chanSounds->description);
        		$popChannel .='<li id="notActive">
            <a href="' . $chanSounds->URL . '">' . $title . '
            </a>
 <p>' . $desc . '</p></li>'. $selectPL . '<button type="button" class="addTrigger btn-success">+</button><input type="hidden" id="soundID" name="soundID" class="soundID" value="' . $chanSounds->soundID . '"> ';

        	}
        }
$popChannel .= '</ul>';
}

}
else {
  //om ej hittar något
	$popChannel = 'Ingen populär kanal';
}

//matar ut content
echo $popChannel;
echo $script;
}

?>