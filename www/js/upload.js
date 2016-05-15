$(document).ready(function (e) {
 $("#upload").on('submit',(function(e) {

  e.preventDefault();
    var categoryID = $(this).find('option:selected').val();  
 

  $.ajax({
         url: "http://ideweb2.hh.se/~sigsto14/Test/upload.php",
   type: "POST",
   data:  new FormData(this),
   contentType: false,
         cache: false,
   processData:false,
   beforeSend : function()
   {
    //$("#preview").fadeOut();
    $("#err").fadeOut();
   },
   success: function(data)
      {
e.preventDefault();
$(function () {
  $('#links').val(data);
});

  e.preventDefault();
 var title = $('#titel').val();
 alert(title);
      var desc = $('#desc').val();
      var username = $('#username').val();
      var tag = $('#tag').val();
       var links = $('#links').val();

 if(title=='')
    {
      $('#suc').html('<div class="alert alert-danger">Fyll i en titel till din pod</div>');
    }
    else if(desc=='')
    {
      $('#suc').html('<div class="alert alert-danger">Fyll i en beskrivning till din pod</div>');
    }
   else if(tag=='')
    {
      $('#suc').html('<div class="alert alert-danger">Fyll i taggar till din pod</div>');
    }
    else {
  $.ajax({
      type: "POST",
      crossDomain: true,
         url: "http://ideweb2.hh.se/~sigsto14/Test/upload2.php",
data: { title: title, desc: desc, username:username, tag: tag, links: links, categoryID: categoryID},
        dataType: 'text',

   success: function(data)
      {
$('#suc').html(data); 
      $("#upload")[0].reset(); 
                    $('#closeUploaded').click(function(e){
e.preventDefault();
$('#suc').html('');
    });
      },
     error: function(e) 
      {
    $("#err").html('<div class="alert alert-danger">Någonting gick fel. Försök igen</div>');
      }          
    });
}


 
      },
     error: function(e) 
      {
    $("#suc").html(data);
      $("#upload")[0].reset(); 
      }          
    });
 }));
});

