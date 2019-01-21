<?php
ob_start();
session_start();

if ( $_SESSION['logged_in'] == 1 && $_SESSION['usertype'] == 3) {
  $first_name = $_SESSION['firstName'];
  $last_name = $_SESSION['lastName'];
  $mobile = $_SESSION['mobile'];
  $userid = $_SESSION['userId'];
  $dept = $_SESSION['dept'];
}
else {
  $_SESSION['message'] = "Cannot Find Page";
  header("location: ../Login/error.php");
}

require '../assets/db.php';
$sql = "Select * from users where dept ="."'$dept'";
$result = $mysqli->query($sql) or die($mysqli->error);
?>

    <html>

    <head>
        <title>Show Entries</title>

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

    </head>

    <body>

        <div class="wrapper">
            <div class="sidebar" data-color="azure" data-image="../assets/img/sidebar-4.jpg">
                <div class="sidebar-wrapper">
                    <div class="logo">
                        <a class="simple-text">
                         TechnoFest 2K18
                        </a>
                    </div>

                    <ul class="nav">
                        <li>
                            <a href="index.php">
                        <i class="pe-7s-users"></i>
                        <p>Add Entry</p>
                    </a>
                        </li>
                        <li>
                            <a href="showmem.php">
                        <i class="pe-7s-users"></i>
                        <p>Show Entries Added</p>
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
                            <a class="navbar-brand" href="index.php"> Dashboard</a>
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">All Members</h4>
                                    </div>
                                    <div class="content table-responsive table-full-width">
                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <th>Sr No</th>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1;
                                            while($list = $result->fetch_assoc()) { ?>
                                                <tr>
                                                   <td>
                                                        <?php echo $i;?>
                                                    </td>
                                                    <td>
                                                        <?php echo $list['userid'];?>
                                                    </td>
                                                    <td>
                                                        <?php echo $list['fname']." ".$list['lname'];?>
                                                    </td>
                                                    <td>
                                                        <?php echo $list['mobile'];?>
                                                    </td>
                                                </tr>
                                                <?php $i++;} ?>
                                            </tbody>
                                        </table>

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
