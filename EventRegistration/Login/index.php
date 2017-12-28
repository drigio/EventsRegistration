<?php 
ob_start();
require '../assets/db.php';
session_start();
if(isset($_SESSION["mobile"])) {
    header("location: ../Users/index.php");
}


?>

<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/style-index.css">
</head>

<?php 
    
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['login'])) { //user logging in

        require 'login.php';
        
    }
}
?>

<body>
    <form action="index.php" method="post">
        <div class="login">
            <div class="login-screen">
                <div class="app-title">
                    <h1>Login</h1>
                </div>

                <div class="login-form">
                    <div class="control-group">
                        <input type="text" class="login-field" value="" placeholder="username" name="mobile">
                        <label class="login-field-icon fui-user" for="login-name"></label>
                    </div>

                    <div class="control-group">
                        <input type="password" class="login-field" value="" placeholder="password" name="password">
                        <label class="login-field-icon fui-lock" for="login-pass"></label>
                    </div>

                    <button class="btn btn-primary btn-large btn-block" name="login">login</button>
                </div>
            </div>
        </div>
    </form>
</body>

</html>
<?php ob_end_flush(); ?>

