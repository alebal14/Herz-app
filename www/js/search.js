 //js för sökfunktion

 $(function()
{
  //när sökfältet ifyllt
  $('#search').submit(function(e){
    e.preventDefault();
    //variabler av input
    var search = $('#searchinput').val();
    var username = $('#username').val();
//om man ej skrivit nåt o söka
    if(search == ''){
      //allert
      alert('Fyll i något att söka efter');
    }
    else {
//skickar datan med ajax
          $.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://ideweb2.hh.se/~sigsto14/Test/search.php',  
        //definierar variablerna
        data: { search: search, username: username},
        dataType: 'text',
beforeSend: function() {
//laddningsgiv när det laddar
        $('#searchBox').removeClass('hidden');
        $('#searchBox').html('<center><img id="loading" src="http://ideweb2.hh.se/~sigsto14/Test/img/loading2.gif"></center>');
    },
      
   success: function(data){
   //matar ut datan som kommer tillbaka från php
        $('#searchBox').html(data);
//om man stänger knappen
  $('#closeSearch').click(function(e){
e.preventDefault();
$('#searchBox').html('');
    });
        },
        //om något går fel
        error: function(){
             alert(data);
        }
    });
    }
    });

});