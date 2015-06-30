<?php

require_once('class.base.php');

class Person extends Base {
    
    public function asArray() {

    }
    
}

class PersonDao extends BaseDao {

    public static $Database = '/var/www/backend/db/person_database.xml';

    public function GET($verb, $args) {

        if ($verb == '') {

            $queryStr = "
                \n for \$person in doc('".Person::$Database."')//person
                \n let \$name := \$person/name/text()
                \n let \$personID := \$person/personID/@ID
                \n return
                \n <person id='{\$personID}'>{\$name}</person>
            ";

            $query = $this->_zorba->compileQuery($queryStr);
            $result = $query->execute();
            echo $result;
            $query->destroy();

        }

        return;
    }
}
