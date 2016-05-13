// får upprepa funktionen 5 gånger för var playlist


$(function()
{

 $('#playlist1').submit(function(d){
            d.preventDefault();
     
     var listID = $('#listID').val();
     
        $.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://ideweb2.hh.se/~sigsto14/Test/getSounds.php',
        data: { listID: listID},  
        dataType: 'text',

        success: function(data){
  $('#podcastbox1').html(data);
        $('#CLOSE').toggleClass('hidden');
$('#OPEN').toggleClass('hidden');
        },
        error: function(){
           $('#podcastbox1').html('<div class="alert alert-danger">Något gick fel, försök igen</div>');
        }
    });

});




 $('#playlist2').submit(function(d){
            d.preventDefault();
     
     var listID = $('#listID2').val();
    
        $.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://ideweb2.hh.se/~sigsto14/Test/getSounds.php',
        data: { listID: listID},  
        dataType: 'text',

        success: function(data){
    $('#podcastbox2').html(data);
        $('#CLOSE2').toggleClass('hidden');
$('#OPEN2').toggleClass('hidden');
        },
        error: function(){
           $('#podcastbox2').html('<div class="alert alert-danger">Något gick fel, försök igen</div>');
        }
    });

});

$('#playlist3').submit(function(d){
            d.preventDefault();
     var listID = $('#listID3').val();
    
        $.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://ideweb2.hh.se/~sigsto14/Test/getSounds.php',
        data: { listID: listID},  
        dataType: 'text',

             success: function(data){
    $('#podcastbox3').html(data);
       $('#CLOSE3').toggleClass('hidden');
$('#OPEN3').toggleClass('hidden');
        },
        error: function(){
           $('#podcastbox3').html('<div class="alert alert-danger">Något gick fel, försök igen</div>');
        }
    });

});

 
$('#playlist4').submit(function(d){
            d.preventDefault();
     var listID = $('#listID4').val();
    
        $.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://ideweb2.hh.se/~sigsto14/Test/getSounds.php',
        data: { listID: listID},  
        dataType: 'text',

           success: function(data){
            $('#CLOSE4').toggleClass('hidden');
$('#OPEN4').toggleClass('hidden');
                 
                $('#podcastbox4').html(data);

 },
        error: function(){
           $('#podcastbox4').html('<div class="alert alert-danger">Något gick fel, försök igen</div>');
        }
    });

});
$('#playlist5').submit(function(d){
            d.preventDefault();
     var listID = $('#listID5').val();
    
        $.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://ideweb2.hh.se/~sigsto14/Test/getSounds.php',
        data: { listID: listID},  
        dataType: 'text',

            success: function(data){
       $('#podcastbox1').html(data);
          $('#CLOSE5').toggleClass('hidden');
$('#OPEN5').toggleClass('hidden');
        },
        error: function(){
           $('#podcastbox5').html('<div class="alert alert-danger">Något gick fel, försök igen</div>');
        }
    });

});


 $('#OPENPLU').click(function(e){
e.preventDefault();
$('#PLU').toggleClass('hidden');
$('#OPENPLU').toggleClass('hidden');
$('#CLOSEPLU').toggleClass('hidden');
    });

        $('#CLOSEPLU').click(function(e){
e.preventDefault();
$('#PLU').toggleClass('hidden');
$('#CLOSEPLU').toggleClass('hidden');
$('#OPENPLU').toggleClass('hidden');
    });

    $('#PL').submit(function(e){
 e.preventDefault();

    var userID = $('#userID').val();
    var title = $('#title').val();
    var desc = $('#desc').val();
        $.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://ideweb2.hh.se/~sigsto14/Test/playlistCreate.php',  
        data: { userID: userID, title: title, desc: desc},
        dataType: 'text',
      
   success: function(data){
    alert(data);
 },
 error: function(){

 }}); });

  $('#OPEN').click(function(){
$('#playlist1').trigger('submit');
  
$('#podcastbox1').toggleClass('hidden');
  });
  $('#CLOSE').click(function(){
$('#CLOSE').toggleClass('hidden');
$('#OPEN').toggleClass('hidden');
$('#podcastbox1').toggleClass('hidden');
$('#podcastbox1').html('');
 });


  $('#OPEN2').click(function(){
$('#playlist2').trigger('submit');
  
$('#podcastbox2').toggleClass('hidden');
  });
  $('#CLOSE2').click(function(){
$('#CLOSE2').toggleClass('hidden');
$('#OPEN2').toggleClass('hidden');
$('#podcastbox2').toggleClass('hidden');
$('#podcastbox2').html('');
 });


  $('#OPEN3').click(function(){
$('#playlist3').trigger('submit');
     $('#podcastbox3').toggleClass('hidden');

  });
  $('#CLOSE3').click(function(){
$('#CLOSE3').toggleClass('hidden');
$('#OPEN3').toggleClass('hidden');
$('#podcastbox3').toggleClass('hidden');
$('#podcastbox3').html('');
 });

      $('#OPEN4').click(function(){
$('#playlist4').trigger('submit');
     $('#podcastbox4').toggleClass('hidden');

  });
  $('#CLOSE4').click(function(){
$('#CLOSE4').toggleClass('hidden');
$('#OPEN4').toggleClass('hidden');
$('#podcastbox4').toggleClass('hidden');
$('#podcastbox4').html('');
 });

    $('#OPEN5').click(function(){
$('#playlist5').trigger('submit');
     $('#podcastbox5').toggleClass('hidden');

  });
  $('#CLOSE5').click(function(){
$('#CLOSE5').toggleClass('hidden');
$('#OPEN5').toggleClass('hidden');
$('#podcastbox5').toggleClass('hidden');
$('#podcastbox5').html('');
 });
});
