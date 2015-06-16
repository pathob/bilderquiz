<?php
	function getPersonWithProfession($profession,$key){
	
	
	$url = "https://api.deutsche-digitale-bibliothek.de/entities?rows=10000&query=professionOrOccupation:".str_replace("\"", "", json_encode($profession));

    $httpResult = httpGet($url,
            array("Authorization" => "OAuth oauth_consumer_key=\"" . $key . "\""));	
    $resultJson=json_decode($httpResult);
	if(property_exists($resultJson,"results") && 
	count($resultJson->results)>0 &&
	property_exists($resultJson->results[0],"docs")){
		$results = $resultJson->results[0]->docs;
	}else{
		$results = array();
	}
 
	return $results;
}
	
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
?>
</pre>
</body>