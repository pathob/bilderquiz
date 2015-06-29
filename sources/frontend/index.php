<?php
	require 'includes/controller.php';
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
    <h2 class="page_title">FU QUIZ</h2>
    <nav>
      <span class="glyphicon glyphicon-menu-hamburger"></span>
    </nav>
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
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              <div class="row">
                <div class="col-sm-6">
                  <div class="answerChar">A</div>
                  <button class="answerButton" type="submit" name="selection" value="0"><?php echo $questionData['answerButtons'][0] ;?></button>
                </div>
                <div class="col-sm-6">
                  <div class="answerChar">B</div>
                  <button class="answerButton" type="submit" name="selection" value="1"><?php echo $questionData['answerButtons'][1];?></button>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="answerChar">C</div>
                  <button class="answerButton" type="submit" name="selection" value="2"><?php echo $questionData['answerButtons'][2];?></button>
                </div>
                <div class="col-sm-6">
                  <div class="answerChar">D</div>
                  <button class="answerButton" type="submit" name="selection" value="3"><?php echo $questionData['answerButtons'][3];?></button>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <button class="submitButton" type="submit" name="selection" value="4">Nächste Frage</button>
                </div>
              </div>
            </form>        
        </section>
      </div>
    </div>
  </div>
<section class="footer">
  <h4>XML-Technologien (Web Data and Interoperability)</h4>
</section>
</article>
</body>
</html>