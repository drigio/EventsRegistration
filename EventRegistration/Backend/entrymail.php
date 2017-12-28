<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/Exception.php';
require '../phpmailer/src/SMTP.php';

  function sendRegisterMail($email,$name,$eventid,$eventname)
  {


    if($eventid >= 1 && $eventid <=5) {
      //CIVIL
        $username = "civil_technofest18@gppune.ac.in";
        $password = "civil15tfest18";
    }
     elseif ($eventid >= 6 && $eventid <=10) {
       //MECH
       $username = "gpp_technofest18@gppune.ac.in";
       $password = "technofest@2k18";

     }elseif ($eventid >= 11 && $eventid <=16) {
       //ENTC
       $username = "entc_technofest18@gppune.ac.in";
       $password = "entctechnofest";

     }elseif ($eventid >= 17 && $eventid <=18) {
       //ELECT
       $username = "elect_technofest18@gppune.ac.in";
       $password = "Admin_elect@tf18";

     }elseif ($eventid >= 19 && $eventid <=24) {
       //DDGM
        $username = "ddgm_technofest18@gppune.ac.in";
        $password = "ddtechnofest";
     }elseif ($eventid >= 25 && $eventid <=27) {
       //META
       $username = "gpp_technofest18@gppune.ac.in";
       $password = "technofest@2k18";
     }
        elseif($eventid >= 28 && $eventid <=33) {
       //GeekNation
        $username = "comeit_technofest18@gppune.ac.in";
        $password = "overwatch123";
     }

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
