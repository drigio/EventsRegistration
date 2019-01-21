<?php
ob_start();

if($_SERVER['REQUEST_METHOD'] == "POST") {
  require '../assets/db.php';
  $mobile = $_POST['username'];
  $password = $_POST['password'];

  $result = $mysqli->query("SELECT * FROM users WHERE mobile = '$mobile'");
  if($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    if(password_verify($password,$user['password'])){
      $name = $user['fname']." ".$user['lname'];
      $userid = $user['userid'];
      $usertype = $user['usertype'];
      if($userid > 1) {
        $eventid = "0";
      }else {
        $eventid = $user['eventid'];
      }

      $data = ['loginMessage' => 'Login Success',
              'user' => $name,
              'userid' => $userid,
              'usertype' => $usertype,
              'eventid' => $eventid];

      header('Content-type: application/json');
      echo json_encode($data);
    }else {
      echo "Password Incorrect";
    }

  }else {
    echo "Username Incorrect";
  }

}else {
  echo "Error Occured";
}
ob_end_flush();
?>
