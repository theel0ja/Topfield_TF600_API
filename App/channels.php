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
    $Channels = array();

    $url = $settings["url"] . "TimerNewEntryForm.htm";
    $file = file_get_contents($url);
    
    $var = $file;
    $var = explode("<!-- Service Select -->", $var);
    $var = $var[1];
    
    $var = explode("<!-- Mode Select", $var);
    $var = $var[0];

    $var = explode('<SELECT NAME = "Service" OnChange = "InitializeFileName()">', $var);
    $var = $var[1];

    $var = explode('</SELECT>', $var);
    $var = $var[0];

    $var = str_replace("		", "", $var); # Remove tabs

    # Now it looks like this:
        # <OPTION VALUE = "0">1. Yle TV1</OPTION>
        # <OPTION VALUE = "1">2. Yle TV2</OPTION>
        # <OPTION VALUE = "2">3. MTV3</OPTION>
	    # <OPTION VALUE = "3">4. Nelonen</OPTION>

    $var = explode("</OPTION>", $var);
    # Now it looks like this:
        # [0] => 
        #   
	    # <OPTION VALUE = "0">1. Yle TV1
        # [1] => 
	    # <OPTION VALUE = "1">2. Yle TV2
        # [2] => 
	    # <OPTION VALUE = "2">3. MTV3

    $count = count($var);

    for ($i = 0; $i <= $count; $i++) {
        if( isset($var[$i]) ) {
            
            $var[$i] = explode( '<OPTION VALUE = "' . $i . '">', $var[$i] );
            
            if(isset($var[$i][1])) {
                $nyk = $var[$i][1];
                
                $nyk = explode(". ", $nyk);
                
                //echo ',"' . $nyk[0] . '": {"ch": "' . $nyk[0] . '", "' . $nyk[1] . '"}';
                
                if($nyk[1] != "Not Displayable") {
                    $Channels[ $nyk[0] ]["id"] = $nyk[0];
                    $Channels[ $nyk[0] ]["name"] = $nyk[1];
                }
            }
            
            /*if($var[$i] == "") {
                unset($var[$i]);
            }*/
            
            
        }
    }

    echo json_encode($Channels, JSON_PRETTY_PRINT);
?>