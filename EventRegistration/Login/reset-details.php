<?php
ob_start();
require '../assets/db.php';
session_start();
function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newFirstName = $_POST['fname'];
    $newLastName = $_POST['lname'];
    $mobile = $_SESSION['mobile'];
    
    $sql = "UPDATE users SET fname='$newFirstName',lname='$newLastName' WHERE mobile='$mobile'";
    
    if($mysqli->query($sql)) {
        
        echo '<script>alert("Details Updated. Please Login Again");</script>';
        header("refresh:0;url=logout.php");    
    }
    else {
        $_SESSION['message'] = "Some Error Occured!";
        header("location: error.php");    
    }
}
?>
<?php ob_end_flush(); ?>