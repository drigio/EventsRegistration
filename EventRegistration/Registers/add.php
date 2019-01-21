<?php
ob_start();
    session_start();
    include('entrymail.php');
    require '../assets/db.php';


    //Accept All fields

        $fname = $mysqli->escape_string($_POST["fname"]);
        $lname = $mysqli->escape_string($_POST["lname"]);
        $mobile = $mysqli->escape_string($_POST["mobile"]);
        $email = $mysqli->escape_string($_POST["email"]);
        $college = $mysqli->escape_string($_POST["college"]);
        $eventid = $mysqli->escape_string($_POST["event"]);
        $userid = $_SESSION['userId'];
        $date = date('Y-m-d');

        //Find Eventid
        $sql1 = "SELECT name FROM events WHERE eventid =".$eventid;
        $result1 = $mysqli->query($sql1);
        $row = $result1->fetch_assoc();
        $eventname = $row['name'];
        

        $sql = "INSERT into members(fname,lname,college,mobile,email,eventid,userid,date)VALUES('$fname','$lname','$college','$mobile','$email','$eventid','$userid','$date')";


        if($mysqli->query($sql)) {
          //Send Mail to Registered Entry
            $val = sendRegisterMail($email,$fname." ".$lname,$eventid,$eventname);
            echo '<script>alert("Entry added Successfully")</script>';
            //echo $val;
            header("refresh:0;url=index.php");
        }else {
            echo '<script>alert("Error adding Entry")</script>';
            header("refresh:0;url=index.php");
        }

?>
<?php ob_end_flush(); ?>
