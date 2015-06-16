<?php 

include_once("DBPediaRequests.php");
include_once("DDBrequests.php");
include_once("XML/Serializer.php");


function runMiner(){
	set_time_limit(0);
	echo "start datensammlung<br>";
	$key = "";
	$professions=array();
	$professions[0]="maler";
	$persons =getPersonWithProfession($professions,$key);
	
	
	
	createXmlFromPersons($persons);
	
	//collect Maler
	
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
		
		$path="collectedData/".$persObj->name.".xml";
		$i=0;
		while(file_exists($path)){
			$path="collectedData/".$persObj->name."$i.xml";
			$i++;
		}
		
		$xml = obj_to_xml($persObj);
		
		
		
		$file= fopen($path, "w");
		fwrite($file, $xml);
		fclose($file);
	
		
		$count++;
			
	}
	
	echo"<br>$count Datensaetze hinzugefuegt.<br>";

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
public $artworks;
public $dbpResource;
public $abstract;
public $wikilink;

}


runMiner();
?>