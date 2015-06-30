<?php

require_once('class.base.php');

class Artwork extends Base {
    
    public function asArray() {

    }
    
}

class ArtworkDao extends BaseDao {

    public static $Database = '/var/www/backend/db/artwork_database.xml';

    public function GET($verb, $args) {

        if ($verb == '') {

            $queryStr = "
                \n for \$artwork in doc('".Artwork::$Database."')//artwork
                \n let \$name := \$artwork/name/text()
                \n let \$year := \$artwork/year/text()
                \n return
                \n <artwork year='{\$year}'>{\$name}</artwork>
            ";

            $query = $this->_zorba->compileQuery($queryStr);
            $result = $query->execute();
            $query->destroy();

            return $result;

        }

        return;
    }
}
