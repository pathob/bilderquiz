<?php

require_once('class.base.php');

class Artwork extends Base {
    
    public function asArray() {

    }
    
}

class ArtworkDao extends BaseDao {

    public static $ArtworksDatabase = '/var/www/backend/db/artworks_database.xml';
    public static $PersonsDatabase = '/var/www/backend/db/persons_database.xml';

    public function GET($verb, $args) {

        if ($verb == 'yearQuestion') {

            $queryStr = "
				import module namespace r = \"http://zorba.io/modules/random\";
				for \$artworks in doc(".ArtworkDao::$ArtworksDatabase.")/artworks,
				  \$persons in doc(".ArtworkDao::$PersonsDatabase.")/persons
				let \$artwork := \$artworks/artwork[matches(year/text(), '^[0-9][0-9][0-9][0-9]\$')]
				let \$rows := count(\$artwork)
				let \$rand0 := r:random-between(\$rows -1)+1
				let \$rand1 := r:random-between(\$rows -1)+1
				let \$rand2 := r:random-between(\$rows -1)+1
				let \$rand3 := r:random-between(\$rows -1)+1
				let \$id := \$artwork[\$rand0]/personID/@ID
				let \$painter := \$persons/person[personID[@ID=\$id]]/name/text()

				return ('{\"question\":\"Aus welchem Jahr stammt dieses Bild?\",\"hint\":\"Das Bild ist von ',\$painter,'.\",\"image\":\"',\$artwork[\$rand0]/thumbnail/text(),'\",\"answers\":{\"rightAnswer\":',\$artwork[\$rand0]/year/text(),',\"wrongAnswer1\":',\$artwork[\$rand1]/year/text(),',\"wrongAnswer2\":',\$artwork[\$rand2]/year/text(),',\"wrongAnswer3\":',\$artwork[\$rand3]/year/text(),'}}')
            ";

            $query = $this->_zorba->compileQuery($queryStr);
            $result = $query->execute();
            $query->destroy();

            return $result;

        }

        return;
    }
}
