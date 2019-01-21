<?php
ob_start();
/* User login process, checks if user exists and password is correct */

// Escape email to protect against SQL injections
$mobile = $mysqli->escape_string($_POST['mobile']);
$result = $mysqli->query("SELECT * FROM users WHERE mobile='$mobile'");

if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "User doesn't exist!";
    header("location: error.php");
}
else { // User exists
    $user = $result->fetch_assoc();

    if ( password_verify($_POST['password'], $user['password']) ) {

        $_SESSION['mobile'] = $user['mobile'];
        $_SESSION['userId'] = $user['userid'];
        $_SESSION['usertype'] = $user['usertype'];
        $_SESSION['firstName'] = $user['fname'];
        $_SESSION['lastName'] = $user['lname'];
        $_SESSION['eventid'] = $user['eventid'];
        $_SESSION['usermail'] = $user['usermail'];
        $_SESSION['userpass'] = $user['userpass'];
        $_SESSION['dept'] = $user['dept'];

        if($_SESSION['eventid'] != null) {
            $sql2 = "Select name from events where eventid = ".$user['eventid'];
            $result2 = $mysqli->query($sql2);
            $res = $result2->fetch_assoc();
            $_SESSION['eventname'] = $res['name'];
        }

        $_SESSION['logged_in'] = true;
        header("location: ../");
    }
    else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: error.php");
    }
}
?>

<?php ob_end_flush(); ?>
