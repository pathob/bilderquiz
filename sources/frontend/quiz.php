<?php
	require 'includes/controller.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FUs größtes Kunstquiz</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800,300,700,600' rel='stylesheet' type='text/css' /><link href='http://fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/bootstrap-theme.min.css" />
<link rel="stylesheet" href="css/custom.css" />
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/scripts.js" type="text/javascript"></script>
</head>
<body>
<article>
  <section class="header">
  	<div class="container">
      <h2 class="page_title">FU KUNSTQUIZ</h2>
      <nav>
        <a href="<?php echo $questionData['wikilink'];?>" target="_blank" rel="author">
          <span class="glyphicon glyphicon-menu-hamburger"></span>
        </a>
      </nav>
    </div>
  </section>
	<div class="container">
    <div class="row">
    	<div class="col-md-5 quiz_image">
				<?php if($questionData['image'] != ""):?>
            <img src="<?php echo $questionData['image']; ?>" alt="" />
        <?php endif; ?>
      </div>
      <div class="col-md-7 quiz_form">
        <section class="quiz_question_container">
          <div class="quiz_question"><?php echo $questionData['question']; ?></div>
          <div class="quiz_hint"><?php echo $questionData['hint']; ?></div>
        </section>
        <section class="answers">
          <div class="row">
            <div class="col-sm-6">
              <div class="answerChar">A</div>
              <form class="capture-me" id="bilderquiz" action="includes/functions.php" method="post">
                <button class="answerButton" id="selection" name="selection" value="0" type="submit" onClick="setClicked(this)">
                  <?php echo $questionData['answerButtons'][0] ;?>
                </button>
              </form>   
            </div>
            <div class="col-sm-6">
              <div class="answerChar">B</div>
              <form class="capture-me" action="includes/functions.php" method="post">
                <button class="answerButton" id="selection" name="selection" value="1" type="submit" onClick="setClicked(this)">
                  <?php echo $questionData['answerButtons'][1];?>
                </button>
              </form> 
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="answerChar">C</div>
              <form class="capture-me" action="includes/functions.php" method="post">
                <button class="answerButton" id="selection" name="selection" value="2" type="submit" onClick="setClicked(this)">
                  <?php echo $questionData['answerButtons'][2];?>
                </button>
              </form> 
            </div>
            <div class="col-sm-6">
              <div class="answerChar">D</div>
              <form class="capture-me" action="includes/functions.php" method="post">
                <button class="answerButton" id="selection" name="selection" value="3" type="submit" onClick="setClicked(this)">
                  <?php echo $questionData['answerButtons'][3];?>
                </button>
              </form> 
            </div>
          </div>
          <div class="row nextQuestion hidden">
            <div class="col-sm-12">
            <form action="<?php echo ($_SESSION['questionCounter'] != $_SESSION['questionCount'])? htmlspecialchars($_SERVER["PHP_SELF"]):"finished.php"; ?>" method="post">
              <button class="submitButton" name="nextQuestion" value="4" type="submit" onClick="setClicked(this)"><?php echo ($_SESSION['questionCounter'] != $_SESSION['questionCount'])? "Nächste Frage":"Weiter"; ?></button>
            </form> 
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
<section class="footer">
	<div class="container">
    <div class="col-xs-6">
      <h4>XML-Technologien (Web Data and Interoperability)</h4>
    </div>
    <div class="col-xs-6">
    	<span class="statFalse"><?php echo (isset($_SESSION['answeredFalse']))?$_SESSION['answeredFalse']:"0"; ?></span>
      <span class="statTrue"><?php echo (isset($_SESSION['answeredTrue']))?$_SESSION['answeredTrue']:"0";?></span>
      <span class="currentQuestion">Frage <?php echo $_SESSION['questionCounter'] . " von " . $_SESSION['questionCount'];?></span>
    </div>
  </div>
</section>
</article>
</body>
</html>