<?php
	error_reporting(E_ALL);

	require("PHPMailer_5.2.4/class.phpmailer.php");

	$name       = @trim(stripslashes($_POST['name'])); 
    $email      = @trim(stripslashes($_POST['email'])); 
    $subject    = @trim(stripslashes($_POST['subject'])); 
    $message    = @trim(stripslashes($_POST['message'])); 
	
	$mail = new PHPMailer();

	$mail->IsSMTP(); // set mailer to use SMTP
	$mail->SMTPDebug  = 2; 
	$mail->From = "giftshop@gmail.com";
	$mail->FromName = "Shperblim.S";
	$mail->Host = "smtp.gmail.com"; // specif smtp server
	$mail->SMTPSecure= "ssl"; // Used instead of TLS when only POP mail is selected
	$mail->Port = 465; // Used instead of 587 when only POP mail is selected
	$mail->SMTPAuth = true;
	$mail->Username = "shperblim@gmail.com"; // SMTP username
	$mail->Password = "password"; // SMTP password
	$mail->AddAddress($email, $name); //replace myname and mypassword to yours
	//$mail->AddReplyTo("shperblim@gmail.com", "Jiansen");
	$mail->WordWrap = 50; // set word wrap	

	$mail->IsHTML(true); // set email format to HTML
	$mail->Subject = $subject;
	$mail->Body = $message;

	if($mail->Send()) {echo "Send mail successfully";}
	else {echo "Send mail fail";}     	
?>