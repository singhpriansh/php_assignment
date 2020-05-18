<?php
    include 'class/class-autoload.class.php';
    if((isset($_POST['reg'])&&($_POST['reg'])) || (isset($_POST['pass'])&&($_POST['pass']))){
        $student = new Student();
        if($student->isconnected()){
            $page = new InputvaluesofStudent("","","","", $_POST['reg'],"");
            function regvalid($reg,$page){
                $digits = preg_split('//',$reg);
                for($i=1;$i<10;$i++){
                    if(!preg_match('/\d/',$digits[$i])){
                        $page->set('reg','Only numbers are allowed')->colored('reg','red');
                        return false;
                    }
                }
                if(strlen($reg) != 9){
                    $page->set('reg','Registration number contain 9 digits only')->colored('reg','red');
                    return false;
                }
                $tempvar = new Student();
                if($tempvar->isregistered($reg)){
                    return true;
                }
                $page->set('reg','No account is registered with this number.')->colored('reg','red');
                return false;
            }
            if(empty($_POST['reg'])){
                $reg = false;
                $page->set('reg',"Registration number cannot be skipped")->colored('reg','red');
            }else{
                $reg = regvalid($_POST['reg'],$page);
            }
            if(empty($_POST['pass'])){
                $pass = false;
                $page->pass('Password cannot be skipped','red');
            }else{
                $pass = true;
            }
            if($reg && $pass){
                $isthere = $student->isuser($_POST['reg'], $_POST['pass']);
                if($isthere){
                    session_start();
                    $_SESSION['user'] = $student->getuser($_POST['reg'], $_POST['pass']);
                    header("Location: userpage.php");
                }else{
                    $page->pass('Password entered is incorrect','red');
                }
            }
        }else{
            header("Location: neterror.php");
        }
    }else{
        $page = new InputvaluesofStudent("","","","","","");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GKV | studentlogin</title>
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
            <div class="admin">
                <a href="admin.php"><button class="btn" id="admin">Admin Login</button></a>
            </div>
            <h2 class="heading-text">Student Login</h2>
        </div>
        <div class="allinput">
            <button disabled class="pass-box">
                <ul class="box-border" style="list-style-type: none; width:130%">
                    <li class="side-tip" style="font-size: 22px; color: green; margin-top: 15px">
                        <?php
                            session_start();
                            if(isset($_SESSION['greeting'])){
                                echo $_SESSION['greeting'];
                                unset($_SESSION['greeting']);
                            }
                        ?>
                    </li>
                </ul>
            </button>
            <br>
            <form action="login.php" method="post" id="formed">
                <input type="varchar" name="reg" id="reg" <?php echo $page->get('reg')?> placeholder="Enter your Registration id">
                <input type="password" name="pass" id="pass" placeholder="Enter your password">
                <button disabled class="pass-box">
                    <ul class="box-border" style="list-style-type: none; width:100%">
                        <li class="side-tip">
                            <?php echo $page->get('pass')?>
                        </li>
                    </ul>
                </button>
            </form>
            <button class="dbmsg" isdisabled style="margin-top: 100px; margin-bottom: 15px;">
                <ul class="box-border" style="list-style-type: none;">
                    <li class="side-tip">
                        Just Log in with your registration and password.
                    </li>
                    <!-- <li class="side-tip">
                        Remember your password for consistent Login.
                    </li> -->
                </ul>
            </button>
            <div class="clearfix"></div>
        </div>
        <div class="allbtn" style="border-radius: 7px;">
            <div style="float: right;">
                <a href="index.php"><button class="btn"
                        style="float: right;padding: 7px 48px;font-size: 16px; color: brown; border-radius: 22px;">Not
                        registred ??<br>Register Now</button></a>
            </div>
            <button class="btn" form="formed" type="submit" style="margin: 5px 5px 5px 34px">Sign in</button>
        </div>
    </div>
    <div class="clearfix"></div>
    <footer class="footer">
        <div class="menu" style="width: 99%; float:right">
            <p class="rights">Rights reserved for Nishant Sir</p>
            <p class="lefts">Made by Priyanshu Kumar</p>
            <p class="font-low" style="text-align: center;">This page is build only by using html, php and mysql</p>
        </div>
    </footer>
</body>

</html>