<?php

$to = 'expo.mcast@gmail.com';
$subject = 'R&I Expo Contact Form';
$body = "";
$name = "";
$email = "";
$phone = "";
$message = "";

if( isset($_POST['fname']) ){
    $name = $_POST['fname'] . " " .$_POST['lname'];

    $body .= "Name: ";
    $body .= $name;
    $body .= "\n\n";
}
if( isset($_POST['email']) ){
    $email = $_POST['email'];

    $body .= "";
    $body .= "Email: ";
    $body .= $email;
    $body .= "\n\n";
}
if( isset($_POST['message']) ){
    $message = $_POST['message'];

    $body .= "";
    $body .= "Message: ";
    $body .= $message;
    $body .= "\n\n";
}



//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
//SMTP::DEBUG_OFF = off (for production use)
//SMTP::DEBUG_CLIENT = client messages
//SMTP::DEBUG_SERVER = client and server messages
$mail->SMTPDebug = SMTP::DEBUG_OFF;

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
//Use `$mail->Host = gethostbyname('smtp.gmail.com');`
//if your network does not support SMTP over IPv6,
//though this may cause issues with TLS

//Set the SMTP port number:
// - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
// - 587 for SMTP+STARTTLS
$mail->Port = 465;

//Set the encryption mechanism to use:
// - SMTPS (implicit TLS on port 465) or
// - STARTTLS (explicit TLS on port 587)
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = 'expo.mcast@gmail.com';

//Password to use for SMTP authentication
$mail->Password = '!Tvh97FrU7T36mcg';

//Set who the message is to be sent from
//Note that with gmail you can only use your account address (same as `Username`)
//or predefined aliases that you have configured within your account.
//Do not use user-submitted addresses in here
$mail->setFrom('expo.mcast@gmail.com', 'Expo MCAST');

//Set an alternative reply-to address
//This is a good place to put user-submitted addresses
$mail->addReplyTo('expo.mcast@gmail.com', 'Expo MCAST');

//Set who the message is to be sent to
$mail->addAddress('expocommittee@mcast.edu.mt', 'Expo Committee');

//Set the subject line
$mail->Subject = 'R&I Expo Contact Form';

$mail->msgHTML($body, __DIR__);
//Replace the plain text body with one created manually
$mail->AltBody = $body;


//send the message, check for errors
if (!$mail->send()) {
	header ("Location: https://research.mcast.edu.mt/riexpo/2021/error.php");
	exit();

} else {
	header("Location: https://research.mcast.edu.mt/riexpo/2021/thank-you.php");
	exit();
}

