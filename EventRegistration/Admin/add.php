<?php
ob_start();
    session_start();
    require '../assets/db.php';


    //Accept All fields

        $fname = $mysqli->escape_string($_POST["fname"]);
        $lname = $mysqli->escape_string($_POST["lname"]);
        $mobile = $mysqli->escape_string($_POST["mobile"]);
        $password = password_hash("hello", PASSWORD_BCRYPT);

        //Find Email ID and Password
        $dept = $_SESSION['dept'];
        // switch($dept) {
        //
        //   case 'CIVIL' : $usermail = "civil_technofest18@gppune.ac.in";
        //                  $userpass = "civil15tfest18";
        //                  break;
        //   case 'MECH' : $usermail = "gpp_technofest18@gppune.ac.in";
        //                  $userpass = "technofest@2k18";
        //                  break;
        //   case 'ELECT' : $usermail = "elect_technofest18@gppune.ac.in";
        //                  $userpass = "Admin_elect@tf18";
        //                  break;
        //   case 'ENTC' : $usermail = "";
        //                  $userpass = "";
        //                  break;
        //   case 'META' : $usermail = "";
        //                  $userpass = "";
        //                  break;
        //   case 'DDGM' : $usermail = "";
        //                  $userpass = "";
        //                  break;
        //   case 'COMEIT' : $usermail = "";
        //                  $userpass = "";
        //                  break;
        //
        //
        // }


        $sql = "INSERT into users(usertype,fname,lname,dept,mobile,password)VALUES(2,'$fname','$lname','$dept','$mobile','$password')";


        if($mysqli->query($sql)) {
            echo '<script>alert("Entry added Successfully")</script>';
            header("refresh:0;url=index.php");
        }else {
            echo '<script>alert("Error adding Entry")</script>';
            header("refresh:0;url=index.php");
        }

?>
<?php ob_end_flush(); ?>
