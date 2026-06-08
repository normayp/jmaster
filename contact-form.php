<?php 
require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

include('config/db_connect.php');

$full_name = $email = $tel = $message = '';
$errors = array('full_name' => '', 'email' => '', 'tel' => '', 'message' => '');

if(isset($_POST['submit'])){
    // Your form validation code here...

    if (array_filter($errors)){
        // Handle errors if needed
    }
    else {
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $tel = mysqli_real_escape_string($conn, $_POST['tel']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        // Create SQL 
        $sql = "INSERT INTO `contact` (`full_name`, `email`, `tel`, `message`) VALUES ('$full_name', '$email', '$tel', '$message')";
        echo "<script>alert('You successfully created your booking. Kindly check your email.')</script>";
        // Save to database and check 
        if (mysqli_query($conn, $sql)){
            // Success

            // Now, create an instance of PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                // Rest of your email settings...
                $mail->SMTPAuth   = true;
                $mail->Username   = 'normaypangan@gmail.com';
                $mail->Password   = 'yqlx tpas vjoc wapb';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;
                
                // Recipients
                $mail->setFrom('normaypangan@gmail.com', 'Normay');
                $mail->addAddress($email, $full_name);
    
                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Feedback Concern';
    
                $head = "Thank you for feedback, $full_name!<br><br>";
    
                $mail->Body = "Dear $full_name, /n <br>

                Thank you for choosing Journey Masters! We appreciate your trust in our services. Your feedback is invaluable to us as we continually strive to enhance your travel experience.
                
                We're delighted to hear that you had a positive experience with us. Your satisfaction is our top priority, and we are committed to delivering exceptional service.
                
                If you have any specific comments, suggestions, or areas where we can improve, please feel free to share. Your insights help us tailor our services to meet your expectations and those of our valued customers.
                
                Once again, thank you for choosing Journey Masters. We look forward to serving you on your future adventures!
                
                Safe travels,
                The Journey Masters Team
                ONE";
    
                // Send email
                $mail->send();
    
                // Action after sending email
    
            } catch (Exception $e) {
                // Handle exceptions or errors here
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
        else {
            echo 'query error: '. mysqli_error($conn);
        }
    }
} // end POST check
?>
