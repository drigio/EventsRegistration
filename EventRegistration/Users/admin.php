<?php
ob_start();
session_start();

if($_SESSION['logged_in'] != 1) {
    $_SESSION['message'] = "Cannot Find Page";
    header("location: ../Login/error.php");
}

else if($_SESSION['usertype'] > 1) {
    $_SESSION['message'] = "Not authorised to view this page";
    header("location: ../Login/error.php");
}
else {
    $first_name = $_SESSION['firstName'];
    $last_name = $_SESSION['lastName'];
    $mobile = $_SESSION['mobile'];
    $eventid = $_SESSION['eventid'];
    $eventname = $_SESSION['eventname'];
    
    require '../assets/db.php';
    $sql = "SELECT memid FROM members";
    $result = $mysqli->query($sql);
    $totalentry = $result->num_rows;
    
    $sql = "SELECT eventid FROM events";
    $result = $mysqli->query($sql);
    $totalevents = $result->num_rows;
    
    $sql = "SELECT userid,COUNT(userid) AS `cnt`
            FROM members 
            GROUP BY userid
            ORDER BY `cnt` DESC
            LIMIT 1";
    $result = $mysqli->query($sql);
    $topmemid = $result->fetch_assoc();
    
    $sql = "SELECT * FROM users WHERE userid =".$topmemid['userid'];
    $result = $mysqli->query($sql);
    $topregistrar = $result->fetch_assoc();    
}
?>

    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Event Dashboard</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />


        <!-- Bootstrap core CSS     -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />

        <!-- Animation library for notifications   -->
        <link href="../assets/css/animate.min.css" rel="stylesheet" />

        <!--  Light Bootstrap Table core CSS    -->
        <link href="../assets/css/light-bootstrap-dashboard.css" rel="stylesheet" />

        <!--     Fonts and icons     -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
        <link href="../assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
        
        <link rel="stylesheet" href="style.css">

    </head>

    <body>

        <div class="wrapper">
            <div class="sidebar" data-color="azure" data-image="../assets/img/sidebar-4.jpg">

                <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

                <div class="sidebar-wrapper">
                    <div class="logo">
                        <a class="simple-text">
                            TechnoFest 2K18
                        </a>
                    </div>

                    <ul class="nav">
                        <li>
                            <a href="showUsers.php">
                        <i class="pe-7s-users"></i>
                        <p>Show Entries</p>
                    </a>
                        </li>

                        <li>
                            <a href="fees.php">
                        <i class="pe-7s-add-user"></i>
                        <p>Print Entries</p>
                    </a>
                        </li>

                        <li>
                            <a href="sendEmail.php">
                        <i class="pe-7s-delete-user"></i>
                        <p>Send Email</p>
                    </a>
                        </li>
                        <li>
                            <a href="sendSMS.php">
                        <i class="pe-7s-delete-user"></i>
                        <p>Send SMS</p>
                    </a>
                        </li>

                    </ul>
                </div>
            </div>

            <div class="main-panel">
                <nav class="navbar navbar-default navbar-fixed">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                            <a class="navbar-brand" href="index.php">
                                <?php echo $eventname; ?> Dashboard</a>
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-left">
                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-dashboard"></i>
                            </a>
                                </li>
                            </ul>

                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="userInfo.php">
                               Welcome <?= $first_name.' '.$last_name ?>
                            </a>
                                </li>
                                <li>
                                    <a href="../Login/logout.php">
                               Logout
                            </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </nav>


                <div class="content">
                    <div class="container-fluid">
                        <div class="card">
                           <div class="header">
                               <h4 class="title">Statistics</h4>
                           </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="content">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <h3 class="stats" style="color:white;">
                                                        <?php echo $totalentry; ?>
                                                    </h3>
                                                    <div class="content">
                                                        <h4 class="stats-content">
                                                            Total Entries
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <h3 class="stats" style="color:white;">
                                                        <?php echo $totalevents; ?>
                                                    </h3>
                                                    <div class="content">
                                                        <h4 class="stats-content">
                                                            Total Events
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <h3 class="stats" style="color:white; font-size:500%;">
                                                        <?php echo $topregistrar['fname']." ".$topregistrar['lname']; ?>
                                                    </h3>
                                                    <div class="content">
                                                        <h4 class="stats-content">
                                                            Top Registrar
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <footer class="footer">
                    <div class="container-fluid">
                        <nav class="pull-left">
                            <ul>
                                <li>
                                    <a href="index.php">
                                Home
                            </a>
                                </li>

                            </ul>
                        </nav>
                        <p class="copyright pull-right">
                        </p>
                    </div>
                </footer>

            </div>
        </div>


    </body>

    <!--   Core JS Files   -->
    <script src="../assets/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Checkbox, Radio & Switch Plugins -->
    <script src="../assets/js/bootstrap-checkbox-radio-switch.js"></script>

    <!--  Charts Plugin -->
    <script src="../assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="../assets/js/bootstrap-notify.js"></script>


    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="../assets/js/light-bootstrap-dashboard.js"></script>


    </html>
<?php ob_end_flush(); ?>