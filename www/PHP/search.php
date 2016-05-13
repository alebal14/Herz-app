<?php
$servername = "localhost";
$username = "sigsto14";
$password = "ZW_6W5CiiC";
$dbname = "sigsto14_db";
$content = '<button type="submit" class="close" id="closeSearch">X</button><h1>Sökresultat:</h1>';
$selectPL = '<select class="listID" id="listID"><option value="default">Välj spellista</option>';
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
$script = '<script type="text/javascript" src="http://ideweb2.hh.se/~sigsto14/Test/js/main5.js"></script>';
$mysqli = new mysqli("localhost","sigsto14","ZW_6W5CiiC","sigsto14_db");


$search = $_POST['search'];
$username = $_POST['username'];

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


else {

//hämta spellistor för att kunna lägga till sökresultat i dem

$playlistsQ = <<<END
SELECT * FROM playlists
INNER JOIN users
ON users.userID = playlists.userID
WHERE users.username = '{$username}'
END;
//hämta playlists 
$playlistG = $mysqli->query($playlistsQ);
if($playlistG->num_rows > 0){
$playlists = $playlistG->fetch_object();

  $selectPL .= '<option value="' . $playlists->listID . '">' . $playlists->listTitle . '</option>';

  while($playlists = $playlistG->fetch_object()){
$selectPL .= '<option value="' . $playlists->listID . '">' . $playlists->listTitle . '</option>';
  }
  $selectPL .= '</select>';
}

else {
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
if($searchG->num_rows >0){
    $row = $searchG->fetch_object(); 
$channelIDS = $row->channelID;
$channelIDQ = <<<END
SELECT * FROM channels
WHERE channelID = '{$channelIDS}'
END;
$channelIDG = $mysqli->query($channelIDQ);
$channel = $channelIDG->fetch_object();
$channelname = utf8_encode($channel->channelname);
  $title = utf8_encode($row->title);
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
        </li>'. $selectPL . '<button type="button" class="addTriggerS btn-success">+</button><input type="hidden" id="soundID" name="soundID" class="soundID" value="' . $row->soundID . '"> ';;
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
        </li>'. $selectPL . '<button type="button" class="addTriggerS btn-success">+</button><input type="hidden" id="soundID" name="soundID" class="soundID" value="' . $row->soundID . '"> ';;
}

}
else {
  $content .= '<h3 style="color:red;">Inga klipp matchade din sökning</h3>';
  }

echo $script;
$content .= '</ul>';
echo $content;


}
?>