<?php

$servername = "localhost";
$username = "sigsto14";
$password = "ZW_6W5CiiC";
$dbname = "sigsto14_db";
$soundDelete = '';
$script = '<script type="text/javascript" src="http://ideweb2.hh.se/~sigsto14/Test/js/main.js"></script>';
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection

$mysqli = new mysqli("localhost","sigsto14","ZW_6W5CiiC","sigsto14_db");
$userID = $_POST['userID'];
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//om vi kommer åt databasen
else {
$userSoundQ = <<<END
SELECT * FROM sounds
WHERE channelID = '{$userID}'
END;
//hämtar infon
$userSoundG = $mysqli->query($userSoundQ);
//kollar om resultat
if($userSoundG->num_rows>0){
  //gör variabel om resultat
  $userSound = $userSoundG->fetch_object();
  //tom variabel som ska fyllas på
  $userSoundContent = '<div id="deleteFB"></div>';
//gör en utf encode för att kunna ha värde åäö på titel
  $title = utf8_encode($userSound->title);
  // en select för att ta bort ljud

  $soundDelete .= '<h3>Radera podcast</h3><form action="" name="deleteSound" method="post" id="deleteSound"><select class="selectorDelete" name="soundID" id="soundID"><option value="' . $userSound->soundID . '">' . $userSound->title . '</option>';
  //första värdet som hämtas ut active i playlist
    $userSoundContent .= '
<audio id="audio" class="audio" preload="auto" tabindex="0" controls="" >
  <source src="' . $userSound->URL . '">
  Your Fallback goes here
</audio></pre>
<ul id="playlist" class="playlist"><br>
  <li class="active"><div class="edit"></div>
            <a class="activateClick" href="' . $userSound->URL . '">'
            . $title . '
</a><p><em>Uppladdat:</em>' . $userSound->created_at . '<br>
            <em>Beskrivning:</em>' . $userSound->description . '<br>
            <em>Taggar:</em>' . $userSound->tag .'</p>


        </li><br>';
//while loop för de andra resultaten
        while($userSound = $userSoundG->fetch_object()){
  $title = utf8_encode($userSound->title);
$userSoundContent .= '<li id="notActive">
           <a class="activateClick" href="' . $userSound->URL . '">'
            . $title . '
            </a><p><em>Uppladdat:</em>' . $userSound->created_at . '<br>
            <em>Beskrivning:</em>' . $userSound->description . '<br>
            <em>Taggar:</em>' . $userSound->tag .'</p>

        </li><br>';
$soundDelete .= '<option value="' . $userSound->soundID . '">' . $userSound->title . '</option>';

        }

$soundDelete .= '</select><button type="submit" class="btn btn-danger">X</button></form><br>';
$userSoundContent .= '</ul>';

}
else {
  $userSoundContent = 'Du har inga klipp än. Ladda upp i fliken nedan';
}
echo $script;
echo $userSoundContent;
echo $soundDelete;
}
?>