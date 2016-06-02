<?php
//MAIN PHP SIDA
//DENNA SIDA HÄMTAR OCH MATAR UT INFORMATION
//DENNA SIDA INNEHÅLLER HTML STRUKTUR

//skapar connection mot databas
$servername = "localhost";
$username = "sigsto14";
$password = "ZW_6W5CiiC";
$dbname = "sigsto14_db";
$conn = mysqli_connect($servername, $username, $password, $dbname);
$mysqli = new mysqli("localhost","sigsto14","ZW_6W5CiiC","sigsto14_db");

//sätter variabel username
$username = $_POST['username'];
//tomma variabler som skall fyllas på
$PLAYLISTIDS = '';
$divme = '';
$soundDelete = '';
$SelectCategory = '';
//script som ska matas ut
$script = '<script type="text/javascript" src="http://ideweb2.hh.se/~sigsto14/Test/js/search.js"></script>    <script src="http://ideweb2.hh.se/~sigsto14/Test/js/deviceCheck.js" type="text/javascript"></script>
    <script src="http://ideweb2.hh.se/~sigsto14/Test/js/mediaHandlers.js" type="text/javascript"></script>';
//toppen av html-sidan

echo '<div class="myProfile">
    <center><h3><a href="#" id="profi">' . $username . '</a>
      </div>
';

if (!$conn) {
  //om databaskoppling ej etableras
    die("Connection failed: " . mysqli_connect_error());
}

