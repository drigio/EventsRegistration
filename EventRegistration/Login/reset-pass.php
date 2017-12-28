<?php
ob_start();
require '../assets/db.php';
session_start();

function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

// Make sure the form is being submitted with method="post"
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

    // Make sure the two passwords match
    if ( $_POST['newPass'] == $_POST['rNewPass'] ) { 

        $new_password = password_hash($_POST['newPass'], PASSWORD_BCRYPT);
        $mobile = $_SESSION['mobile'];
        
        $sql = "UPDATE users SET password='$new_password' WHERE mobile='$mobile'";

        if ( $mysqli->query($sql) ) {

        $_SESSION['message'] = "Your password has been reset successfully!";
            phpAlert("Password Reset");
        header("location: logout.php");    

        }

    }
    else {
        $_SESSION['message'] = "Two passwords you entered don't match, try again!";
        header("location: error.php");    
    }

}
?>
<?php ob_end_flush(); ?>