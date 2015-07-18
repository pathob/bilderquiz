<?php

require_once('class.base.php');
require_once('class.person.php');

class Artwork extends Base {

    public static $Database = '/var/www/backend/db/artworks_database.xml';
	
    public function GET($verb, $args) {

        if ($verb == 'year') {

            $queryStr = "
				import module namespace r = \"http://www.zorba-xquery.com/modules/random\";
				for \$artworks in doc('".Artwork::$Database."')/artworks,
					\$persons in doc('".Person::$Database."')/persons
 				let \$artwork := \$artworks/artwork[matches(year/text(), '^[0-9][0-9][0-9][0-9]\$')]
 				let \$rows := count(\$artwork)
				let \$rand0 := r:random-between(1, \$rows)
				let \$rand1 := r:random-between(1, \$rows)
				let \$rand2 := r:random-between(1, \$rows)
				let \$rand3 := r:random-between(1, \$rows)
 				let \$id := \$artwork[\$rand0]/personID/@ID
 				let \$painter := \$persons/person[personID[@ID=\$id]]/name/text()
                return <q><question>Aus welchem Jahr stammt dieses Bild?</question><hint>Das Bild ist von {\$painter}.</hint><image>{\$artwork[\$rand0]/thumbnail/text()}</image><answers><rightAnswer>{\$artwork[\$rand0]/year/text()}</rightAnswer><wrongAnswer1>{\$artwork[\$rand1]/year/text()}</wrongAnswer1><wrongAnswer2>{\$artwork[\$rand2]/year/text()}</wrongAnswer2><wrongAnswer3>{\$artwork[\$rand3]/year/text()}</wrongAnswer3></answers><wikilink>{\$artwork[\$rand0]/abstract/text()}</wikilink></q>
            ";
			
            $query = $this->_zorba->compileQuery($queryStr);
            $result = $query->execute();
            $query->destroy();

            return $this->jsonencode($result);

        }

        if ($verb == 'name') {

            $queryStr = "
				import module namespace r = \"http://www.zorba-xquery.com/modules/random\";
				for \$artworks in doc('".Artwork::$Database."')/artworks,
					\$persons in doc('".Person::$Database."')/persons
 				let \$artwork := \$artworks/artwork
 				let \$rows := count(\$artwork)
				let \$rand0 := r:random-between(1, \$rows)
				let \$rand1 := r:random-between(1, \$rows)
				let \$rand2 := r:random-between(1, \$rows)
				let \$rand3 := r:random-between(1, \$rows)
 				let \$id := \$artwork[\$rand0]/personID/@ID
 				let \$painter := \$persons/person[personID[@ID=\$id]]/name/text()
                return <q><question>Wie heiﬂt dieses Bild?</question><hint>Das Bild ist von {\$painter}.</hint><image>{\$artwork[\$rand0]/thumbnail/text()}</image><answers><rightAnswer>{\$artwork[\$rand0]/name/text()}</rightAnswer><wrongAnswer1>{\$artwork[\$rand1]/name/text()}</wrongAnswer1><wrongAnswer2>{\$artwork[\$rand2]/name/text()}</wrongAnswer2><wrongAnswer3>{\$artwork[\$rand3]/name/text()}</wrongAnswer3></answers><wikilink>{\$artwork[\$rand0]/abstract/text()}</wikilink></q>
            ";

            $query = $this->_zorba->compileQuery($queryStr);
            $result = $query->execute();
            $query->destroy();

            return $result;

        }

        return;
    }

    public function jsonencode($text) {
        return substr( $text, strpos($text, "\n")+1 );
    }
}
