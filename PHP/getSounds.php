<?php
//PHP för att hämta ut ljud i användarens spellistor
//skapar kontakt mot databasen 
$servername = "localhost";
$username = "sigsto14";
$password = "ZW_6W5CiiC";
$dbname = "sigsto14_db";
$conn = mysqli_connect($servername, $username, $password, $dbname);
$mysqli = new mysqli("localhost","sigsto14","ZW_6W5CiiC","sigsto14_db");

//det inmatade listID't
$listID = $_POST['listID'];
//tomma variabler som skall fyllas på
$playlists = '';
$ADD = '';
$title = '';
$content = '';
//script som skall matas ut
$script = '<script type="text/javascript" src="http://ideweb2.hh.se/~sigsto14/Test/js/main.js"></script>';

if (!$conn) {
  //om ej kontakt med databas etableras
    die("Connection failed: " . mysqli_connect_error());
}

else {
  // gör en variabel som fylls på senare för att eco content
  $sounds = '';
  $soundsContent = '';
// en query för att hämta info ur databas (speciellt soundIDs)

  $playlistSoundsQ = <<<END
  SELECT * FROM playlists
  WHERE listID = '{$listID}'
END;
//kör queryn

$playlistSoundsG = $mysqli->query($playlistSoundsQ);
// kollar om vi får resultat tillbaka


if($playlistSoundsG->num_rows >0){
// om det finns resultat vi hämtar det
$playlist = $playlistSoundsG->fetch_object();
// gör dem till en array
 $listItems = array_values(explode(',',$playlist->soundIDs,13));
 // hämtar ut användare också
 $userID = $playlist->userID;
 $userQ = <<<END
SELECT * FROM users
WHERE userID = '{$userID}'
END;
// hämtar den
$userG = $mysqli->query($userQ);
$user = $userG->fetch_object();
  foreach($listItems as $listItem){
//hämtar ljud för var listitem
  $query2 = <<<END
  SELECT * FROM sounds
  WHERE soundID = '{$listItem}'
END;


$res2 = $mysqli->query($query2);
if($res2->num_rows > 0){
  //hämtar resultat ur query2
  //gör variabler som är relevanta
  $URLS = $res2->fetch_object(); 
  $title .= $URLS->title;
  //lägger till i en "array"
  $ADD .= $URLS->URL . ',';
}

}
// gör array av urlen till spellistan
 $URLS2 = array_values(explode(',',$ADD,13));
// kör en foreach loop för dem
 foreach($URLS2 as $PSOUND){

// query för att hämta ut title
  $titleQ = <<<END
SELECT * FROM sounds
WHERE URL = '$PSOUND'
END;

//hämtar 
$titleG = $mysqli->query($titleQ);
//vet att det är match i och med ^ tidigare test så behöver ej kolla detta
// hämtar object direkt

$title = $titleG->fetch_object();
// kollar så kanalID finns
if(!is_null($title)){
//query kanal
$channelQ = <<<END
SELECT * FROM channels
WHERE channelID = '{$title->channelID}'
END;
//hämtar kanal
$channelG = $mysqli->query($channelQ);
$channelname = $channelG->fetch_object();

}
// om inte finns
else {
$channelname ='Okänd kanal';
}
// box för feedback
$content .= '<div id="deleteFB"></div>';
if($listItems[0] == ''){
  $content = 'Inga poddar i denna spellista än!';
}
else {
//hämta användare för listan
        $cap = end($URLS2);
if($PSOUND == $URLS2[0]){
  //om spellistan tom
  if($URLS2[0] == ''){

  $content = 'Inga klipp i spellistan';
  }
  //om ej
  else {
    //första eresultat aktivt
  $title = utf8_encode($title->title);
$content .= '
<audio id="audio" class="audio" preload="none" tabindex="0" controls="" >
  <source src="' . $PSOUND . '">
  Your Fallback goes here
</audio></pre>
<ul id="playlist" class="playlist"><br>
  <li class="active">
            <a href="' . $PSOUND . '">'
            . $title . '
            </a><p>Kanal:' . $channelname->channelname . '</p>
        </li>';

}
}
else {
  if(is_null($title)){
    $title = '';
  }
  else{
    //fler resultat
      $title = utf8_encode($title->title);
  $content .= '<li id="notActive">
            <a href="' . $PSOUND . '">' . $title . '
            </a><p>Kanal:' . $channelname->channelname . '</p>
        </li>';
}

 }

}

}

}

//stänger ul element
$content .= '</ul></ul>';
//matar ut
echo $content;
echo $script;






}

?>