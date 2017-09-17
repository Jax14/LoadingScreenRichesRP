<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>

    <!-- Slaider CSS -->
    <link rel="stylesheet" type="text/css" href="http://localhost/hexload/themes/default/assets/css/slider.css" />
    <noscript>
        <link rel="stylesheet" type="text/css" href="http://localhost/hexload/themes/default/assets/css/sliderNoJS.css" />
    </noscript>

    <!-- Main CSS -->
    <link href="http://localhost/hexload/themes/default/assets/css/style.css" rel="stylesheet">

    <style>
        <?php if( isset($backgrounds) ){ ?>
            <?php $counter1=-1; if( isset($backgrounds) && is_array($backgrounds) && sizeof($backgrounds) ) foreach( $backgrounds as $key1 => $value1 ){ $counter1++; ?>
                .gmod .bg-<?php echo $counter1+1;?> .sl-slide-inner, .gmod .bg-<?php echo $counter1+1;?> .sl-content-slice {  background-image: url("<?php echo $value1;?>"); background-size: cover;  }
            <?php } ?>
        <?php } ?>
    </style>

    <!-- Modernizr JS -->
    <script type="text/javascript" src="http://localhost/hexload/themes/default/assets/js/modernizr.js"></script>

</head>
<body>

<div class="container gmod">
    <div class="progress"><span></span></div>
    <div id="loading"><span>Loading...</span></div>
    <?php if( isset($logo) ){ ?>
        <div id="logo-container"><img class="logo" onerror="this.src='media/logos/logo.png'" src="http://localhost/hexload/themes/default/../../<?php echo $logo;?>" /></div>
    <?php } ?>

    <div id="slider" class="sl-slider-wrapper">
        <div class="sl-slider">
            <div class="sl-slide bg-1" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
                <div class="sl-slide-inner">
                    <div class="deco">
                        <div class="deco-border">
                            <img width="184" height="184" class="user-img" onerror="this.src='themes/default/assets/img/profile_icon.png'" src="http://localhost/hexload/themes/default/assets/img/profile_icon.png" />
                        </div>
                    </div>
                    <div class="slide-wrap">
                        <h2><div id="user-name" >Welcome!</div></h2>
                        <p><?php echo $welcome;?></p>
                    </div>
                </div>
            </div>

            <div class="sl-slide bg-2" data-orientation="vertical" data-slice1-rotation="10" data-slice2-rotation="-15" data-slice1-scale="1.5" data-slice2-scale="1.5">
                <div class="sl-slide-inner">
                    <div class="deco">
                        <div class="deco-border">
                            <img width="184" height="184" class="server-img" onerror="this.src='media/logos/server_icon.png'" src="http://localhost/hexload/themes/default/../../<?php echo $icon;?>" />
                        </div>
                    </div>
                    <div class="slide-wrap">
                        <div class="server-top">You're playing on...</div>
                        <h2><div id="server-name" >Our Sever</div></h2>
                    </div>
                    <?php if( isset($rules) ){ ?>
                    <div class="panel-container left">
                        <div class="title"><h2>Rules</h2></div>
                        <ul >
                            <?php $counter1=-1; if( isset($rules) && is_array($rules) && sizeof($rules) ) foreach( $rules as $key1 => $value1 ){ $counter1++; ?>
                            <li><span><?php echo $counter1+1;?></span> <?php echo $value1;?></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php } ?>
                    <?php if( isset($staff) ){ ?>
                    <div class="panel-container right">
                        <div class="title"><h2>Staff</h2></div>
                        <ul >
                            <?php $counter1=-1; if( isset($staff) && is_array($staff) && sizeof($staff) ) foreach( $staff as $key1 => $value1 ){ $counter1++; ?>
                            <li><span><?php echo $counter1+1;?></span> <?php echo $value1;?></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <div class="sl-slide bg-3" data-orientation="horizontal" data-slice1-rotation="3" data-slice2-rotation="3" data-slice1-scale="2" data-slice2-scale="1">
                <div class="sl-slide-inner">
                    <div class="map-back" >
                        <div class="deco">
                            <div class="deco-border">
                                <img width="184" height="184" class="map-img" onerror="this.src='themes/default/assets/img/map_icon.png'" src="http://localhost/hexload/themes/default/assets/img/map_icon.png" />
                            </div>
                        </div>
                    </div>
                    <div class="slide-wrap">
                        <h2>Map: <div id="map-name" >Map Unknown</div></h2>
                    </div>
                </div>
            </div>

            <div class="sl-slide bg-4" data-orientation="vertical" data-slice1-rotation="-5" data-slice2-rotation="25" data-slice1-scale="2" data-slice2-scale="1">
                <div class="sl-slide-inner">
                    <div class="gamemode-back" >
                        <div class="deco">
                            <div class="deco-border">
                                <img width="184" height="184" class="gamemode-img" onerror="this.src='themes/default/assets/img/game_icon.png'" src="http://localhost/hexload/themes/default/assets/img/game_icon.png" />
                            </div>
                        </div>
                    </div>
                    <div class="slide-wrap">
                        <h2><div id="game-mode" >Game Mode Unknown</div></h2>
                    </div>
                </div>
            </div>
            <?php if( isset($quote) ){ ?>
            <div class="sl-slide bg-5" data-orientation="horizontal" data-slice1-rotation="-5" data-slice2-rotation="10" data-slice1-scale="2" data-slice2-scale="1">
                <div class="sl-slide-inner">
                    <div class="deco">
                        <div class="deco-border">
                            <img width="184" height="184" class="msg-img" onerror="this.src='themes/default/assets/img/msg_icon.png'" src="http://localhost/hexload/themes/default/assets/img/msg_icon.png" />
                        </div>
                    </div>
                    <div class="slide-wrap">
                        <h2>Quote of the Day!</h2>
                        <blockquote><p><?php echo $quote;?></p></blockquote>
                    </div>
                </div>
            </div>
            <?php } ?>

        </div>
    </div>
</div>

<?php if( isset($music) ){ ?>
    <audio id="player" autoplay></audio>
    <ul id="playlist" >
        <?php $counter1=-1; if( isset($music) && is_array($music) && sizeof($music) ) foreach( $music as $key1 => $value1 ){ $counter1++; ?>
        <li data-ogg="<?php echo $value1;?>"></li>
        <?php } ?>
    </ul>
<?php } ?>

<div id="files"><ul class="container-files"> </ul></div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="http://localhost/hexload/themes/default/assets/js/gmod.js"></script>
<script type="text/javascript" src="http://localhost/hexload/themes/default/assets/js/jquery.cond.min.js"></script>
<script type="text/javascript" src="http://localhost/hexload/themes/default/assets/js/jquery.slitslider.js"></script>
<script type="text/javascript" src="http://localhost/hexload/themes/default/assets/js/init.js"></script>

<script>
    speed = <?php echo $speed;?>000;
</script>

<?php if( isset($music) ){ ?>
<script type="text/javascript" >
    $( document ).ready(function() {
        var player = $('#player');
        var playlist = $('#playlist');
        var music = [];
        var max = 0;

        player.prop("volume", <?php echo $volume;?>);

        $('#playlist li').each( function( index, value ) {
            music[index] = $( value ).attr('data-ogg');
            max++;
        });

        function play_music(){
            if ( max == 1 ){
                player.attr("src", music[0]);
                player.trigger("load");
                player.trigger("play");
                console.log("Now playing: " + music[0] );
            }else{
                var track = Math.floor((Math.random() * max) + 0);
                while ( true ) {
                    if ( player.attr("src") != music[track] ){
                        player.attr("src", music[track]);
                        player.trigger("load");
                        player.trigger("play");
                        console.log("Now playing: " + music[track] );
                        break;
                    }else{
                        track = Math.floor((Math.random() * max) + 0);
                    }
                }
            }
        }

        player.on( "ended", function(){
            play_music();
        });

        play_music();
    });
</script>
<?php } ?>

<script type="text/javascript" >
    <?php if( isset($debug) ){ ?>
        GMOD.Debug = true;
    <?php } ?>
    <?php if( isset($test) ){ ?>
        $( document ).ready(function() {
            GMOD.Debug = true;
            GMOD.Test( "Hex Load Games", "http://yourdomin.com/loading", "ttt_terrortown", 16, "76561197991928585", "terrortown" );
        });
    <?php } ?>
</script>

</body>
</html>
