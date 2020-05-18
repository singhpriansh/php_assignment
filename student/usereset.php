<?php
    include 'class/class-autoload.class.php';
    $info = new Info();
    if((isset($_POST['reg'])&&($_POST['reg'])) || (isset($_POST['oldpass'])&&($_POST['oldpass'])) || (isset($_POST['newpass'])&&($_POST['newpass'])) || (isset($_POST['confpass'])&&($_POST['confpass']))){
        $admin = new Admin();
        if($admin->isconnected()){
            function regvalid($reg,$info){
                $digits = preg_split('//',$reg);
                for($i=1;$i<10;$i++){
                    if(!preg_match('/\d/',$digits[$i])){
                        $info->getname(" value=\"This field should only contain numbers\" style=\"color:red\"");
                        return false;
                    }
                }
                if(strlen($reg) != 9){
                    $info->getname(" value=\"Only 9 digit number allowed\" style=\"color:red\"");
                    return false;
                }
                $tempvar = new Student();
                if($tempvar->isregistered($reg)){
                    return true;
                }
                $info->getname(" value=\"This number don\'t have a registered account\" style=\"color:red\"");
                return false;
            }
            function passverification($password,$info){
                $uppercase = preg_match('@[A-Z]@', $password);
                $lowercase = preg_match('@[a-z]@', $password);
                $number    = preg_match('@[0-9]@', $password);
                $specialChars = preg_match('@[^\w]@', $password);                
                if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8){
                    $info->setnewpass("<p style=\"color:red\">Password should be atleast 8 characters including atleast one upper case letter, one number, and one special character.</p>");
                    return false;
                }else{
                    $info->setnewpass("<p style=\"color:green\">Strong password.</p>");
                    return true;
                }
            }
            if(empty($_POST['reg'])){
                $reg = false;
                $info->setname(" value=\"Enter registeration number....\" style=\"color:red\"");
            }else{
                $reg = regvalid($_POST['reg'],$info);
            }
            $pass=false;
            if(empty($_POST['oldpass'])){
                $info->setoldpass("<p style=\"color:red\">Password cannot be skipped</p>");
            }else{
                if(empty($_POST['newpass'])){
                    $info->setnewpass("<p style=\"color:red\">Please enter your new password</p>");
                }else{
                    if(empty($_POST['confpass'])){
                        $info->setconfpass("<p style=\"color:orange\">You need to conform new password</p>");
                    }else{
                        $pass = true;
                    }
                }
            }
            if($reg && $pass){
                $student = new Student();
                $isthere = $isthere = $student->isuser($_POST['reg'], $_POST['oldpass']);
                if($isthere){
                    if(passverification($_POST['newpass'],$info)){
                        if($_POST['newpass'] === $_POST['confpass']){
                            session_start();
                            $admin->update($_POST['name'],$_POST['newpass']);
                            $_SESSION['greeting'] = "Your password is changed successfully";
                            header("Location: login.php");
                        }else{
                            $info->setconfpass("<p style=\"color:red\">Passwords don't match</p>");
                        }
                    }
                }else{
                    $adminoldpass = "<p style=\"color:red\">Password entered is incorrect</p>";
                }
            }
        }else{
            header("Location: neterror.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GKV | admin</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="top-menu">
        <div class="header">
            <ul class="float-right">
                <li><a href="https://www.gkv.ac.in/Doc/Naac-a-Accrediated.pdf" target="_blank">NAAC A Accredited</a>
                </li>
                <li><a href="http://alumni.gkv.ac.in/">Alumni</a>
                <li><a href="https://gkvelibrary.informaticsglobal.com/login">eResources</a></li>
                <li><a href="http://mail.gkv.ac.in/">WebMail</a></li>
                <li><a href="https://www.gkv.ac.in/tenders/">Tenders</a></li>
            </ul>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="prelogo">
        <div class="container">
            <div class="logo"><a href="https://www.gkv.ac.in/"><img src="./pictures/logo.png"></a></div>
            <div class="text-center"><a href="https://www.gkv.ac.in/"><img src="./pictures/gkv-un.png"></a></div>
            <div class="text-right"><a href="https://www.gkv.ac.in/"><img src="./pictures/gkv-founder.png"></a></div>
        </div>
    </div>
    <div class="clearfix"></div>
    <header class="header">
        <div class="menu">
            <h3 class="centered">Assignment 3</h3>
        </div>
    </header>
    <div class="clearfix"></div>
    </div>
    <div class="form">
        <div class="heading" style="border-radius: 7px">
            <h2 class="reg-text">Password reset</h2>
        </div>
        <div class="allinput">
            <br>
            <form action="usereset.php" method="post" id="formed">
            <input type="varchar" name="reg" id="reg" <?php echo $info->getname()?> placeholder="Enter your registration number">
            <input type="password" name="oldpass" id="oldpass" placeholder="Enter your old password">
            <button disabled class="pass-box">
                    <ul class="box-border" style="list-style-type: none; width:100%">
                        <li class="side-tip">
                            <?php echo $info->getoldpass() ?>
                        </li>
                    </ul>
                </button>
            <input type="password" name="newpass" id="newpass" placeholder="Enter new password">
            <button disabled class="pass-box">
                    <ul class="box-border" style="list-style-type: none; width:100%">
                        <li class="side-tip">
                            <?php echo $info->getnewpass() ?>
                        </li>
                    </ul>
                </button>
            <input type="password" name="confpass" id="confpass" placeholder="Retype your password">
            <button disabled class="pass-box">
                    <ul class="box-border" style="list-style-type: none; width:100%">
                        <li class="side-tip">
                            <?php echo $info->getconfpass() ?>
                        </li>
                    </ul>
                </button>
            </form>
            </br>
            <button isdisabled class="dbmsg" style="margin-top: 80px; margin-bottom: 15px;">
                <ul class="box-border" style="list-style-type: none;">
                    <li class="side-tip">
                        Try to have a good password.
                    </li>
                </ul>
            </button>
        </div>
        <div class="allbtn" style="border-radius: 7px;">
            <a ><button class="btn" form="formed" style="margin: 5px 5px 5px 34px;">Reset password</button></a>
            <a href="userpage.php"><button class="btn" style="margin: 5px;">Don't whant to change quit</button></a>
        </div>
    </div>
    <!-- <div style="padding: 0px 25px 0px 25px;">
        <button class="newbtn">
            <ul class="box-border" style="list-style-type: none;">
                <li class="side-tip">
                    Changing the self in us can change a lot.
                </li>
            </ul>
        </button>
    </div> -->
    <div class="clearfix"></div>
    <footer class="footer">
       <div class="menu" style="width: 99%; float:right">
            <p class="rights">Rights reserved for Nishant Sir</p>
            <p class="lefts">Made by Priyanshu Kumar</p>
            <p  class="font-low" style="text-align: center;">This page is build only by using html, php and mysql</p>
        </div>
    </footer>
</body>

</html>