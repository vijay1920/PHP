<?php
include("connect.php");

if(isset($_POST['email'])){
    $email = $_POST["email"];
}
else{
exit();
}

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
require 'mail/Exception.php';
require 'mail/PHPMailer.php';
require 'mail/SMTP.php';

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'vijayakumarsp1920@gmail.com';                     //SMTP username
    $mail->Password   = 'ybxb utaj xwur oouj';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('vijayakumarsp1920@gmail.com', 'Mailer');
    $mail->addAddress($email);     //Add a recipient
    
    $code = substr(str_shuffle('0123456789QWERTYUIOPASDFGHJKLZXCVBNM'),0,10);
    
    
     // Content
     $mail->isHTML(true);                                  // Set email format to HTML
     $mail->Subject = 'Password Reset';
     $mail->Body    = 'To reset your password click <a href="http://localhost/login_system/reset.php?code='.$code.'">here </a>. </br>Reset your password in a day.';

     $conn = new mySqli('localhost', 'root', '', 'database_username');

     if($conn->connect_error) {
         die('Could not connect to the database.');
     }

     $verifyQuery = $conn->query("SELECT * FROM limitscale WHERE email = '$email'");

     if($verifyQuery->num_rows) {
         $codeQuery = $conn->query("UPDATE limitscale SET code = '$code' WHERE email = '$email'");
             
         $mail->send();
         echo 'Message has been sent, check your email';
     }
     $conn->close();
 
 } catch (Exception $e) {
     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
 }    
?>