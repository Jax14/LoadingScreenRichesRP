
var GMOD = new Gmod();
var slider = $( '#slider' ).slitslider( );
var speed = 1000;
$( document ).ready(function() {

    function remove( elem ){
        $(elem).remove();
    }

    function update( server, map, player, gamemode ){
        $( ".user-img" ).attr( 'src', player.avatarfull );
        $( "#user-name" ).html( player.name );

        $( "#server-name" ).html( server );

        $( "#map-name" ).html( map.label );
        $( ".map-back" ).css( 'background-image','url(' + map.back + ')' );
        $( ".map-img" ).attr( 'src', map.icon );


        $( "#game-mode" ).html( gamemode.label );
        $( ".gamemode-back" ).css( 'background-image','url(' + gamemode.back + ')' );
        $( ".gamemode-img" ).attr( 'src', gamemode.icon );
    }

    GMOD.Details = function( server, url, max, map, player, gamemode ) {

        update( server, map, player, gamemode );

        $( "#loading" ).fadeOut( 1000 , function() {

            if ( $( "#user-name" ).html != player.name ){
                update( server, map, player, gamemode );
            }

            remove( this );

        } );

        window.setInterval(function(){
            if ( $( "#user-name" ).html != player.name ){
                update( server, map, player, gamemode );
            }

            slider.next();
        }, speed );

        $(document).on( "click", function() {
            slider.next();
        });

    };

    GMOD.OnError = function() {
        slider.next();
        $( "#loading").fadeOut( 1000 , function() {
            remove( this );
        });
    };

    GMOD.Downloading = function( file, ext, type, total, needed, current ) {
        $("<li class='file " + type + "' >Downloading '" + file + "' <small> (" + current  + "/" + total + ")</small></li>").appendTo("#files .container-files").fadeOut( 1000, function(){ remove(this); });
    };

    GMOD.Progress = function( percent, total, needed, current ) {
        $('.progress span').css( "width", percent +  "%" ).html( percent + '%' );
    };

    GMOD.Status = function( status ) {
        $('.progress span').html( status );
    };

});