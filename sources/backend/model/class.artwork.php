<?php

require_once('class.base.php');

class Artwork extends Base {

    public function __construct() {
        parent::__construct('db/artwork_database.xml');
    }

    public function GET($verb, $args) {

        if ($verb == '') {
            $queryStr = <<< END
                for \$artwork in doc('db/artwork_database.xml')//artwork
                let \$name := \$artwork/name/text()
                let \$year := \$artwork/year/text()
                return
                <artwork year="{\$year}">{\$name}</name>
END;
            $query = $this->_zorba->compileQuery($queryStr);
            // execute query and display result
            $result = $query->execute();
            echo $result;
            $query->destroy();
        }

        return;
    }
}
