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
                array(
                    'question' => 'Aus welchem Land stammt dieses Bild?',
                    'hint'     => 'Der Autor ist im jahre 1881 geboren.',
                    'image'    => 'img/picasso_1.jpg',
                    'answers'  => array(
                        'rightAnswer'  => 'Spanien',
                        'wrongAnswer1' => 'Deutschland',
                        'wrongAnswer2' => 'Lettland',
                        'wrongAnswer3' => 'Argentinien',
                    ),
                ),
                array(
                    'question' => 'Welchen Titel hat dieses Bild?',
                    'hint'     => 'Das Bild ist von Pablo Picasso.',
                    'image'    => 'img/boy_leading_horse.jpg',
                    'answers'  => array(
                        'rightAnswer'  => 'Boy Leading a Horse',
                        'wrongAnswer1' => 'Femme aux Bras Croisés',
                        'wrongAnswer2' => 'Family of Saltimbanques',
                        'wrongAnswer3' => 'oil on canvas',
                    ),
                ),
                array(
                    'question' => 'Aus welchem Jahr stammt dieses Bild?',
                    'hint'     => 'Das Bild ist von Pablo Picasso.',
                    'image'    => 'img/ma_jolie.jpg',
                    'answers'  => array(
                        'rightAnswer'  => '1914',
                        'wrongAnswer1' => '1925',
                        'wrongAnswer2' => '1900',
                        'wrongAnswer3' => '1944',
                    ),
                ),
                array(
                    'question' => 'Welche Besonderheit hat dieses Bild?',
                    'hint'     => 'Das Bild ist von Pablo Picasso.',
                    'image'    => 'img/oil_painting.jpg',
                    'answers'  => array(
                        'rightAnswer'  => 'Öl auf Leinwand',
                        'wrongAnswer1' => 'Öl auf Holz',
                        'wrongAnswer2' => 'Pastellkreiden auf Karton',
                        'wrongAnswer3' => 'Wachsfarben auf Holz',
                    ),
                ),
            );

            return $questions[rand(0, sizeof($questions)-1)];
        }

		return;
	}
}
