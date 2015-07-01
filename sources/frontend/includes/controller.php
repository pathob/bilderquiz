<?php
function requestQuestion($SID){
	$postData = array(
			'request' => 'question',
			'sessionID' => $SID,
	);
	
	$context = stream_context_create(array(
			'http' => array(
					// http://www.php.net/manual/en/context.http.php
					'method' => 'POST',
					'header' => "Content-Type: application/json\r\n",
					'content' => json_encode($postData)
			)
	));
	
	$response = file_get_contents('http://localhost:8080', FALSE, $context);
	
	/*
	if($response === FALSE){
			die('Error');
	}
	*/
	
	$response= array('{
    "request": {
        "question": "Aus welchem Land stammt dieses Bild?",
				"hint":"Der Autor ist im jahre 1881 geboren.",
    		"image":"img/picasso_1.jpg",
        "answers":{
        	"rightAnswer":"Spanien",
          "wrongAnswer1":"Deutschland",
          "wrongAnswer2":"Lettland",
          "wrongAnswer3":"Argentinien"
       	}
    }
	}','{
    "request": {
        "question": "Welchen Titel hat dieses Bild?",
				"hint":"Das Bild ist von Pablo Picasso.",
    		"image":"img/boy_leading_horse.jpg",
        "answers":{
        	"rightAnswer":"Boy Leading a Horse",
          "wrongAnswer1":"Femme aux Bras Croisés",
          "wrongAnswer2":"Family of Saltimbanques",
          "wrongAnswer3":"oil on canvas"
       	}
    }
	}','{
    "request": {
        "question": "Aus welchem Jahr stammt dieses Bild?",
				"hint":"Das Bild ist von Pablo Picasso.",
    		"image":"img/ma_jolie.jpg",
        "answers":{
        	"rightAnswer":"1914",
          "wrongAnswer1":"1925",
          "wrongAnswer2":"1900",
          "wrongAnswer3":"1944"
       	}
    }
	}','{
    "request": {
        "question": "Welche Besonderheit hat dieses Bild?",
				"hint":"Das Bild ist von Pablo Picasso.",
    		"image":"img/oil_painting.jpg",
        "answers":{
        	"rightAnswer":"Öl auf Leinwand",
          "wrongAnswer1":"Öl auf Holz",
          "wrongAnswer2":"Pastellkreiden auf Karton",
          "wrongAnswer3":"Wachsfarben auf Holz"
       	}
    }
	}');
	
	$random = rand(0,3);
	
	return $response[$random];
}

function getQuestion($SID){
	
	$requestQuestion = requestQuestion($SID);

	$questionJSONObject = json_decode($requestQuestion, TRUE);
	
	$question = $questionJSONObject['request']['question'];
	$hint = $questionJSONObject['request']['hint'];
	$image = $questionJSONObject['request']['image'];
	
	$rightAnswer = $questionJSONObject['request']['answers']['rightAnswer'];
	$wrongAnswers = array($questionJSONObject['request']['answers']['wrongAnswer1'], 
												$questionJSONObject['request']['answers']['wrongAnswer2'], 
												$questionJSONObject['request']['answers']['wrongAnswer3']);
												
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
				);
}
session_start();
$questionData = getQuestion($SID);
$_SESSION['questionCounter'] = $_SESSION['questionCounter'] + 1;
$_SESSION['questionData']=$questionData;
if(isset($_POST['questionCount'])){
	$_SESSION['questionCount'] = $_POST['questionCount'];
}
	
?>