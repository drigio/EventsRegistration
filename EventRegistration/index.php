<?php
ob_start();
session_start();

if($_SESSION['logged_in'] == 1) {
    if($_SESSION['usertype'] <= 1) {
        header("location:Users/");
    }elseif($_SESSION['usertype'] == 3) {
        header("location:Admin/");
    }else {
      header("location:Registers/");
    }
}else{
    header("location:Login/");
}

?>
<?php ob_end_flush(); ?>
