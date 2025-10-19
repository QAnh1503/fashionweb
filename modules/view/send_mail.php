<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// Nếu ko sợ xung đột tên thì có thể xoá những cái use ở trên này đi


require '../../PHPMailer-master/PHPMailer-master/src/Exception.php';
require '../../PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require '../../PHPMailer-master/PHPMailer-master/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    // ============= Server settings ============= 
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER; //or: 2                    //Enable verbose debug output
    $mail->SMTPDebug = 0;
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'nhqanh1503@gmail.com';                     //SMTP username
    $mail->Password   = 'aqxg uxlg gblg szzl';                               //SMTP password
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    
    $mail->SMTPSecure = 'tls';
    // $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->Port       = 587;
    $mail->CharSet = "UTF-8";

    // ============= Recipients ============= 
    $mail->setFrom('nhqanh1503@gmail.com', 'Style Seeker');
    // $mail->addAddress('nguyenhuuquynhanh2@gmail.com', 'Nguyễn Hữu Quỳnh Anh');     //Add a recipient
    $mail->addAddress($email, 'Nguyễn Hữu Quỳnh Anh');     //Add a recipient

    // $mail->addAddress('Vnmchau0408@gmail.com');               //Name is optional
    $mail->addReplyTo('nhqanh1503@gmail.com', 'Style Seeker');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');
 

    // ============= Attachments ============= 
    // $mail->addAttachment('baby_flower.jpg');         //Add attachments

    //$mail->addAttachment('baby_flower.jpg', 'baby.jpg');    //Optional name


    // ============= Content ============= 
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Send mail from Style Seeker ';
    // $mail->Body    = 'The information is send from the program: <b>PHP Mailer</b>';
    $num= random_int(100000, 999999);
    // $mail->Body    = "Profile code: {$num} <b> PHP Mailer </b>";
    $mail->Body    = "Welcome to Style Seeker fashion shop ! <br>Your exclusive profile code is: {$num}.<br>Create new account now and enjoy your experience.";

    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    // echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}