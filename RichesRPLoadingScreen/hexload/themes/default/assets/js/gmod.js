
var GameDetails, SetFilesTotal, DownloadingFile, SetStatusChanged, SetFilesNeeded;

var Gmod = function() {

    //Private Properties
    var self = this;
    var Ext = [];
    Ext["jpg"] = "jpeg";
    Ext["peg"] = "jpeg";
    Ext["bsp"] = "map";
    Ext["pcf"] = "particles";
    Ext["ttf"] = "fonts";
    Ext["png"] = "png";
    Ext["vmt"] = "texture";
    Ext["vtf"] = "texture";
    Ext["vtx"] = "models";
    Ext["mdl"] = "models";
    Ext["phy"] = "models";
    Ext["vvd"] = "models";
    Ext["wav"] = "sounds";
    Ext["mp3"] = "sounds";

    var Total      = 0;
    var Needed     = 0;
    var Downloaded = 0;

    //Public Properties
    this.Debug    = false;

    //Private Functions
    this.Test = function( servername, serverurl, mapname, maxplayers, steamid, gamemode ){
        var total_files = 500

        SetFilesTotal(total_files);
        SetFilesNeeded(total_files);

        window.setInterval(function(){
            var ext = [ "jpg","peg", "bsp", "vmt", "vtf", "png", "vtx", "mdl", "phy", "vvd", "wav", "mp3", "pcf", "ttf" ];
            DownloadingFile( "materials/folder/file." + ext[Math.floor((Math.random() * 13) + 0)] );
            if ( Downloaded >= total_files ){
                SetStatusChanged("Sending client info..");
                SetStatusChanged("Receiving client info..");
                Downloaded = 0;
            }
        }, 300);


        GameDetails( servername, serverurl, mapname, maxplayers, steamid, gamemode );
    };

    //Public Functions
    this.Details = function( server, url, max, map, player, gamemode ) { };
    this.Downloading = function( file, ext, type, total, needed, current ) { };
    this.Progress = function( percent, total, needed, current ) { };
    this.Status = function( status ) { };
    this.OnError = function( ) { };

    //Function Takeovers

    /*
     Called at the start, when the loading screen finishes loading all assets.

     serverName- Server's name.
     Convar: hostname
     For exmaple: "Garry's Mod Server"
     serverURL- URL for the loading screen.
     Convar: sv_loadingurl
     For example: "http://mywebsite.com/myloadingscreen.html"
     mapName- The name of the map the server is playing.
     For example: "cs_office"
     maxPlayers- Maximum number of players for the server.
     Convar: maxplayers
     steamID- 64-bit, numeric Steam community ID of the client joining.
     For example: 76561198012345678
     gamemode- The gamemode the server is currently playing.
     Convar: gamemode
     For example: "deathrun"

     */
    GameDetails = function( servername, serverurl, mapname, maxplayers, steamid, gamemode ) {
        var json = $.ajax({
            url: "?json=1&steamid=" + steamid + "&mapname=" + mapname + "&gamemode=" + gamemode,
            dataType: 'json',
            timeout: 10000
        }).done( function( data ){
            self.Details( servername, serverurl, maxplayers, data.map, data.user, data.gamemode );
            if ( self.Debug == true ){
                console.log( 'Server Name: ' + servername );
                console.log( 'Server URL: ' + serverurl );
                console.log( 'Server Max: ' + maxplayers );
                console.log( 'Server Map: ' + data.map.name );
                console.log( 'Server Game Mode: ' + data.gamemode.name );
                console.log( 'Server User ID: ' + data.user.id );
                console.log( 'Server User Name: ' + data.user.name );
            }
        }).fail( function( jqxhr, textStatus, error ) {
            self.OnError();
            if ( self.Debug == true ){
                console.log( 'Error getting JSON!!' );
                console.log( "Request Failed: " + textStatus + ", " + error );
            }
        });

        console.log(
            "\n" +
            " _   _           _                    _\n" +
            "| | | | _____  _| |    ___   __ _  __| |\n" +
            "| |_| |/ _ \\ \\/ / |   / _ \\ / _` |/ _` |\n" +
            "|  _  |  __/>  <| |__| (_) | (_| | (_| |\n" +
            "|_| |_|\\___/_/\\_\\_____\\___/ \\__,_|\\__,_|\n" +
            "     Created by Digipxiel I.O. v1.0\n" +
            "   Download at http://tiny.cc/hexload \n"
        );
    };

    /*
     Called at the start.
     total- Total number of files the client will have to download.
     */
    SetFilesTotal = function( total ) {
        Total = total;
        if ( self.Debug == true ){
            console.log( 'Total files: ' + total );
        }
    };

    /*
     Called when the number of files remaining for the client to download changes.
     needed- Number of files left for the client to download.
     */
    SetFilesNeeded = function( needed ) {
        Needed = needed;
        if ( self.Debug == true ){
            console.log( 'Needed Files: ' + needed );
        }
    };

    /*
     Called when the client starts downloading a file.
     fileName- The full path and name of the file the client is downloading.
     This path represents the resource's location rather than the actual file's location on the server.
     For example, the file "garrysmod/addons/myAddon/materials/models/bobsModels/car.mdl" will be:
     "materials/models/bobsModels/car.mdl"
     */
    DownloadingFile = function( fileName ) {
        var ext = fileName.substr(fileName.length - 3);
        self.Downloading( fileName, ext, Ext[ext], Total, Needed, Downloaded  );
        self.Progress( Math.floor(( Downloaded / Total ) * 100), Total, Needed, Downloaded );
        Downloaded++;
        if ( self.Debug == true ){
            console.log( 'Downloading: ' + fileName );
        }
    };

    /*
     Called when the client's joining status changes.
     status- Current joining status.
     For example: "Sending client info..."
     */
    SetStatusChanged = function( status ) {
        self.Status( status );
        if ( self.Debug == true ){
            console.log( 'Status: ' + status );
        }
    };
};