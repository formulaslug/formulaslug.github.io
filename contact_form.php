<?php
// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate required fields
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo 'error'; // Return 'error' if any field is empty
        exit;
    }

    // Set the recipient email address
    $to = 'formulaslug@ucsc.edu';

    // Create the email subject and body
    $email_subject = "Contact Form Submission: $subject";
    $email_body = "You have received a new message from the contact form.\n\n".
                  "Name: $name\n".
                  "Email: $email\n".
                  "Subject: $subject\n\n".
                  "Message:\n$message";

    // Set email headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send the email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo 'success'; // Return 'success' if the email is sent
    } else {
        echo 'error'; // Return 'error' if the email fails to send
    }
} else {
    // Handle cases where the request method is not POST
    http_response_code(405); // Method Not Allowed
    echo 'error';
}
?>