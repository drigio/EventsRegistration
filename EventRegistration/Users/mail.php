<?php
ob_start();
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/Exception.php';
require '../phpmailer/src/SMTP.php';
require '../assets/db.php';

if(isset($_POST['message'])) {
    
    $eventname = $_SESSION['eventname'];
    $eventid = $_SESSION['eventid'];
    $message = $_POST['message'];
    $usermail = $_SESSION['usermail'];
    $userpass = $_SESSION['userpass'];
    
    $sql = "Select email from members where eventid =".$eventid;
    $result = $mysqli->query($sql);
    

        $mail = new PHPMailer();    
        $mail->SMTPDebug = 2;    
        $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
        $mail->Host = 'smtp.gmail.com';  
        $mail->isSMTP();
        $mail->SMTPAuth = true;                               
        $mail->Username = $usermail;              
        $mail->Password = $userpass;                           
        $mail->SMTPSecure = 'tls';                            
        $mail->Port = 587;                                    

        //Recipients
        $mail->setFrom('', $eventname." Team");
        
        //Multiple Reciepients
        while($mem = $result->fetch_assoc()) {
            $mail->addBCC(trim($mem['email']));
        }

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'News From '.$eventname." Team";
        $mail->Body    = nl2br($message);

        if($mail->send()) {
           echo '<script>alert("Mail has been sent");</script>';
            header("refresh:0;url=sendEmail.php");
        }else {
            echo 'Message not sent';
            echo $mail->ErrorInfo;
        }
}else {
    echo '<script>alert("Error Sending Mail");</script>';
        header("refresh:0;url=index.php");
}
?>
<?php ob_end_flush(); ?>
