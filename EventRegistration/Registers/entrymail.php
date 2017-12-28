<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/Exception.php';
require '../phpmailer/src/SMTP.php';

  function sendRegisterMail($email,$name,$eventid,$eventname)
  {


    if($eventid >= 1 && $eventid <=6) {
      //COMEIT
      $username = "comeit_technofest18@gppune.ac.in";
      $password = "overwatch123";

    }
    // elseif ($eventid >= 7 && $eventid <=12) {
    //   //ELECTRICAL
    // }elseif ($eventid >= 12 && $eventid <=6) {
    //   //CIVIL
    // }elseif ($eventid >= 1 && $eventid <=6) {
    //   //MECH
    // }elseif ($eventid >= 1 && $eventid <=6) {
    //   //ENTC
    // }elseif ($eventid >= 1 && $eventid <=6) {
    //   //META
    // }else {
    //   //DDGM
    // }

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
    $mail->Username = $username;
    $mail->Password = $password;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    //Recipient
    $mail->setFrom('technofest@gppune.ac', $eventname." Team");
    $mail->addBCC(trim($email));

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Successfully Registered';
    $mail->Body = "Dear ".$name.", <br>
                  You have been Successfully registered for ".$eventname.".<br>
                  Technofest 2K18 is held on 19th and 20th January 2018.<br>
                  Further details will be mailed to you shortly.<br>
                  Kindly show this email at the venue for the entry.<br>
                  Regards,<br>
                  TechnoFest Team";
    //Check if mail is sent properly.
    if($mail->send()){
      return 0;
    }else {
      return 1;
    }

  }

  //For Testing purpose only
    // $val = sendRegisterMail("drigiobalboa@gmail.com","Takeshi's Castle","2","CS GO");
    // echo $val;
 ?>
