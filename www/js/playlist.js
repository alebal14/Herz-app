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
  $('#podcastbox1').toggleClass('hidden');
  $('#OPEN').addClass('OPEN');

            $('.OPEN').toggleClass('hidden');
                 $('#CLOSE').toggleClass('hidden');
     $('#podcastbox1').html(data);
$('#CLOSE').click(function(d){
    d.preventDefault();
audio[0].pause();
      $('.OPEN').toggleClass('hidden');
                 $('#CLOSE').toggleClass('hidden');
$('#podcastbox1').addClass('hidden');
});
$('.OPEN').click(function(d){
d.preventDefault();
  $('#podcastbox1').removeClass('hidden');

      $('.OPEN').toggleClass('hidden');
                 $('#CLOSE').toggleClass('hidden');
});
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
  $('#podcastbox2').toggleClass('hidden');
  $('#OPEN2').addClass('OPEN2');

            $('.OPEN2').toggleClass('hidden');
                 $('#CLOSE2').toggleClass('hidden');
     $('#podcastbox2').html(data);
$('#CLOSE2').click(function(d){
    d.preventDefault();
audio[0].pause();
      $('.OPEN2').toggleClass('hidden');
                 $('#CLOSE2').toggleClass('hidden');
$('#podcastbox2').addClass('hidden');
});
$('.OPEN2').click(function(d){
d.preventDefault();
  $('#podcastbox2').removeClass('hidden');

      $('.OPEN2').toggleClass('hidden');
                 $('#CLOSE2').toggleClass('hidden');
});
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
     $('#podcastbox3').toggleClass('hidden');
  $('#OPEN3').addClass('OPEN3');

            $('.OPEN3').toggleClass('hidden');
                 $('#CLOSE3').toggleClass('hidden');
     $('#podcastbox3').html(data);
$('#CLOSE3').click(function(d){
    d.preventDefault();
audio[0].pause();
      $('.OPEN3').toggleClass('hidden');
                 $('#CLOSE3').toggleClass('hidden');
$('#podcastbox3').addClass('hidden');
});
$('.OPEN3').click(function(d){
d.preventDefault();
  $('#podcastbox3').removeClass('hidden');

      $('.OPEN3').toggleClass('hidden');
                 $('#CLOSE3').toggleClass('hidden');
});
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
        $('#podcastbox4').toggleClass('hidden');
  $('#OPEN4').addClass('OPEN4');

            $('.OPEN4').toggleClass('hidden');
                 $('#CLOSE4').toggleClass('hidden');
     $('#podcastbox4').html(data);
$('#CLOSE4').click(function(d){
    d.preventDefault();
audio[0].pause();
      $('.OPEN4').toggleClass('hidden');
                 $('#CLOSE4').toggleClass('hidden');
$('#podcastbox4').addClass('hidden');
});
$('.OPEN4').click(function(d){
d.preventDefault();
  $('#podcastbox4').removeClass('hidden');

      $('.OPEN4').toggleClass('hidden');
                 $('#CLOSE4').toggleClass('hidden');
});
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
        $('#podcastbox5').toggleClass('hidden');
  $('#OPEN5').addClass('OPEN5');

            $('.OPEN5').toggleClass('hidden');
                 $('#CLOSE5').toggleClass('hidden');
     $('#podcastbox5').html(data);
$('#CLOSE5').click(function(d){
    d.preventDefault();
audio[0].pause();
      $('.OPEN5').toggleClass('hidden');
                 $('#CLOSE5').toggleClass('hidden');
$('#podcastbox5').addClass('hidden');
});
$('.OPEN5').click(function(d){
d.preventDefault();
  $('#podcastbox5').removeClass('hidden');

      $('.OPEN5').toggleClass('hidden');
                 $('#CLOSE5').toggleClass('hidden');
});
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
});
