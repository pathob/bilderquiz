<?php
// Only process POST reqeusts.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
		session_start();
		// Get the form fields and remove whitespace.
		$selection = $_POST["selection"];
		
		$response = array();
		$response[0] = (string)$_SESSION['questionData']['rightAnswer'];
		
		
		
		if($selection == $response[0]){
			$response[1] = "trueAnswer";
			$session = intval($_SESSION['answeredTrue']);
			$session++ ;
			$_SESSION['answeredTrue'] = $session;
		} else{
			$response[1] = "wrongAnswer";
			$session = intval($_SESSION['answeredFalse']);
			$session++ ;
			$_SESSION['answeredFalse'] = $session;
		}
		$response[2] = $_SESSION['answeredTrue'];
		$response[3] = $_SESSION['answeredFalse'];
		$result = json_encode($response);
		echo $result;
}

?>