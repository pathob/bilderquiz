<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>DDBRest</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<pre>
<?php
    function httpGet($url, array $properties = array()) {
        $header = array();
        foreach ($properties as $key => $value) {
            array_push($header, $key . ": " . $value);
        }
        $curl = curl_init();
         
        //WARNING: following two lines would prevent curl from detecting 'man in the middle' attacks
        // To make this save please store the DDB certificate locally! Something like:
        // curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, true);
        // curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, true);
        // curl_setopt ($curl, CURLOPT_CAINFO, "pathto/api.deutsche-digitale-bibliothek.de.pem");
        curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, false);
         
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
         
        if(curl_getinfo($curl, CURLINFO_HTTP_CODE) != 200) {
          //  trigger_error(curl_error($curl));
		  //200 bedeutet Request erfüllt
        }
        curl_close($curl);
        return $result;
    }
  
     // URL of DDB server with dataset ID and requested method

    $key = "cMeglC4m7WMTHlMyrikrrdYXJf6r6hwSezLt2aIsYQBoJ1wxgTB1433178253432";
 
	//SEARCH REQUEST
 
    /*Search request hier am beispiel der personensuche. Man kann auch category:Kultur 
	oder professionOrOccupation:[Berufe] wählen. Kurz gesagt man kann nach allen inhalten des 
	antwort json objektes filtern*/
	
	$url = "https://api.deutsche-digitale-bibliothek.de/search?query=type:person";
    $httpResult = httpGet($url,
            array("Authorization" => "OAuth oauth_consumer_key=\"" . $key . "\""));
    echo htmlentities($httpResult, ENT_QUOTES, "UTF-8") . "\n";
	
	//VOLLTEXTSUCHE
	
	/*$url = "https://api.deutsche-digitale-bibliothek.de/search?query=GOETHE";
    $httpResult = httpGet($url,
            array("Authorization" => "OAuth oauth_consumer_key=\"" . $key . "\""));
    echo htmlentities($httpResult, ENT_QUOTES, "UTF-8") . "\n";
	*/
	// ENTITY REQUEST
	
	/*$url = "https://api.deutsche-digitale-bibliothek.de/entities?query=type:person'";
    $httpResult = httpGet($url,
            array("Authorization" => "OAuth oauth_consumer_key=\"" . $key . "\"","Accept" => "application/json"));
    echo htmlentities($httpResult, ENT_QUOTES, "UTF-8") . "\n";*/
	
	//ITEM REQUEST
	
	//items request hier die view variante, dass sind die daten die die Bibliothek bei ihrer standard suche anzeigt
	
	/*$url = "https://api.deutsche-digitale-bibliothek.de/items/OAXO2AGT7YH35YYHN3YKBXJMEI77W3FF/view";
	
	$httpXmlResult = httpGet($url,
            array("Authorization" => "OAuth oauth_consumer_key=\"" . $key . "\"","Accept" => "application/json"));
    echo htmlentities($httpXmlResult, ENT_QUOTES, "UTF-8") . "\n";*/
	
	//hier die edm variante
	
	/*$url = "https://api.deutsche-digitale-bibliothek.de/items/OAXO2AGT7YH35YYHN3YKBXJMEI77W3FF/edm";
	
	$httpXmlResult = httpGet($url,
            array("Authorization" => "OAuth oauth_consumer_key=\"" . $key . "\"","Accept" => "application/xml"));
    echo htmlentities($httpXmlResult, ENT_QUOTES, "UTF-8") . "\n";*/
	
  
?>
</pre>
</body>
</html>