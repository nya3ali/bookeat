<?php
// Put your mail here
$to_email = "mail@mail.fr";
$subject = "This is a test message sent in PHP";
$body = "Hello! I send you a PHP script email to test if it works.";
$headers = "From: Name email";

if (mail($to_email, $subject, $body, $headers)) {
    echo "The email was successfully sent to $to_email...";
} else {
    echo "There was a problem, the mail has not been sent...";
}
?>