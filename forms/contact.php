<?php

$receiving_email_address = 'anandrathoreindi@gmail.com';

// Path to PHP Email Form library
$php_email_form = '../assets/vendor/php-email-form/php-email-form.php';

if (file_exists($php_email_form)) {
    include($php_email_form);
} else {
    die('Unable to load the "PHP Email Form" Library!');
}

$contact = new PHP_Email_Form;
$contact->ajax = true;

// Receiving email address
$contact->to = $receiving_email_address;

// Required POST fields with fallbacks to prevent errors if fields are missing
$contact->from_name = isset($_POST['name']) ? $_POST['name'] : 'Anonymous';
$contact->from_email = isset($_POST['email']) ? $_POST['email'] : 'no-reply@example.com';
$contact->subject = isset($_POST['subject']) ? $_POST['subject'] : 'Contact Form Submission';

// SMTP (optional) - Uncomment and set these if needed
/*
$contact->smtp = array(
  'host' => 'smtp.yourhost.com',
  'username' => 'your-smtp-username',
  'password' => 'your-smtp-password',
  'port' => '587'
);
*/

// Adding the message content
$contact->add_message($contact->from_name, 'From');
$contact->add_message($contact->from_email, 'Email');
$contact->add_message(isset($_POST['message']) ? $_POST['message'] : '', 'Message', 10);

// Send the message and echo the result
echo $contact->send();

?>
