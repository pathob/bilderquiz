<?php

// require_once('class.base.php');

class Question /* extends Base */ {

//    public function __construct() {
//        parent::__construct();
//    }

    public function GET($verb, $args) {

        // return random querstion
        if ($verb == '') {

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

            // JSON Objekt hier´zusammenbasteln

            return $questions[rand(0, sizeof($questions)-1)];
        }

		return;
	}
}
