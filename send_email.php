<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "support@elanex.tech";
    $subject = "Contact Form Submission";

    // Sanitize and validate input data
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $headers = "From: " . $email . "\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "Content-type: text/plain; charset=UTF-8\r\n";

        $mail_body = "Name: " . $name . "\n";
        $mail_body .= "Email: " . $email . "\n";
        $mail_body .= "Phone: " . $phone . "\n";
        $mail_body .= "Message:\n" . $message;

        if (mail($to, $subject, $mail_body, $headers)) {
            echo "Message sent successfully.";
        } else {
            echo "Message failed to send.";
        }
    } else {
        echo "Invalid email address.";
    }
} else {
    echo "Invalid request.";
}
?>
