 $(function()
{
 
$('#login').submit(function(e){
            e.preventDefault();
    var username = $('#username').val();
    var username = $.trim(username);
    var password = $('#password').val();
    var password = $.trim(password);
    if(username=='')
    {
        $('.error').html('<div class="alert alert-danger">Skriv i användarnamn</div>');
        return false;
    }
    else if(password =='')
    {
        $('.error').html('<div class="alert alert-danger">Skriv in lösenord</div>');
        return false;
    }
    else
    {
        var username = $('#username').val();
        var password = $('#password').val();
        $.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://ideweb2.hh.se/~sigsto14/Test/login.php',
  data: { username: username, password: password},  
        dataType: 'text',

   success: function(data){
            if(data == 'true') {  
   $('#search').removeClass('hidden');
                 $('.container').load('profil.html');
      $('#loggedIn').html(username);
       var username = $('#username').val();
       var password = $('#password').val();

                  $.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://ideweb2.hh.se/~sigsto14/Test/getProfile.php',  
        data: { username: username},
        dataType: 'text',
      
   success: function(data){

        $('#profile').html(data);
        /* boxar öppna stänga */
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
    $('#openProf').click(function(e){
e.preventDefault();
$('#profBox').toggleClass('hidden');
$('#closeProf').toggleClass('hidden');
$('#openProf').toggleClass('hidden');
    });

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

                $('#openUpload').click(function(e){
e.preventDefault();
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
     

       
               $('#openDisc').click(function(e){
e.preventDefault();

$('#discBox').toggleClass('hidden');
$('#openDisc').toggleClass('hidden');
$('#closeDisc').toggleClass('hidden');

});
      

        $('#openNew').click(function(e){
e.preventDefault();

$('#newBox').toggleClass('hidden');
$('#openNew').toggleClass('hidden');
$('#closeNew').toggleClass('hidden');

  $.ajax({

        type: 'POST',
        crossDomain: true,
        url: 'http://ideweb2.hh.se/~sigsto14/Test/newUploads.php',  
        data: {username: username },
        dataType: 'text',
      
   success: function(data){
   $('#newBox').html(data);
    },
   error: function() {}
    });
  });

        $('#closeNew').click(function(e){
e.preventDefault();
audio[0].pause();
$('#newBox').toggleClass('hidden');
$('#closeNew').toggleClass('hidden');
$('#openNew').toggleClass('hidden');
    });

         $('#openPop').click(function(e){
e.preventDefault();

$('#popBox').toggleClass('hidden');
$('#openPop').toggleClass('hidden');
$('#closePop').toggleClass('hidden');
   
  $.ajax({

        type: 'POST',
        crossDomain: true,
        url: 'http://ideweb2.hh.se/~sigsto14/Test/popularSounds.php',  
        data: {username: username },
        dataType: 'text',
      
   success: function(data){
   $('#popBox').html(data);
    },
   error: function() {}
    });
  });

        $('#closePop').click(function(e){
e.preventDefault();
audio[0].pause();
$('#popBox').toggleClass('hidden');
$('#closePop').toggleClass('hidden');
$('#openPop').toggleClass('hidden');
    });
       $('#openPopchan').click(function(e){
e.preventDefault();

$('#popchanBox').toggleClass('hidden');
$('#openPopchan').toggleClass('hidden');
$('#closePopchan').toggleClass('hidden');
   $.ajax({

        type: 'POST',
        crossDomain: true,
        url: 'http://ideweb2.hh.se/~sigsto14/Test/popularChannel.php',  
        data: {username: username },
        dataType: 'text',
      
   success: function(data){
   $('#popchanBox').html(data);

   $('.addTrigger').click(function(e){
e.preventDefault();
var soundID = $(this).next('.soundID').val();
var listID =  $(this).prev().find('option:selected').val(); 
if(listID == 'default'){
  alert('Välj lista!');
}
else {
 $.ajax({

        type: 'POST',
        crossDomain: true,
        url: 'http://ideweb2.hh.se/~sigsto14/Test/addToPlaylist.php',  
        data: {soundID: soundID, listID: listID},
        dataType: 'text',
      
   success: function(data){ 
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

        $('#closePopchan').click(function(e){
e.preventDefault();
audio[0].pause();
$('#popchanBox').toggleClass('hidden');
$('#closePopchan').toggleClass('hidden');
$('#openPopchan').toggleClass('hidden');
    });


     


 

        $('#closeDisc').click(function(e){
e.preventDefault();
$('#discBox').toggleClass('hidden');
$('#closeDisc').toggleClass('hidden');
$('#openDisc').toggleClass('hidden');
    });
       
  


        $('.activateClick').click(function(e){
e.preventDefault();
$('.activate').addClass('hidden');
$(this).next('.activate').removeClass('hidden');

    });
        $('.soundB').click(function()
        {
$('.soundB').toggleClass('hidden');
$('#usersoundBox').toggleClass('hidden');
        });


 



$('#openProf').click(function(e){
 e.preventDefault();
var userID = $('#userID').val();

        $.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://ideweb2.hh.se/~sigsto14/Test/getPlaylists.php',  
        data: { userID: userID},
        dataType: 'text',
      
   success: function(data){
    $('#profBox').html(data);
 },
 error: function(){

 }}); 
});
 
        $('#mySounds').submit(function(e){
 e.preventDefault();

    var userID = $('#userID').val();
        $.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://ideweb2.hh.se/~sigsto14/Test/getMySounds.php',  
        data: { userID: userID},
        dataType: 'text',
      
   success: function(data){
 





     $('#usersoundBox').html(data);

        $('#closeSound').click(function(){
 



    });

      

    
$('#deleteSound').submit(function(e){
e.preventDefault();
var soundID = $('#soundID').val();

$.ajax({
    type: 'POST',
    crossDomain: true,
    url: 'http://ideweb2.hh.se/~sigsto14/Test/deleteSound.php',
    data: { soundID: soundID},
    dataType: 'text',

    success: function(data){
      $('#deleteFB').html('<div class="alert alert-success">Pod raderad!</div>')
    },
    error: function(){
 $('#deleteFB').html('<div class="alert alert-danger">Något gick fel, försök igen</div>')
    }
});



  });
        },
        error: function(){
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

 $(function()
{

  $('#search').submit(function(e){
    e.preventDefault();
    var search = $('#searchinput').val();
    if(search == ''){
      alert('Fyll i något att söka efter');
    }
    else {
      var search = $('#searchinput').val();
          $.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://ideweb2.hh.se/~sigsto14/Test/search.php',  
        data: { search: search},
        dataType: 'text',
      
   success: function(data){

        $('#searchBox').html(data);

  $('#closeSearch').click(function(e){
e.preventDefault();
$('#searchBox').html('');
    });
        },
        error: function(){
             alert(data);
        }
    });
    }
    });




  });