//om vi kommer åt databasen
else {

// variabel som hämtar ut userID från databasen (Q för query)
$userIDQ = <<<END
SELECT * FROM  users WHERE
username = '{$username}'
END;
// kör queryn mot db (G för get)

$userIDG = $mysqli->query($userIDQ);
// kollar om det får några resultat
if($userIDG->num_rows >0){
// hämtar objectet som hittats
	$user = $userIDG->fetch_object();
	// sätter ett userID som ska använda för att söka
$userID = $user->userID;

// om det inte går att komma åt databasen
}
// nu när vi har userID kan skapa ett formulär för att hämta spellistor
$playlistStart ='<div id="container"><div id="searchBox"></div><button type="submit" id="openDisc" class="menu3">
Upptäck<span class="caret"></span><button type="submit" id="closeDisc" 
class="menu3 hidden">Upptäck<span class="caret caret-reversed"></span></button><div id="discBox" class="hidden">
<button id="openNew" class="plist2" type="submit">Nytt<span class="caret"></span></button><button id="closeNew" class="plist2 hidden" type="submit">Nytt
<span class="caret caret-reversed"></span></button><div id="newBox" class="hidden"></div>
<button id="openPop" class="plist2" type="submit">Populärt<span class="caret"></span></button><button id="closePop" class="plist2 hidden" type="submit">Populärt
<span class="caret caret-reversed"></span></button><div id="popBox" class="hidden"></div>
<button id="openPopchan" class="plist2" type="submit">Veckans kanal<span class="caret"></span></button><button id="closePopchan" class="plist2 hidden" type="submit">Veckans kanal
<span class="caret caret-reversed"></span></button><div id="popchanBox" class="hidden"></div>
</div>
<button type="submit" id="openProf" class="menu">
Mina spellistor<span class="caret"></span><button type="submit" id="closeProf" class="menu hidden">Sparade spellistor<span class="caret caret-reversed"></span></button>
<div id="profBox" class="hidden">';

//matar ut innehållet
echo $playlistStart;
echo '</div>';

//query för att hämta ut kanal (om användaren har en kanal)

$channelQ = <<<END
SELECT * FROM channels WHERE
channelID = '{$userID}'

END;

// kör query mot db

$channelG = $mysqli->query($channelQ);
//kollar om resultat

if($channelG->num_rows > 0){
// hämtar data om resultat
	$channel = $channelG->fetch_object();
// matar ut data av resultaten
	//starta echo mot kanal

echo '<button type="submit" id="openChan" class="menu2">
Min kanal<span class="caret"></span><button type="submit" id="closeChan" class="menu2 hidden">Min kanal<span class="caret caret-reversed"></span></button>
<div id="chanBox" class="hidden">';
// knapp box information om kanal
$minKanal = '<button id="openInfo" class="plist2" type="submit">Information<span class="caret"></span></button><button id="closeInfo" class="plist2 hidden" type="submit">Information
<span class="caret caret-reversed"></span></button><div id="infoBox" class="hidden"><img src="http://ideweb2.hh.se/~sigsto14/Test/pictures/default.png" style="width:100%;"><h2>' . $channel->channelname . '</h2><br><p>Beskrivning:' . $channel->information . '</p></div>

';
// knapp o box visar "mina klipp"
//använder channelvariabel för att hämta ut ljud
$channelID = $channel->channelID;
//startar med query

$minaKlipp = '<form action="" method="post" id="mySounds"><input type="hidden" name="userID" id="userID" value="' . $channelID . '">
<button type="submit" id="openSound" class="plist2 soundB">Mina klipp<span class="caret"></span></button></form><button type="submit" id="closeSound" class="plist2 hidden soundB">Mina klipp
<span class="caret caret-reversed"></span></button><div id="usersoundBox" class="hidden"></div>';
//query för att hämta kategorier 
$categoriesQ = <<<END
SELECT * FROM category
END;
$categoriesG = $mysqli->query($categoriesQ);
//kollar så finns 
if($categoriesG->num_rows >0){
  //hämtar om det finns
  $categories = $categoriesG->fetch_object();
  //lägger till i select-variabel
$SelectCategory = '<select id="category"><option selected>Välj kategori!</option><option value="' .$categories->categoryID .'">'. $categories->categoryname . '</option>';
//while loop för att hämta fler resultat
while($categories = $categoriesG->fetch_object()){
//lägger in fler resultat i variabel
  $SelectCategory .= '<option value="' .$categories->categoryID .'">'. $categories->categoryname . '</option>';
}
//stänger selectinput
$SelectCategory .= '</select>';
}
else {
  //om det inte finns några kategorier
  $SelectCategory = 'Finns inga kategorier';
}

//knapp, box funktion att ladda upp filer
//denna knapp öppnar att ladda upp filer
//formulär för uppladdning
//knappar som startar funktioner för att spela in nytt ljud
$upload = '<button id="openUpload" class="plist2" type="submit">Ladda upp<span class="caret"></span></button><button id="closeUpload" class="plist2 hidden" type="submit">Ladda upp
<span class="caret caret-reversed"></span></button><div id="uploadBox" class="hidden"><div id="suc"></div><form id="upload" action="ajaxupload.php" method="post" enctype="multipart/form-data">
                   <input type="hidden" id="username" name="username" value="' . $username . '">
                   <input type="hidden" id="links" name="links">
                    <p class="logintext">Titel:</p>
                                      <input class="logininput" id="titel" type="text" name="titel" placeholder="Titel" />
                    <p class="logintext">Beskrivning:</p>
                    <input class="logininput" id="desc" type="text" name="desc" placeholder="Beskrivning" />
                    <p class="logintext">Taggar:</p> 
                    <input class="logininput" id="tag" type="text" name="tag" placeholder="Taggar" />
<p class="logintext">Välj kategori:</p>  ' . $SelectCategory . '
                    	<p class="logintext">Podcastens ljud:</p>
  <div id="audioFile"><input id="uploadAudio" type="file" name="audio" class="inputfile" /></div><label id="audLabel" for="uploadAudio">Välj ljud</label><a id="rec"><label>Spela in</label></a>
  <div id="recBox" class="hidden"><img id="startRecID" src="http://ideweb2.hh.se/~sigsto14/Test/img/mick.png" onclick="startRecording()" style="width: 100px; height:auto;" class="linkRec"></img>   
                <div style="text-align:center">
                    <a id="stopRecID" style="display:none" onclick="stopRecording()" class="button red" type="button">Stoppa inspelning</a>
   <p id="RecStatusID" style="text-align:center"></p>
                <div style="text-align:center">
                    <h2>Listen</h2>
               <div class="buttons">
                        <img src="http://ideweb2.hh.se/~sigsto14/Test/img/play.png" id="startPlayID" onclick="playMusic()" class="button blue" style="width: 50px; height:auto;">
                        <img src="http://ideweb2.hh.se/~sigsto14/Test/img/pause.png" id="pausePlayID" onclick="pauseMusic()" class="button blue" style="width: 50px; height:auto;">
                        <img src="http://ideweb2.hh.se/~sigsto14/Test/img/stop.png" id="stopPlayID" onclick="stopMusic()" class="button red" style="width: 50px; height:auto;">
                 </div>
                </div>
            </div></div>
                    <p class="logintext">Podcastens bild:</p>
<input id="uploadImage" type="file" accept="image/*" name="image" class="inputfile" /><label id="imgLabel" for="uploadImage">Välj bild</label>
<br>
  <button type="button" id="UPLOAD" >Ladda upp</button>
 </form>
 </div>
';

//matar ut content
echo $minKanal;
echo $minaKlipp;
echo $upload;

echo '</div>';

}
else {
  //om användaren ej har en kanal
	echo '<button type="submit" id="openChan" class="menu2">
Min kanal<span class="caret"></span><button type="submit" id="closeChan" class="menu2 hidden">Min kanal<span class="caret caret-reversed"></span></button><div id="infoBox" class="hidden">Du har ingen kanal än, skapa en <a href="#"> här </a></div>';
}

echo '</div>';
//mata ut script
echo $script;

}




?>