<?php

    /****************************************************************
                 _   _           _                    _
                | | | | _____  _| |    ___   __ _  __| |
                | |_| |/ _ \ \/ / |   / _ \ / _` |/ _` |
                |  _  |  __/>  <| |__| (_) | (_| | (_| |
                |_| |_|\___/_/\_\_____\___/ \__,_|\__,_|
                     Created by Digipxiel I.O.  v1.1

      Copyright (C) 2014-2015 Digipxiel I.O. <digipixel.io@gmail.com>

      Hexload can not be copied and/or distributed without the express
      permission of Digipixel I.O.
     ****************************************************************/

    //////////////////////////////////////////////////////////////////
    // Path Definitions
    //////////////////////////////////////////////////////////////////
    define( 'PATH',     dirname(__FILE__) . '/' );
    define( 'INC',      'includes/' );
    define( 'TEMPLATE', 'themes/' );
    define( 'CACHE',    'cache/' );
    define( 'DATA',   'data/' );

    //////////////////////////////////////////////////////////////////
    // Include Files
    //////////////////////////////////////////////////////////////////
    require( PATH . 'config.php' );
    require( INC . 'functions.php' );

    //////////////////////////////////////////////////////////////////
    // Requesting json for page
    //////////////////////////////////////////////////////////////////
    if ( isset( $_GET['json'] ) ) {

        error_reporting ( 0 );

        $steamid    = $_GET['steamid'];
        $mapname    = $_GET['mapname'];
        $gamemode   = $_GET['gamemode'];
        $steam_info = steam( $steamid );
        $gamemodes  = get_json( PATH . DATA . "games.json" );
        $maps       = get_json( PATH . DATA . "maps.json" );

        $json = array();
        if ( isset( $maps[$mapname] ) ) {
            $json['map'] = Array(
                'name'  => $mapname,
                'label' => $maps[$mapname]['name'],
                'icon'  => $maps[$mapname]['icon'],
                'back'  => $maps[$mapname]['back']
            );
        } else {
            $json['map'] = Array(
                'name'  => $mapname,
                'label' => $mapname,
                'icon'  => "media/icons/maps/$mapname.png",
                'back'  => "media/backs/maps/$mapname.png",
            );
        }

        if ( $steam_info != false ) {
            $json['user'] = $steam_info['response']['players'][0];
            $json['user'] = Array(
                'name'          => $steam_info['personaname'],
                'id'            => $steam_info['steamid'],
                'profileurl'    => $steam_info['profileurl'],
                'avatar'        => $steam_info['avatar' ],
                'avatarmedium'  => $steam_info['avatarmedium'],
                'avatarfull'    => $steam_info['avatarfull']
            );
        } else {
            $json['user'] = Array(
                'name'          => 'Unknown',
                'id'            => '00000000000000000',
                'profileurl'    => 'http://steamcommunity.com/id/00000000000000000',
                'avatar'        => 'profile.jpg',
                'avatarmedium'  => 'profile_medium.jpg',
                'avatarfull'    => 'profile_full.jpg'
            );
        }

        if ( isset( $gamemodes[$gamemode] ) ) {
            $json['gamemode'] = Array(
                'name'  => $gamemode,
                'label' => $gamemodes[$gamemode]['name'],
                'icon'  => $gamemodes[$gamemode]['icon'],
                'back'  => $gamemodes[$gamemode]['back']
            );
        } else {
            $json['gamemode'] = Array(
                'name'  => $gamemode,
                'label' => $gamemode,
                'icon'  => "media/icons/games/$gamemode.png",
                'back'  => "media/backs/maps/$gamemode.png"
            );
        }

        echo json_encode( $json );

    } else {
        //////////////////////////////////////////////////////////////////
        // Include Template
        //////////////////////////////////////////////////////////////////
        require(INC . 'tpl.class.php');

        //////////////////////////////////////////////////////////////////
        //RainTPL Settings
        //////////////////////////////////////////////////////////////////
        raintpl::configure( 'base_url', BASE_URL );
        raintpl::configure( 'tpl_dir', TEMPLATE );
        raintpl::configure( 'cache_dir', CACHE );

        $tpl = new RainTPL;
        $server = 'default';

        if ( isset( $_GET['server'] ) ) {
            $file = $_GET['server'] ;
            if ( file_exists(  PATH . TEMPLATE . $file . "/settings.json" ) ) {
                $server = $file;
            }
        }

        $theme = get_json( PATH . TEMPLATE . $server . "/settings.json" );

        foreach ($theme as $key => $value ) {
            $tpl->assign( $key, $value );
        }

        if ( isset( $_GET['debug'] ) ) {
            $tpl->assign( "debug", true );
        }

        if ( isset( $_GET['test'] ) ) {
            $tpl->assign( "test", true );
        }

        echo $tpl->draw( $server . '/index', $return_string = true );
    }