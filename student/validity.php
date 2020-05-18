<?php
  include 'class/class-autoload.class.php';
  $admin = new Admin();
  if($admin->isconnected()){
    $_POST["confidential"];
    $stud = $admin->getstudent($_POST["confidential"]);
    session_start();
      $_SESSION['name'] = $stud['name'];
      $_SESSION['email'] = $stud['email'];
      $_SESSION['phone'] = $stud['phone'];
      $_SESSION['dob'] = $stud['dob'];
      $_SESSION['reg'] = $stud['reg'];
      $_SESSION['pass'] = $stud['pass'];
      $_SESSION['timestamp'] = $stud['timestamp'];
      $_SESSION['suggestion'] = $stud['suggestion'];
      $_SESSION['var']= false;
    header("Location: student_info.php");
  }
?>