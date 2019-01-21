<?php
ob_start();
/* Displays all error messages */
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Error</title>
  <?php include 'css/css.html'; ?>
</head>
<body>
<div class="form">
    <h1>Error</h1>
    <p>
    <?php 
    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) )
        echo $_SESSION['message'];    
    else 
        header( "location: index.php" );
    ?>
    </p>     
    <a href="index.php"><button class="button button-block">Home</button></a><br>
    <a href="logout.php"><button class="button button-block">Login again</button></a>
    
</div>
</body>
</html>


<?php ob_end_flush(); ?>