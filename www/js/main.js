//PLAYLIST WOOOOOOOOOOOOOOOOOOOP
//detta allmän playlist
//mainly för mina spellistor

//gör variabler
var audio;
var playlist;
var tracks;
var current;


//gör function
function init(){

    current = 0;
    //hittar variablerna
    audio = $('.audio');
    playlist = $('.playlist');
    tracks = playlist.find('li a');
    len = tracks.length - 1;
    audio[0].volume = .10;

 playlist.find('a').click(function(e){
        e.preventDefault();
        link = $(this);
        current = link.parent().index();
        run(link, audio[0]);
    });
 //när ett ljud tar slut gå över till nästa
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
    //hitta ljud genom a klickat med värdet
        player.src = link.attr('href');
        par = link.parent();
        //ändrar klass
        par.addClass('active').siblings().removeClass('active');
        //laddar o spelar ljudet
        audio[0].load();
        audio[0].play();
}


  init();  
