<?php

require_once('class.base.php');

class Artwork extends Base {

    public function __construct() {
        parent::__construct('db/artwork_database.xml');
    }

    public function GET($verb, $args) {

        if ($verb == '') {
            // Todo
        }

        return;
    }
}

?>
