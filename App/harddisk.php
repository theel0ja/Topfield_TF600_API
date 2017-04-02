<?php
    /*
     * Topfield_TF600_API 0.0.2
     * https://github.com/theel0ja/Topfield_TF600_API
     * MIT LICENSED
     * (C) Elias Ojala 2016
     */

	header('Content-Type: application/json');

    $settings = file_get_contents("../Secret/settings.json");
    $settings = json_decode($settings, TRUE);

    // Channels
    $Harddisk = array();

    $url = $settings["url"] . "SystemInformation.htm";
    $file = file_get_contents($url);
    
    $var = $file;
    $var = explode("<B>HDD Information</B>", $var);
    $var = $var[1];

    $var = explode('<HR align="left" width="500" size="1"  color="#FFFFFF">', $var); 
    $var = $var[1];

    $var = str_replace("\r\n", "", $var);

    $var = explode('<HR align="left" width="500" size="1"  color="#FFFFFF">', $var);
    $var = $var[0];

    # Now it looks like this:
    # Occupied Space:	302302MB	<BR>Free Space:	2940MB	<BR?Total Space:	305242MB	<BR>

    $var = explode("</DIV>", $var);
    $var = $var[0];

    $var = explode('<BR>', $var);
    $HDD["occupied_space"] = explode("	", $var[0]);
    $HDD["occupied_space"] = $HDD["occupied_space"][1];

    unset($var[0]);
    unset($var[2]);
    $var = $var[1];
    $var = explode('<BR?', $var);

    $HDD["free_space"] = explode("	", $var[0]);
    $HDD["free_space"] = $HDD["free_space"][1];

    $HDD["total_space"] = explode("	", $var[1]);
    $HDD["total_space"] = $HDD["total_space"][1];

    $Harddisk["total_space"] = str_replace("MB", "", $HDD["total_space"]);
    $Harddisk["occupied_space"] = str_replace("MB", "", $HDD["occupied_space"]);
    $Harddisk["used_space"] = $HDD["occupied_space"] - $HDD["free_space"];
    $Harddisk["free_space"] = str_replace("MB", "", $HDD["free_space"]);


    echo json_encode($Harddisk, JSON_PRETTY_PRINT);
?>