<?php
//PHP för sökfunktion

//kopplar mot databas
$servername = "localhost";
$username = "sigsto14";
$password = "ZW_6W5CiiC";
$dbname = "sigsto14_db";
$conn = mysqli_connect($servername, $username, $password, $dbname);
$mysqli = new mysqli("localhost","sigsto14","ZW_6W5CiiC","sigsto14_db");


//variabler
//script som ska matas ut
$script = '<script type="text/javascript" src="http://ideweb2.hh.se/~sigsto14/Test/js/main5.js"></script>';
// content (start)
$content = '<button type="submit" class="close" id="closeSearch">X</button><div id="searchFB"></div><h1>Sökresultat:</h1>';
//select för spellista
$selectPL = '<select class="listID" id="listID"><option value="default">Välj spellista</option>';

//variabler för inmatat
//vad användare sökt
$search = $_POST['search'];
//användarnamn
$username = $_POST['username'];

if (!$conn) {
  //om kontakt mot databas ej etableras
    die("Connection failed: " . mysqli_connect_error());
}


else {
//om vi kommer åt databas
//hämta spellistor för att kunna lägga till sökresultat i dem

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


// kollar efter klipp som matchar sökningen i databasen
$searchQ = <<<END
SELECT * FROM  sounds WHERE
soundID = '{$search}' OR
title LIKE '%{$search}%'
END;
// hämtar
$searchG = $mysqli->query($searchQ);

$nr = mysqli_num_rows($searchG);

//om det finns resultat
if($searchG->num_rows >0){
  //hämtar object
    $row = $searchG->fetch_object(); 
    //hämtar kanalid från funnet ljud
$channelIDS = $row->channelID;
//hämtar ut kanal med kanalid
$channelIDQ = <<<END
SELECT * FROM channels
WHERE channelID = '{$channelIDS}'
END;
$channelIDG = $mysqli->query($channelIDQ);
$channel = $channelIDG->fetch_object();
//encodar resultat
$channelname = utf8_encode($channel->channelname);
  $title = utf8_encode($row->title);
  //matar ut som spellista i content
    $content .= '
<audio id="audioS" preload="auto" tabindex="0" controls="" >
  <source src="' . $row->URL . '">
  Your Fallback goes here
</audio></pre>
<ul id="playlistS"><br>
  <li class="active">
            <a href="' . $row->URL . '">'
            . $title . '
            </a><p>Kanal:' . $channelname . '</p>
        </li>'. $selectPL . '<button type="button" class="addTriggerS btn-success">+</button><input type="hidden" id="soundID" name="soundID" class="soundID" value="' . $row->soundID . '"> ';
        //en while loop för fler resultat
while($row = $searchG->fetch_object()){
  $channelIDS = $row->channelID;
$channelIDQ = <<<END
SELECT * FROM channels
WHERE channelID = '{$channelIDS}'
END;
$channelIDG = $mysqli->query($channelIDQ);
$channel = $channelIDG->fetch_object();
$channelname = utf8_encode($channel->channelname);
  $title = utf8_encode($row->title);
  $content .= '<li id="notActive">
            <a href="' . $row->URL . '">' . $title . '
            </a><p>Kanal:' . $channelname . '</p>
        </li>'. $selectPL . '<button type="button" class="addTriggerS btn-success">+</button><input type="hidden" id="soundID" name="soundID" class="soundID" value="' . $row->soundID . '"> ';
}

}
else {
  //om inget matchar
  $content .= '<h3 style="color:red;">Inga klipp matchade din sökning</h3>';
  }
//echo content
echo $script;
$content .= '</ul>';
echo $content;


}
?>