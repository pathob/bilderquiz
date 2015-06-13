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
	
	$url = "https://api.deutsche-digitale-bibliothek.de/entities?query=type:person";
    $httpResult = httpGet($url,
            array("Authorization" => "OAuth oauth_consumer_key=\"" . $key . "\""));	
    $resultJson=json_decode($httpResult);
	$results = $resultJson->results[0]->docs;
	
	
	
	
	
	
	
	$i=0;
	$result =array();
	$alreadyFound=array();
	$keyCount =array();
	foreach($results as $person){
	$allKeys =array_keys((array)$person);
	foreach($allKeys as $key){
		if(array_key_exists($key,$keyCount)){
		  $keyCount[$key]++;
		}else{
		  $keyCount[$key]=1;
		}
	}
	foreach($person->professionOrOccupation as $profession){
			
			if(!(array_key_exists($profession,$alreadyFound))){
				$alreadyFound[$profession]=1;
				$result[$i]=$profession;
				$i++;
			}
		}
		
	}
	echo "Person count: ".count($results)."<br><br>";
	echo "Occurance of person attributes:<br>";
	
	foreach($keyCount as $key => $values){
		echo "$key:$values<br>";
	}
	
	echo "<br><br> Collected professions:<br><br>";
	sort($result);
	foreach($result as $profession){
		echo $profession."<br>";
	}

  
?>
</pre>
</body>