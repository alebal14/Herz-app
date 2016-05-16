 $(function()
{
//device ready funktion, copy paste CORDOVA, plugin, open source :) För att kunna spela in i appen.
        function onDeviceReady() {
           if( window.Cordova && navigator.splashscreen ) {     // Cordova API detected
                navigator.splashscreen.hide();                 // hide splash screen
            }       
            document.getElementById("PhonegapVerID").innerHTML += device.cordova;
            console.log("onDeviceReady: " + document.getElementById("PhonegapVerID").innerHTML);

            console.log("*** phoneCheck.android: " + phoneCheck.android);
            console.log("*** phoneCheck.ios: " + phoneCheck.ios);

            // set initial button state
            setButtonState(myMediaState.start);

            // check if an existing media file already exist and reset button state
            checkMediaRecFileExist();
        }
        document.addEventListener("deviceready", onDeviceReady, false);

//här börjar originell kod

//login funktion (formulär index.html)
//1/2 html sidor
//html direkt inlästa i appen
//resten av html från server


$('#login').submit(function(e){
            e.preventDefault();
            //inlogg submit sätter variabler av input
    var username = $('#username').val();
    var username = $.trim(username);
    var password = $('#password').val();
    var password = $.trim(password);
    if(username=='')
    {
      //feedback om man ej matat in användarnamn
        $('.error').html('<div class="alert alert-danger">Skriv i användarnamn</div>');
        return false;
    }
    else if(password =='')
    {
      //feedback om man ej matat in password
        $('.error').html('<div class="alert alert-danger">Skriv in lösenord</div>');
        return false;
    }
    else
    {
      //återdefinierar variabler (mest för säkerhets skull ;)
        var username = $('#username').val();
        var password = $('#password').val();
        //skickar med ajax till php, med variablerna

        $.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://ideweb2.hh.se/~sigsto14/Test/login.php',
  data: { username: username, password: password},  
        dataType: 'text',
 beforeSend: function() {
  //beforesend ajax funktion visar en fin loading gif som visar att det laddar

        $('#loading').removeClass('hidden');
    },
   success: function(data){
            if(data == 'true') {  
              // om man är inloggad
              //här börjar allvaret
              //majoriteten av content läses in i denna success function

//om inloggad skall sökfältet ej längre vara gömt så tar bort klassen
   $('#search').removeClass('hidden');
   //läser in profil i container
                 $('.container').load('profil.html');
                 //sätter användarnamn i  logged in meny
      $('#loggedIn').html(username);
      //åter definierar username och lösen
       var username = $('#username').val();
       var password = $('#password').val();
//skickar användarnamnet till get profile med ajax
                  $.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://ideweb2.hh.se/~sigsto14/Test/getProfile.php',  
        data: { username: username},
        dataType: 'text',

   success: function(data){
//matar ut datan i get profile i div
        $('#profile').html(data);

//här följer en lång radda med öppna och stänga boxar
//vissa har också att det triggas (dess funkction i annat script)
//för att ta bort html (och pausa ljudet)
//ändrar klasser för span caret (alltså pilen ska vara rätt)
//ändrar klasser för vissa stänger o vissa öppnar boxar


  $('#closeProf').click(function(e){
e.preventDefault();
$('#CLOSE').trigger('click');
$('#CLOSE2').trigger('click');
$('#CLOSE3').trigger('click');
$('#CLOSE4').trigger('click');
$('#CLOSE5').trigger('click');
$('#profBox').toggleClass('hidden');
$('#closeProf').toggleClass('hidden');
$('#openProf').toggleClass('hidden');
 });
  //öppna stäng profil
    $('#openProf').click(function(e){
e.preventDefault();
$('#profBox').toggleClass('hidden');

$('#closeProf').toggleClass('hidden');
$('#openProf').toggleClass('hidden');
    });

      
//öppna stäng kanal
    $('#closeChan').click(function(e){
e.preventDefault();
$('#chanBox').toggleClass('hidden');
$('#closeChan').toggleClass('hidden');
$('#openChan').toggleClass('hidden');
    });
    $('#openChan').click(function(e){
e.preventDefault();
$('#chanBox').toggleClass('hidden');
$('#closeChan').toggleClass('hidden');
$('#openChan').toggleClass('hidden');
    });
//öppna o stäng kanalinfo
        $('#openInfo').click(function(e){
e.preventDefault();
$('#infoBox').toggleClass('hidden');
$('#openInfo').toggleClass('hidden');
$('#closeInfo').toggleClass('hidden');
    });

        $('#closeInfo').click(function(e){
e.preventDefault();
$('#infoBox').toggleClass('hidden');
$('#closeInfo').toggleClass('hidden');
$('#openInfo').toggleClass('hidden');
    });
//öppna o stäng ladda upp
                $('#openUpload').click(function(e){
e.preventDefault();

//öppnar inspelning 
$('#rec').click(function(e){
  e.preventDefault();
$('#recBox').toggleClass('hidden');
});
$('#uploadBox').toggleClass('hidden');
$('#openUpload').toggleClass('hidden');
$('#closeUpload').toggleClass('hidden');
    });

        $('#closeUpload').click(function(e){
e.preventDefault();
$('#uploadBox').toggleClass('hidden');
$('#closeUpload').toggleClass('hidden');
$('#openUpload').toggleClass('hidden');
    });
//öppna o stäng upptäck
          $('#openDisc').click(function(e){
e.preventDefault();

$('#discBox').toggleClass('hidden');
$('#openDisc').toggleClass('hidden');
$('#closeDisc').toggleClass('hidden');

});
  //öppna o stäng nya uppladdningar
   $('#openNew').click(function(e){
e.preventDefault();

$('#newBox').toggleClass('hidden');
$('#openNew').toggleClass('hidden');
$('#closeNew').toggleClass('hidden');
//definierar username igen
var username = $('#username').val();
  $.ajax({
//skickar username när nya uppladdningar hämtas ut
//för att kunna hämta playlists

        type: 'POST',
        crossDomain: true,
        url: 'http://ideweb2.hh.se/~sigsto14/Test/newUploads.php',  
        data: {username: username },
        dataType: 'text',
      beforeSend: function() {
        //loadinggif feedback när laddar
        $('#newBox').html('<center><img id="loading" src="http://ideweb2.hh.se/~sigsto14/Test/img/loading2.gif"></center>');
    },
   success: function(data){
    //matar ut data
   $('#newBox').html(data);
    },
   error: function() {}
    });
  });
//stänger nya uppladdningar
        $('#closeNew').click(function(e){
e.preventDefault();
$('#newBox').toggleClass('hidden');

$('#closeNew').toggleClass('hidden');
$('#openNew').toggleClass('hidden');
    });
//öppnar populärt
         $('#openPop').click(function(e){
e.preventDefault();
//pausar audio
audio[0].pause();
$('#popBox').toggleClass('hidden');
$('#openPop').toggleClass('hidden');
$('#closePop').toggleClass('hidden');
//redifinierar username variable
   var username = $('#username').val();
  $.ajax({
//skickar med username i hämtandet av populära ljud
//för att kunna hämta användarens playlists
        type: 'POST',
        crossDomain: true,
        url: 'http://ideweb2.hh.se/~sigsto14/Test/popularSounds.php',  
        data: {username: username },
        dataType: 'text',
       beforeSend: function() {
        //feedback
        $('#popBox').html('<center><img id="loading" src="http://ideweb2.hh.se/~sigsto14/Test/img/loading2.gif"></center>');
    },
   success: function(data){
    //visar data
   $('#popBox').html(data);
    },
   error: function() {}
    });
  });
//stänger populära
        $('#closePop').click(function(e){
e.preventDefault();
//pausar audio
audio[0].pause();
$('#popBox').toggleClass('hidden');
$('#closePop').toggleClass('hidden');
$('#openPop').toggleClass('hidden');
    });

        //öppnar veckans kanal
       $('#openPopchan').click(function(e){
e.preventDefault();

$('#popchanBox').toggleClass('hidden');
$('#openPopchan').toggleClass('hidden');
$('#closePopchan').toggleClass('hidden');

   $.ajax({
//skickar med username
        type: 'POST',
        crossDomain: true,
        url: 'http://ideweb2.hh.se/~sigsto14/Test/popularChannel.php',  
        data: {username: username },
        dataType: 'text',
       beforeSend: function() {
        //feedback
        $('#popchanBox').html('<center><img id="loading" src="http://ideweb2.hh.se/~sigsto14/Test/img/loading2.gif"></center>');
    },
   success: function(data){
    //utdata
   $('#popchanBox').html(data);

//lägga till i spellista
//addtrigger add knapp
$('.addTrigger').click(function(e){
e.preventDefault();
//definierar värden
var soundID = $(this).next('.soundID').val();
var listID =  $(this).prev().find('option:selected').val(); 
//om ej vald lista
if(listID == 'default'){
  alert('Välj lista!');
}
else {
  //om vald lista skickar med ajax
 $.ajax({

        type: 'POST',
        crossDomain: true,
        url: 'http://ideweb2.hh.se/~sigsto14/Test/addToPlaylist.php',  
        data: {soundID: soundID, listID: listID},
        dataType: 'text',
      
   success: function(data){ 
    //matar ut res
    alert(data);
  },
   error: function() {}
 });
}
});

    },
   error: function() {}
    });
  });
//stäng veckans kanal
        $('#closePopchan').click(function(e){
e.preventDefault();
//pausa ljud
audio[0].pause();
$('#popchanBox').toggleClass('hidden');
$('#closePopchan').toggleClass('hidden');
$('#openPopchan').toggleClass('hidden');
    });


//stäng upptäck     
   $('#closeDisc').click(function(e){
e.preventDefault();
$('#discBox').toggleClass('hidden');
$('#closeDisc').toggleClass('hidden');
$('#openDisc').toggleClass('hidden');
    });
       
  //öppna profil funktion
$('#openProf').click(function(e){
 e.preventDefault();
 //skicka med userID för att hämta spellistor genom ajax
var userID = $('#userID').val();

        $.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://ideweb2.hh.se/~sigsto14/Test/getPlaylists.php',  
        data: { userID: userID},
        dataType: 'text',
       beforeSend: function() {
        //feedback
        $('#profBox').html('<center><img id="loading" src="http://ideweb2.hh.se/~sigsto14/Test/img/loading2.gif"></center>');
    },
   success: function(data){
    //data
    $('#profBox').html(data);
 },
 error: function(){

 }}); 
});

  //öppna stäng ljud

 //användarens ljud
        $('#mySounds').submit(function(e){
 e.preventDefault();

 $('#usersoundBox').toggleClass('hidden');

$('#closeSound').toggleClass('hidden');
$('#openSound').toggleClass('hidden');
//skickar med userID
    var userID = $('#userID').val();
        $.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://ideweb2.hh.se/~sigsto14/Test/getMySounds.php',  
        data: { userID: userID},
        dataType: 'text',
       beforeSend: function() {
        //feedback
        $('#usersoundBox').html('<center><img id="loading" src="http://ideweb2.hh.se/~sigsto14/Test/img/loading2.gif"></center>');
    },
   success: function(data){
 //data
 $('#usersoundBox').html(data);
//stänger boxen
        $('#closeSound').click(function(){
      $('#usersoundBox').html('');
      $('#closeSound').toggleClass('hidden');
$('#openSound').toggleClass('hidden');

    });
//radera ljud submit
    
$('#deleteSound').submit(function(e){
e.preventDefault();
//soundIDvariabel
var soundID = $('#soundID').val();

$.ajax({
    type: 'POST',
    crossDomain: true,
    url: 'http://ideweb2.hh.se/~sigsto14/Test/deleteSound.php',
    data: { soundID: soundID},
    dataType: 'text',
 beforeSend: function() {
  //feedback
        $('#deleteFB').html('<center><img id="loading" src="http://ideweb2.hh.se/~sigsto14/Test/img/loading2.gif"></center>');
    },
    success: function(data){
      //feedback om success
      $('#deleteFB').html('<div class="alert alert-success">Pod raderad!</div>')
    },
    error: function(){
      //feedback om fail
 $('#deleteFB').html('<div class="alert alert-danger">Något gick fel, försök igen</div>')
    }
});
  });
        },
        error: function(){
          //om något går fel i att öppna sina ljud
             $('#usersoundBox').html('<div class="alert alert-danger">Någonting gick fel. Prova att logga ut och in igen</div>');
        }
   
    });
 });
 
 },
        error: function(){
             alert(data);
        }
    });
 }
     else {
      //om inlogg faila
         $('.error').html('<div class="alert alert-danger">Fel användarnamn eller lösenord</div>');
        return false;
     }
        },
        error: function(){
             alert(data);
        }
    });
 return true;
    }
});
});



