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
 
   SELECT ?artwork,?thumbnail,?name,?year,?abstract,?wikilink,?type
   WHERE {
	 ?artwork a dbpedia-owl:Artwork.
	 ?artwork dbpedia-owl:thumbnail ?thumbnail.
	 ?artwork foaf:name ?name.
	 ?artwork dbpedia-owl:author ?author. 
	 ?author prov:wasDerivedFrom ?id.
	 OPTIONAL{
		?artwork dbpprop:year ?year
	 }
	 
	 OPTIONAL{
		?artwork dbpedia-owl:abstract ?abstract
		FILTER(LANG(?abstract)="de")
	 }
	 
	 OPTIONAL{
		?artwork dbpedia-owl:abstract ?abstract
		FILTER(LANG(?abstract)="de")
	 }
	 
	 OPTIONAL{
		?artwork prov:wasDerivedFrom ?wikilink
	 }
	 
	 OPTIONAL{
		?artwork dbpprop:type ?type
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
	return removeDuplicates($jsonResult->results->bindings,"artwork");
   }else{
	return array();
   }
}



function getBuildings($dbpid)
{
   $format = 'json';
 
   $query = 
   'PREFIX dbp: <http://dbpedia.org/resource/>
   PREFIX dbp2: <http://dbpedia.org/ontology/>
 
   SELECT ?building,?name,?architect,?thumbnail,?wikilink,?location,?built,?abstract
   WHERE {
	 ?building a dbpedia-owl:ArchitecturalStructure.
	 ?building dbpedia-owl:thumbnail ?thumbnail.
	 ?building prov:wasDerivedFrom ?wikilink.
	 ?building dbpedia-owl:architect ?architect.
	 
	 OPTIONAL{
		?building foaf:name ?name.
	 }
	 OPTIONAL{
		?building dbpedia-owl:location ?location.
	 }
	 
	 OPTIONAL{
		?building dbpprop:built ?built.
	 }
	 OPTIONAL{
		?building dbpedia-owl:abstract ?abstract
		FILTER(LANG(?abstract)="de")
	 }
	 
	 FILTER( ?architect =<'.$dbpid.'>)
   }
   LIMIT 1000';
   $searchUrl = 'http://dbpedia.org/sparql?'
      .'query='.urlencode($query)
      .'&format='.$format;
   $dbPediaResult=DDPediaRequest($searchUrl);
   $jsonResult = json_decode($dbPediaResult);
 if(property_exists($jsonResult,"results") && property_exists($jsonResult->results,"bindings")
   &&count($jsonResult->results->bindings)>0){
	return removeDuplicates($jsonResult->results->bindings,"building");
   }else{
	return array();
   }
}

function getBooks($dbpid)
{
   $format = 'json';
 
   $query = 
   'PREFIX dbp: <http://dbpedia.org/resource/>
   PREFIX dbp2: <http://dbpedia.org/ontology/>
 
   SELECT ?book,?author,?thumbnail,?published,?released,?wikilink,?abstract
   WHERE {
	 ?book a dbpedia-owl:Book.
	 ?book dbpedia-owl:author ?author.
	 ?book foaf:name ?name.
	 ?book prov:wasDerivedFrom ?wikilink.
	 OPTIONAL{
		?book dbpprop:published ?published.
	 }
	 OPTIONAL{
		?book dbpprop:releaseDate ?released.
	 }
	 OPTIONAL{
		?book dbpedia-owl:thumbnail ?thumbnail.
	 }
	  OPTIONAL{
		?book dbpedia-owl:abstract ?abstract
		FILTER(LANG(?abstract)="de")
	 }
	 
	 FILTER(?author=<'.$dbpid.'>)
   }
   LIMIT 100';
   $searchUrl = 'http://dbpedia.org/sparql?'
      .'query='.urlencode($query)
      .'&format='.$format;
   $dbPediaResult=DDPediaRequest($searchUrl);
   $jsonResult = json_decode($dbPediaResult);
 if(property_exists($jsonResult,"results") && property_exists($jsonResult->results,"bindings")
   &&count($jsonResult->results->bindings)>0){
	return removeDuplicates($jsonResult->results->bindings,"book");
   }else{
	return array();
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

function removeDuplicates($duplArray,$keyName){
	$duplicate_check =array();
	$count = count($duplArray);
	for($i=0;$i<$count;$i++){
		$curKey =$duplArray[$i]->{$keyName}->value;
		if(array_key_exists ( $curKey, $duplicate_check )){
			unset($duplArray[$i]);
		}else{
			$duplicate_check[$curKey]=1;
		}
		
		
	}
	
	return array_values($duplArray);

}


?>

