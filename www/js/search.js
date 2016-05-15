 //js för sökfunktion

 $(function()
{
  $('#search').submit(function(e){
    e.preventDefault();
    var search = $('#searchinput').val();
    var username = $('#username').val();

    if(search == ''){
      alert('Fyll i något att söka efter');
    }
    else {

          $.ajax({
        type: 'POST',
        crossDomain: true,
        url: 'http://ideweb2.hh.se/~sigsto14/Test/search.php',  
        data: { search: search, username: username},
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