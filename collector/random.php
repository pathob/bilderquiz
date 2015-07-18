<?php

	
require_once "XML/Unserializer.php";
function randomPerson()
{	
	$dir = 'collectedData';
    $files = glob($dir . '/*.*');
    $file = array_rand($files);
	
	$us = new XML_Unserializer();
	$options = array(
		XML_UNSERIALIZER_OPTION_TAG_MAP         => array( 'util' => 'XML_Util' ),
		XML_UNSERIALIZER_OPTION_ATTRIBUTE_CLASS => '_classname'
	);

	$us->setOptions($options);
	$us->setOption(XML_UNSERIALIZER_OPTION_COMPLEXTYPE, 'object');
	$result = $us->unserialize($files[$file], true);
    return $us->_unserializedData;
}
function randomWithArtworks(){
	while(true){
		$data =randomPerson();
		if(count($data->artworks)>0){
			return $data;
		}
	}
}
function randomWithBuildings(){
	while(true){
		$data =randomPerson();
		if(count($data->buildings)>0){
			return $data;
		}
	}
}

var_dump(randomWithBuildings());
?>