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

            $queryStr = '
                \n import module namespace r = "http://www.zorba-xquery.com/modules/random";
                \n for \$person in doc("'.PersonDao::$Database.'")//person
                \n let \$rows := count(\$person)
                \n let \$rand := r:random-between(1, \$rows)
                \n let \$name := \$person[\$rand]/name/text()
                \n let \$personID := \$person/personID/@ID
                \n return
                \n <person id="{\$personID}">{\$name}</person>
            ';

            $query = $this->_zorba->compileQuery($queryStr);
            $result = $query->execute();
            echo $result;
            $query->destroy();

        }

        return;
    }
}
