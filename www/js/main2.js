//playlist YOOOOOO
//new uploads gäller denna
//copy paste från main 1
//pga id-conflicts
//har alla egen
//samma kod olika ID
var audio;
var playlist;
var tracks;
var current;



function init(){

    current = 0;
    audio = $('#audioNU');
    playlist = $('#playlistNU');
    tracks = playlist.find('li a');
    len = tracks.length - 1;
    audio[0].volume = .10;




  playlist.find('a').click(function(e){
        e.preventDefault();
        link = $(this);
        current = link.parent().index();
        run(link, audio[0]);
    });
    audio[0].addEventListener('ended',function(e){
        current++;
        if(current == len){
            current = 0;
            link = playlist.find('a')[0];
        }else{
            link = playlist.find('a')[current];    
        }
        run($(link),audio[0]);
    });
}
function run(link, player){
        player.src = link.attr('href');
        par = link.parent();
        par.addClass('active').siblings().removeClass('active');
        audio[0].load();
        audio[0].play();
}

  init();  

  //lägg till i spellista kod
  //kod för att lägga till i spellista
  //också i denna fil pga id-conflicts
 $('.addTriggerNew').click(function(e){
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
    $('#searchFBNew').html(data);
    
  },
   error: function() {}
 });
}
});