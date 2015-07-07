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
                    'Welchen Titel hat dieses Bild?',
                    'Das Bild ist von Pablo Picasso.',
                    'img/boy_leading_horse.jpg',
                    'Boy Leading a Horse',
                    'Femme aux Bras Crois�s',
                    'Family of Saltimbanques',
                    'oil on canvas'
                ),
                new Question(
                    'Aus welchem Jahr stammt dieses Bild?',
                    'Das Bild ist von Pablo Picasso.',
                    'img/ma_jolie.jpg',
                    '1914',
                    '1925',
                    '1900',
                    '1944'
                ),
                new Question(
                    'Aus welchem Jahr stammt dieses Bild?',
                    'Das Bild ist von Adam Elsheimer.',
                    'img/fluchtnachaegypten.jpg',
                    '1609',
                    '1902',
                    '1822',
                    '1855'
                ),
                new Question(
                    'Aus welchem Jahr stammt dieses Bild?',
                    'Das Bild ist von Albrecht Altdorfer.',
                    'img/altdorfer.jpg',
                    '1520',
                    '1944',
                    '1609',
                    '1960'
                ),
                new Question(
                    'Welchen Titel hat dieses Bild?',
                    'Das Bild ist von Alexandre Cabanel.',
                    'img/venus_birth.jpg',
                    'The Birth of Venus',
                    'San Zeno Altarpiece',
                    'Parnassus',
                    'St. Bernardino of Siena between Two Angels'
                ),
                new Question(
                    'Welchen Titel hat dieses Bild?',
                    'Das Bild ist von Andrea Mantegna.',
                    'img/andrea.jpg',
                    'Portrait of Francesco Gonzaga',
                    'Presentation at the Temple',
                    'Triumph of the Virtues',
                    'St. Bernardino of Siena between Two Angels'
                ),
                new Question(
                    'Welchen Titel hat dieses Bild?',
                    'Das Bild ist von Andrea Mantegna.',
                    'img/madonna.jpg',
                    'The Madonna of the Cherubim',
                    'Christ as the Suffering Redeemer',
                    'Madonna della Vittoria',
                    'Death of the Virgin'
                ),
                new Question(
                    'Welchen Titel hat dieses Bild?',
                    'Das Bild ist von Fra Angelico.',
                    'img/last_judgment.jpg',
                    'The Last Judgment',
                    'Coronation of the Virgin',
                    'Landscape with the Flight into Egypt',
                    'Napoleon as Mars the Peacemaker'
                ),
                new Question(
                    'Welchen Titel hat dieses Bild?',
                    'Das Bild ist von Camille Pissarro.',
                    'img/the_house.jpg',
                    'The House of the Deaf Woman and the Belfry at Eragny',
                    'Maestà',
                    'Lipstick (Ascending) on Caterpillar Tracks',
                    'The Button'
                ),
                new Question(
                    'Aus welchem Jahr stammt dieses Bild?',
                    'Das Bild ist von Claude Lorrain.',
                    'img/claude.jpg',
                    '1635',
                    '1873',
                    '1732',
                    '1868'
                ),
                new Question(
                    'Aus welchem Jahr stammt dieses Bild?',
                    'Das Bild ist von Marcel Duchamp.',
                    'img/duchamp.jpg',
                    '1912',
                    '1602',
                    '1966',
                    '1598'
                ),
                new Question(
                    'Aus welchem Jahr stammt dieses Bild?',
                    'Das Bild ist von Masaccio.',
                    'img/massacio.jpg',
                    '1425',
                    '1872',
                    '1594',
                    '1528'
                ),
                new Question(
                    'Aus welchem Jahr stammt dieses Bild?',
                    'Das Bild ist von Umberto Boccioni.',
                    'img/umberto.jpg',
                    '1910',
                    '1571',
                    '1624',
                    '1428'
                ),
                new Question(
                    'Aus welchem Jahr stammt dieses Bild?',
                    'Das Bild ist von Vincent van Gogh.',
                    'img/vase.jpg',
                    '1890',
                    '1820',
                    '1624',
                    '1902'
                ),
                new Question(
                    'Welchen Titel hat dieses Bild?',
                    'Das Bild ist von William Blake.',
                    'img/andrea.jpg',
                    'Pity',
                    'The Bench',
                    'The Distrest Poet',
                    'Bulb Fields'
                ),
            );

            return $questions[rand(0, sizeof($questions)-1)]->asArray();
        }

        return;
    }
}
