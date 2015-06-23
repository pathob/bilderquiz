<?php

require_once('class.base.php');

class Person extends Base {

    public function __construct() {
        parent::__construct('db/person_database.xml');
    }

    public function GET($verb, $args) {

        if ($verb == '') {
            // Todo
        }

        return;
    }
}

?>
