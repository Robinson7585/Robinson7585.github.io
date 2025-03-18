<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $to = "owner@example.com";
    $subject = "Contact Us Message";
    $message = $_POST['message'];
    $headers = "From: " . $_POST['email'];
    
    if (mail($to, $subject, $message, $headers)) {
        echo "Message sent successfully!";
    } else {
        echo "Error sending message.";
    }
}
?>

<form method="POST" action="contact.php">
    <input type="email" name="email" placeholder="Your Email" required>
    <textarea name="message" placeholder="Your Message" required></textarea>
    <button type="submit">Send Message</button>
</form>
