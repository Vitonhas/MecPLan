<?php $name = $_POST['Name'];
$email = $_POST['Email'];
$message = $_POST['Message'];
$formcontent="From: $name \n Message: $message";
$recipient = "victor.abreu.pessanha@gmail.com";
$subject = "Contact Form";
$mailheader = "From: $email \r\n";
mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
echo "Obrigado!";
?>