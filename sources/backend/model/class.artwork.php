<?php

require_once('class.base.php');

class Artwork extends Base {

    public function __construct() {
        echo "artwork __construct";
        parent::__construct('artwork_database.xml');
    }

    public function GET($verb, $args) {

        if ($verb == '') {

            /*
            $queryStr = <<< END
                for \$artwork in doc('artwork_database.xml')//artwork
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
            */

            $questions = array(
                array(
                    'key' => 'value',
                    'bla' => 'blubb',
                ),
                array(
                    'key' => 'othervalue',
                    'bla' => 'bulbb',
                ),
            );

            return $questions[rand(0, sizeof($questions)-1)];

        }

        return;
    }
}
