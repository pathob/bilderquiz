<?php 



function getPersonMetaData($person)
{
   $format = 'json';
 
   $query = 
   'PREFIX dbp: <http://dbpedia.org/resource/>
   PREFIX dbp2: <http://dbpedia.org/ontology/>
 
   SELECT ?person,?abstract,?wikilink,?dbid
   WHERE {
	 ?person a dbpedia-owl:Person.
	 ?person dbpedia-owl:abstract ?abstract.
	 ?person foaf:name ?name.
	 ?person prov:wasDerivedFrom ?wikilink.
	 FILTER (LANG(?abstract)="de" &&(?name = "'.$person.'"@en || ?name = "'.$person.'"@de)) 
   }
   LIMIT 1';
 
   $searchUrl = 'http://dbpedia.org/sparql?'
      .'query='.urlencode($query)
      .'&format='.$format;
   $jsonResult = json_decode(DDPediaRequest($searchUrl));
 
  if(property_exists($jsonResult,"results") && property_exists($jsonResult->results,"bindings")
   &&count($jsonResult->results->bindings)>0){
	return $jsonResult->results->bindings[0];
   }else{
	return null;
   }
}

function getArtworks($personURI){
   $format = 'json';
 
   $query = 
   'PREFIX dbp: <http://dbpedia.org/resource/>
   PREFIX dbp2: <http://dbpedia.org/ontology/>
 
   SELECT ?painting,?thumbnail,?name,?year,?abstract,?wikilink
   WHERE {
	 ?painting a dbpedia-owl:Artwork.
	 ?painting dbpedia-owl:thumbnail ?thumbnail.
	 ?painting foaf:name ?name.
	 ?painting dbpedia-owl:author ?author. 
	 ?author prov:wasDerivedFrom ?id.
	 OPTIONAL{
		?painting dbpprop:year ?year
	 }
	 
	 OPTIONAL{
		?painting dbpedia-owl:abstract ?abstract
		FILTER(LANG(?abstract)="de")
	 }
	 
	 OPTIONAL{
		?painting prov:wasDerivedFrom ?wikilink
	 }
	 

	 FILTER (?id=<'.$personURI.'>)
   }
   LIMIT 1000';
 
   $searchUrl = 'http://dbpedia.org/sparql?'
      .'query='.urlencode($query)
      .'&format='.$format;
  $jsonResult = json_decode(DDPediaRequest($searchUrl));
  
 
   if(property_exists($jsonResult,"results") && property_exists($jsonResult->results,"bindings")
   &&count($jsonResult->results->bindings)>0){
	return $jsonResult->results->bindings;
   }else{
	return null;
   }
}

function DDPediaRequest($url){
 
   if (!function_exists('curl_init')){ 
      die('CURL is not installed!');
   }
 
 
   $ch= curl_init();
 
  
   curl_setopt($ch, 
      CURLOPT_URL, 
      $url);
 
 
   curl_setopt($ch, 
      CURLOPT_RETURNTRANSFER, 
      true);
 
  
 
   $response = curl_exec($ch);
 
   curl_close($ch);
 
   return $response;
}


?>
 

</html>
