<?php 

include_once("DBPediaRequests.php");
include_once("DDBrequests.php");
include_once("XML/Serializer.php");


global $personCount,$sculptureCount,$paintingCount;

function runMiner(){
	$GLOBALS['personCount']=0;
	$GLOBALS['artworkCount']=0;
	$GLOBALS['buildingCount']=0;
	$GLOBALS['bookCount']=0;


	set_time_limit(0);
	echo "start datensammlung<br>";
	$key = "";
	$professions=array();
	$professions[0]="Maler";
	//collect Maler
	$persons =getPersonWithProfession($professions,$key);
	createXmlFromPersons($persons);
	
	$professions[0]="Bildhauer";
	//collect Bildhauer
	$persons =getPersonWithProfession($professions,$key);
	createXmlFromPersons($persons);
	
	$professions[0]="Architekt";
	//collect Architekt
	$persons =getPersonWithProfession($professions,$key);
	createXmlFromPersons($persons);
	
	$professions[0]="Baumeister";
	//collect Baumeister
	$persons =getPersonWithProfession($professions,$key);
	createXmlFromPersons($persons);
	
	$professions[0]="Autor";
	//collect Autor
	$persons =getPersonWithProfession($professions,$key);
	createXmlFromPersons($persons);

	
	$professions[0]="Künstler";
	//collect Künstler
	$persons =getPersonWithProfession($professions,$key);
	createXmlFromPersons($persons);
	
	$professions[0]="Lyriker";
	//collect Lyriker
	$persons =getPersonWithProfession($professions,$key);
	createXmlFromPersons($persons);
	
	
	$professions[0]="Philosoph";
	//collect Philosoph
	$persons =getPersonWithProfession($professions,$key);
	createXmlFromPersons($persons);
	
	$professions[0]="Philosophin";
	//collect Philosophin
	$persons =getPersonWithProfession($professions,$key);
	createXmlFromPersons($persons);
	
	
	$professions[0]="Schriftsteller";
	//collect Schriftsteller
	$persons =getPersonWithProfession($professions,$key);
	createXmlFromPersons($persons);
	
	$professions[0]="Schriftstellerin";
	//collect Schriftstellerin
	$persons =getPersonWithProfession($professions,$key);
	createXmlFromPersons($persons);
	

	echo "<br>Persons: ".$GLOBALS['personCount']."<br>";
	echo "<br>Artworks: ".$GLOBALS['artworkCount']."<br>";
	echo "<br>Buildings: ".$GLOBALS['buildingCount']."<br>";
	echo "<br>Books: ".$GLOBALS['bookCount']."<br>";

	
}


function createXmlFromPersons($persons){
	$count=0;
	foreach($persons as $person){
		$persObj = new Person();
			
			
		if(property_exists($person,"preferredName")){
			$persObj->name = $person->preferredName;
		}else{
			continue;
		}
		
		$path="collectedData/".$persObj->name.".xml";
		if(file_exists($path)){
			continue;
		}
		
		if(property_exists($person,"variantName")){
			$persObj->variantName = $person->variantName;
		}
			
		if(property_exists($person,"thumbnail")){
			$persObj->thumbnail = $person->thumbnail;
		}else{
			continue;
		}
		if(property_exists($person,"dateOfBirth_en")){
			$persObj->birthEN = $person->dateOfBirth_en;
		}
			
		if(property_exists($person,"dateOfBirth_de")){
			$persObj->birthDE = $person->dateOfBirth_de;
		}
		if(property_exists($person,"dateOfDeath_en")){
			$persObj->deathEN = $person->dateOfDeath_en;
		}
			
		if(property_exists($person,"dateOfDeath_de")){
			$persObj->deathDE = $person->dateOfDeath_de;
		}
		if(property_exists($person,"placeOfBirth")){
			$persObj->birthPlace = $person->placeOfBirth;
		}
		if(property_exists($person,"placeOfDeath")){
			$persObj->deathPlace = $person->placeOfDeath;
		}
		if(property_exists($person,"professionOrOccupation")){
			$persObj->professionOrOccupation = $person->professionOrOccupation;
		}

		$metadata=getPersonMetaData($persObj->name);
		if($metadata==null){
			continue;
		}
	
		$persObj->dbpResource = $metadata->person->value;
		$persObj->abstract=$metadata->abstract->value;
		$persObj->wikilink=$metadata->wikilink->value;
		
		$persObj->artworks=getArtworks($persObj->wikilink);
		$persObj->buildings=getBuildings($persObj->dbpResource);
		$persObj->books=getBooks($persObj->dbpResource);
		
	
		
		
		
		$xml = obj_to_xml($persObj);
		
		
		if($xml!= null){
			$file= fopen($path, "w");
			fwrite($file, $xml);
			fclose($file);
		}else{
			continue;
		}
	
	
	$GLOBALS['personCount']++;
	$GLOBALS['artworkCount']+=count($persObj->artworks);
    $GLOBALS['buildingCount']+=count($persObj->buildings);
	$GLOBALS['bookCount']+=count($persObj->books);
			
	}
	
	

}
function obj_to_xml($obj) {
    $serializer = new XML_Serializer();

    if ($serializer->serialize($obj)) {
        return $serializer->getSerializedData();
    }
    else {
        return null;
    }
}
class Person{

public $name;
public $variantName;
public $thumbnail;
public $birthEN;
public $birthDE;
public $deathEN;
public $deathDE;
public $birthPlace;
public $deathPlace;
public $professionOrOccupation;
public $dbpResource;
public $abstract;
public $wikilink;
public $artworks;
public $buildings;
public $books;

}


runMiner();
?>