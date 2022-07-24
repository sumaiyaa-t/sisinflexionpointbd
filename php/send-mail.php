<?php
use PHPMailer\PHPMailer\PHPMailer;

require_once 'phpmailer/Exception.php';
require_once 'phpmailer/PHPMailer.php';
require_once 'phpmailer/SMTP.php';

$mail = new PHPMailer(true);

$alert = '';

if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $message = $_POST['message'];
  try{
    $mail->isSMTP();
    $mail->CharSet = "utf-8";// set charset to utf8
    $mail->SMTPAuth = true;// Enable SMTP authentication
    $mail->SMTPSecure = 'tls';// Enable TLS encryption, `ssl` also accepted

    $mail->Host = 'webextheme.com';// Specify main and backup SMTP servers
    $mail->Port = 587;// TCP port to connect to
    $mail->SMTPOptions = array(
      'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
      )
    );
    $mail->isHTML(true);// Set email format to HTML

    $mail->Username = 'smtpmail@webextheme.com';// SMTP username
    $mail->Password = 'smtp**mail*password';// SMTP password

    $mail->setFrom('smtpmail@webextheme.com', $name);//Your application NAME and EMAIL
    $mail->Subject = 'Message Received (Contact Page)';
    $mail->MsgHTML("

    <strong>Name    :</strong> $name <br>
    <strong>Phone    :</strong> $phone <br>
    <strong>Email   :</strong> $email <br>
    <strong>Message :</strong> $message

    ");// Message body
    $mail->addAddress('webextheme@gmail.com', 'User Name');// Target email


    $mail->send();
    echo $alert = '<div class="alert-success">
                 <h2 style="color: #4BB543">Message Sent Successfully! Thank you for contacting us.</h2>
                </div>';
                ?>
                <script>setTimeout(function() { location.replace("http://webextheme.com/html/insuren-html/v3/")},4000);</script>
                <?php
  } catch (Exception $e){
    echo $alert = '<div class="alert-error">
                <h2 style="color: #E03A3E">'.$e->getMessage().'</h2>
              </div>';
              ?>
              <script>setTimeout(function() { location.replace("http://webextheme.com/html/insuren-html/v3/")},4000);</script>
              <?php
  }
}
?>
