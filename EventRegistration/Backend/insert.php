<?php
 if($_SERVER['REQUEST_METHOD'] == "POST") {
   require '../assets/db.php';
   include('entrymail.php');
   //Get all the details into variables
   $fname = $_POST['fname'];
   $lname = $_POST['lname'];
   $mobile = $_POST['mobile'];
   $email = $_POST['email'];
   $college = $_POST['college'];
   $eventid = $_POST['eventid'];
   $userid = $_POST['userid'];
   $date = date('Y-m-d');

   $sql1 = "SELECT name FROM events WHERE eventid =".$eventid;
   $result1 = $mysqli->query($sql1);
   $row = $result1->fetch_assoc();
   $eventname = $row['name'];

   //Insert the data into database
   $sql = "INSERT INTO members(fname,lname,college,email,mobile,eventid,userid,date) VALUES ('$fname','$lname','$college','$email','$mobile','$eventid','$userid','$date')";
   if($mysqli->query($sql)) {
     $val = sendRegisterMail($email,$fname." ".$lname,$eventid,$eventname);
     echo "Entry Added Successfully";
   }else {
     echo "Entry Cannot be added";
   }
 }
 else {
   echo "Error while inserting";
 }
?>
