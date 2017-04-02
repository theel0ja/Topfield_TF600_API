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
    $Time = array();

    $url = $settings["url"] . "SystemInformation.htm";
    $file = file_get_contents($url);
    
    $date = $file;
    $date = explode("Date:	", $date);
    $date = $date[1];
    $date = explode("<BR>", $date);
    $date = $date[0];

    # Now it looks like:
    # #2016 / 12 / 20		" (without those ", but it have tabs etc)

    $date = preg_replace("/([^0-9] \/)/","", $date);

    $date = explode("/", $date);

    $Time["year"] = preg_replace("/[^0-9]/", "", $date[0]);
    $Time["month"] = preg_replace("/[^0-9]/", "", $date[1]);
    $Time["day"] = preg_replace("/[^0-9]/", "", $date[2]);

    $clock = $file;
    $clock = explode("Time:	", $clock);
    $clock = $clock[1];
    $clock = explode("<BR>", $clock);
    $clock = $clock[0];

    $clock = preg_replace("/([^0-9:])/","", $clock);

    $clock = explode(":", $clock);

    $Time["hour"] = preg_replace("/[^0-9]/", "", $clock[0]);
    $Time["minute"] = preg_replace("/[^0-9]/", "", $clock[1]);
    $Time["second"] = preg_replace("/[^0-9]/", "", $clock[2]);


    echo json_encode($Time, JSON_PRETTY_PRINT);
?>