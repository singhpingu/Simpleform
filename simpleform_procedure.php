<?php
//simpleform_procedure.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$y_name = filter_var($_POST["your_name"], FILTER_SANITIZE_STRING); 
	$y_email = filter_var($_POST["your_email"], FILTER_SANITIZE_EMAIL);
	$y_number = $_POST["your_number"];
	$y_address = $_POST["your_address"];
	$y_text = filter_var($_POST["user_text"], FILTER_SANITIZE_STRING);

	if (empty($y_name)){
		die("Please enter your name");
	}
	if (empty($y_email) || !filter_var($y_email, FILTER_VALIDATE_EMAIL)){
		die("Please enter valid email address");
	}
	if (empty($y_text)){
		die("Please enter text");
	}
    function validateMobileNumber($y_number) {
      if (!empty($y_number)) {
       $isMobileNuumberValid = TRUE;
       $mobileDigitsLength = strlen($y_number);
      if ($mobileDigitsLength < 10) {
       $isMobileNumberValid = FALSE;
    } 
    if ($mobileDigitsLength > 10) {
       $isMobileNumberValid = FALSE;
    } 
    print "Mobile number is valid";
   }
   else {
   die("Re-enter your mobile");
  }
  }	

$mysqli = new mysqli('localhost', 'root','lgD2UFb@', 'user_data');
	
	//Output any connection error
	if ($mysqli->connect_error) {
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}	
	
	$statement = $mysqli->prepare("INSERT INTO your_data (user_name, user_email, user_number, user_address, user_message) VALUES(?, ?, ?, ?, ?)"); //prepare sql insert query
	//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
	$statement->bind_param('ssiss', $y_name, $y_email, $y_number, $y_address, $y_text); 	
	if($statement->execute()){
		print "Hello " . $y_name . "!, your message has been saved!";
	}else{
		print $mysqli->error; //show mysql error if any
	}
}
?>