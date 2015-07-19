<?php

function requestQuestion($SID){
	$context = stream_context_create(array('http' => array('header' => 'Connection: close\r\n')));
	return file_get_contents("http://localhost/api/question/random/", false, $context);
}

function getQuestion($SID){
	
	$requestQuestion = requestQuestion($SID);
	$questionJSONObject = json_decode($requestQuestion, TRUE);
	
	$question = $questionJSONObject['question'];
	$hint = $questionJSONObject['hint'];
	$image = mb_convert_encoding($questionJSONObject['image'], 'ISO-8859-1', 'UTF-8');
	
	$rightAnswer = mb_convert_encoding($questionJSONObject['answers']['rightAnswer'], 'ISO-8859-1', 'UTF-8');
	$wrongAnswers = array(
        mb_convert_encoding($questionJSONObject['answers']['wrongAnswer1'], 'ISO-8859-1', 'UTF-8'),
        mb_convert_encoding($questionJSONObject['answers']['wrongAnswer2'], 'ISO-8859-1', 'UTF-8'),
        mb_convert_encoding($questionJSONObject['answers']['wrongAnswer3'], 'ISO-8859-1', 'UTF-8')
    );

	$wikilink = mb_convert_encoding($questionJSONObject['wikilink'], 'ISO-8859-1', 'UTF-8');

	$rightAnswerPosition = rand(0,3);
	$answerButtons[$rightAnswerPosition] = $rightAnswer;
	
	$counter = 0;
	for ($i=0; $i<4;$i++){
		if($i!=$rightAnswerPosition){
			$answerButtons[$i] = $wrongAnswers[$counter];
			$counter++;
		}
	}											
		
	return array(
        'question' => $question,
        'hint' => $hint,
        'image' => $image,
        'rightAnswer' => $rightAnswerPosition,
        'answerButtons' => $answerButtons,
        'wikilink' => $wikilink,
    );
}

session_start();
$questionData = getQuestion($SID);
$_SESSION['questionCounter'] = $_SESSION['questionCounter'] + 1;
$_SESSION['questionData']=$questionData;
if(isset($_POST['questionCount'])){
	$_SESSION['questionCount'] = $_POST['questionCount'];
	$_SESSION['askedQuestions'] = array();
}


while(in_array($questionData['image'], $_SESSION['askedQuestions'])) {
    $questionData = getQuestion($SID);
		$_SESSION['questionData']=$questionData;
}


array_push($_SESSION['askedQuestions'], $questionData['image']);
