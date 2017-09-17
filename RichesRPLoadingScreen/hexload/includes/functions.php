<?php

function produce_error( $title, $message ){
    die(
        "<div style='width:95%; margin: 20% auto; font-family: sans-serif; border: dashed 2px red;' >".
        "<div style='height: 20px; background: #ffa7a7; padding: 10px; font-weight: bold; color: #fff;' >$title</div>".
        "<div style='padding: 15px; background: #fafafa; ' >$message</div>".
        "</div>"
    );
}

function json_error( $error ) {
    switch ( $error ) {
        case JSON_ERROR_NONE:
            return ' - No errors';
            break;
        case JSON_ERROR_DEPTH:
            return ' - Maximum stack depth exceeded';
            break;
        case JSON_ERROR_STATE_MISMATCH:
            return ' - Underflow or the modes mismatch';
            break;
        case JSON_ERROR_CTRL_CHAR:
            return ' - Unexpected control character found';
            break;
        case JSON_ERROR_SYNTAX:
            return ' - Syntax error, malformed JSON';
            break;
        case JSON_ERROR_UTF8:
            return ' - Malformed UTF-8 characters, possibly incorrectly encoded';
            break;
        default:
            return ' - Unknown error';
            break;
    }
}

function steam( $steamid ){
    $json = json_decode( file_get_contents( 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=' . STEAM_API . '&steamids=' . $steamid ), true );
    if ( isset($json['response']['players'][0]) ){
        return $json['response']['players'][0];
    }else{
        return false;
    }
}

function get_json( $file ){
    $data = file_get_contents( $file );
    if ( $data == false ){ produce_error( "File Error!", "The file: '<b>/$file<b/>' is missing!" ); }

    $json = json_decode( $data, true );
    if ( is_array($json) ){
        return $json;
    }else{
        produce_error( "JSON Error!", "There's an error in '<b>/$file<b/>'!" . json_error( json_last_error() ) );
    }
}