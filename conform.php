<?php
// Load Composer's autoloader
require 'vendor/autoload.php';

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = htmlspecialchars($_POST['name']);   
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }
    
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->SMTPDebug = 0;                                        // Disable verbose debug output
        $mail->isSMTP();                                             // Set mailer to use SMTP
        $mail->Host       = 'smtp.example.com';                      // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                    // Enable SMTP authentication
        $mail->Username   = 'mithravj001@gmail.com';                    // SMTP username
        $mail->Password   = 'havdodpitsmwpqcj';                    // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;          // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                     // TCP port to connect to
        
        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('meenakshiramar1999@gmail.com', 'Your Name');    // Add a recipient (your email address)
        
        // Content
        $mail->isHTML(true);                                         // Set email format to HTML
        $mail->Subject = 'Feedback Form Submission';
        $mail->Body    = "You have received a new feedback message from $name ($email).<br><br>Message:<br>$message";
        $mail->AltBody = "You have received a new feedback message from $name ($email).\n\nMessage:\n$message";
        
        $mail->send();
        echo 'Feedback has been sent successfully.';
    } catch (Exception $e) {
        echo "Feedback could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request.";
}
?>
