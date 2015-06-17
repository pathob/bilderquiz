<?php
/*
$postData = array(
    'request' => 'question'
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

if($response === FALSE){
    die('Error');
}

*/


$response='{
    "request": {
        "question": "Aus welchem Land stammt dieses Bild?",
				"hint":"Der Autor ist im jahre 1881 geboren.",
    		"image":"img/picasso_1.jpg",
        "answers":{
        	"rightAnswer":"Spanien",
          "wrongAnswer1":"Deutschland",
          "wrongAnswer2":"Lettland",
          "wrongAnswer3":"Argentinier"
       	}
    }
}';
$responseData = json_decode($response, TRUE);

$question = $responseData['request']['question'];
$hint = $responseData['request']['hint'];
$image = $responseData['request']['image'];

$rightAnswer = $responseData['request']['answers']['rightAnswer'];
$wrongAnswers = array($responseData['request']['answers']['wrongAnswer1'], 
											$responseData['request']['answers']['wrongAnswer2'], 
											$responseData['request']['answers']['wrongAnswer3']);

$rightAnswerPosition = rand(0,3);
$answerButtons[$rightAnswerPosition] = $rightAnswer;

$counter = 0;
for ($i=0; $i<4;$i++){
	if($i!=$rightAnswerPosition){
		$answerButtons[$i] = $wrongAnswers[$counter];
		$counter++;
	}
}

if(isset($_POST['selection'])){
	$test =  $_POST['selection'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bilderquiz</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800,300,700,600' rel='stylesheet' type='text/css' /><link href='http://fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/bootstrap-theme.min.css" />
<link rel="stylesheet" href="css/custom.css" />
<script src="js/bootstrap.min.js"></script>
</head>

<body>
<article>
	<section class="header">
  	<div class="container">
      <h2 class="page_title">FU QUIZ</h2>
      <nav>
      	<span class="glyphicon glyphicon-menu-hamburger"></span>
      </nav>
    </div>
  </section>
  <?php if($image != ""):?>
    <section class="quiz_image">
    	<div class="container">
        <img src="<?php echo $image; ?>" alt="" />
      </div>
    </section>
	<?php endif; ?>
  <div class="container">
  	<section class="quiz_question_container">
      <div class="quiz_question"><?php echo $question; ?></div>
      <div class="quiz_hint"><?php echo $hint; ?></div>
  	</section>
  </div>
  <section class="answers">
  	<div class="container">
    	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="row">
          <div class="col-sm-6">
          	<div class="answerChar">A</div>
          	<button class="answerButton" type="submit" name="selection" value="0"><?php echo $answerButtons[0];?></button>
          </div>
          <div class="col-sm-6">
          	<div class="answerChar">B</div>
            <button class="answerButton" type="submit" name="selection" value="1"><?php echo $answerButtons[1];?></button>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
          	<div class="answerChar">C</div>
            <button class="answerButton" type="submit" name="selection" value="2"><?php echo $answerButtons[2];?></button>
          </div>
          <div class="col-sm-6">
          	<div class="answerChar">D</div>
            <button class="answerButton" type="submit" name="selection" value="3"><?php echo $answerButtons[3];?></button>
          </div>
        </div>
        <div class="row">
        	<div class="col-sm-12">
          	<button class="submitButton" type="submit" name="selection" value="4">Nächste Frage</button>
          </div>
        </div>
      </form>
      
    </div>
  </section>
</article>
</body>
</html>


