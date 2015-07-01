<?php
session_start();
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
        <span class="glyphicon glyphicon-menu-hamburger"></span>
      </nav>
    </div>
  </section>
	<div class="container">
    <div class="row">
    	<div class="col-md-6 quiz_image">
            <img src="img/kunstquiz.jpg" alt="" />
      </div>
      <div class="col-md-6 quiz_finish">
        <section class="quiz_question_container">
          <div class="quiz_question">Sie haben <?php echo $_SESSION['answeredTrue']; ?> von <?php echo $_SESSION['questionCount']; ?> Fragen richtig beantwortet.</div>
        </section>
        <section class="answers">
          <div class="row">
            <div class="col-xs-4 col-xs-offset-2">
      				<span class="statTrue"><?php echo $_SESSION['answeredTrue'];?></span>
            </div>
            <div class="col-xs-4">
              <span class="statFalse"><?php echo $_SESSION['answeredFalse']; ?></span>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <form action="index.php" method="post">
                <button class="submitButton" value="20" type="submit">Nochmal spielen</button>
              </form> 
            </div>
          </div>
        </section>
      </div> 
    </div>
  </div>
<section class="footer">
	<div class="container">
    <div class="col-xs-12">
      <h4>XML-Technologien (Web Data and Interoperability)</h4>
    </div>
  </div>
</section>
</article>
</body>
</html>
<?php
session_unset();
$_SESSION = array();
session_regenerate_id($delete_old_session = true);
session_destroy();
?>