<?php

require_once('class.base.php');

class Question extends Base {
    
    protected $_question;
    protected $_hint;
    protected $_image;
    protected $_rightAnswer;
    protected $_wrongAnswer1;
    protected $_wrongAnswer2;
    protected $_wrongAnswer3;
    
    public function __construct(
            $question,
            $hint,
            $image,
            $rightAnswer,
            $wrongAnswer1,
            $wrongAnswer2,
            $wrongAnswer3) {
                
        $this->_question = $question;
        $this->_hint     = $hint;
        $this->_image    = $image;
        $this->_rightAnswer  = $rightAnswer;
        $this->_wrongAnswer1 = $wrongAnswer1;
        $this->_wrongAnswer2 = $wrongAnswer2;
        $this->_wrongAnswer3 = $wrongAnswer3;
    }
    
    public function getInstanceFromStringArray($stringArray) {
        if (sizeof($stringArray == 7)) {
            return new self(
                $stringArray[0],
                $stringArray[0],
                $stringArray[0],
                $stringArray[0],
                $stringArray[0],
                $stringArray[0],
                $stringArray[0]
            );
        }
        return null;
    }
    
    public function getInstanceFromString($string) {
        return getInstanceFromStringArray(explode(";", $string));
    }
    
    public function asArray() {
        return array(
            'question' => $this->_question,
            'hint'     => $this->_hint,
            'image'    => $this->_image,
            'answers'  => array(
                'rightAnswer'  => $this->_rightAnswer,
                'wrongAnswer1' => $this->_wrongAnswer1,
                'wrongAnswer2' => $this->_wrongAnswer2,
                'wrongAnswer3' => $this->_wrongAnswer3,
            ),
        );
    }   
}

class QuestionDao extends BaseDao {

    public function GET($verb, $args) {

        // return random querstion
        if ($verb == 'random') {

            $questions = array(
                new Question(
                    'Aus welchem Land stammt dieses Bild?',
                    'Der Autor ist im jahre 1881 geboren.',
                    'img/picasso_1.jpg',
                    'Spanien',
                    'Deutschland',
                    'Lettland',
                    'Argentinien',
                ),
                new Question(
                    'Welchen Titel hat dieses Bild?',
                    'Das Bild ist von Pablo Picasso.',
                    'img/boy_leading_horse.jpg',
                    'Boy Leading a Horse',
                    'Femme aux Bras Croisés',
                    'Family of Saltimbanques',
                    'oil on canvas',
                ),
                array(
                    'Aus welchem Jahr stammt dieses Bild?',
                    'Das Bild ist von Pablo Picasso.',
                    'img/ma_jolie.jpg',
                    '1914',
                    '1925',
                    '1900',
                    '1944',
                ),
                array(
                    'Welche Besonderheit hat dieses Bild?',
                    'Das Bild ist von Pablo Picasso.',
                    'img/oil_painting.jpg',
                    'Öl auf Leinwand',
                    'Öl auf Holz',
                    'Pastellkreiden auf Karton',
                    'Wachsfarben auf Holz',
                ),
            );

            return $questions[rand(0, sizeof($questions)-1)].asArray();
        }

		return;
	}
}
