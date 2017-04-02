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
    $Channel = array();

    $url = $settings["url"] . "SystemInformation.htm";
    $file = file_get_contents($url);
    
    $var = $file;
    $var = explode("Current TV Service: [", $var);
    $var = $var[1];
    $var = explode("\t\t<BR>", $var);
    $var = $var[0];
    # Now it looks like this:
    # 2] Yle TV2

    $var = explode("] ", $var);


    $Channel["id"] = $var[0];
    $Channel["name"] = $var[1];


    echo json_encode($Channel, JSON_PRETTY_PRINT);
?>