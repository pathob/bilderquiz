<?php

require_once('class.base.php');
require_once('class.artwork.php');

class Question extends Base {

    public function GET($verb, $args) {

        // return random question
        if ($verb == 'random') {
            $artwork = new Artwork();
            $rand = rand(0, 1);
            switch ($rand) {
                case 0: return $this->xmlToJson($artwork->GET("year", $args));
                case 1: return $this->xmlToJson($artwork->GET("name", $args));
            }
        }

        return;
    }

    private function xmlToJson($xml) {
        $q = simplexml_load_string(utf8_encode($xml));
        return json_encode($q);
    }

}
