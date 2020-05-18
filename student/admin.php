<?php
    class Info{
        private $adminame="";
        public function setname($str){
            $this->adminame=$str;
        }
        public function getname(){
            return $this->adminame;
        }
    }
    $info = new Info();
    include 'class/class-autoload.class.php';
    if((isset($_POST['name'])&&($_POST['name'])) || (isset($_POST['pass'])&&($_POST['pass']))){
        $admin = new Admin();
        if($admin->isconnected()){
            $info->setname(" value=\"".$_POST['name']."\"");
            $adminpass="";
            function namevalid($name,$info){
                $names = preg_split('//',$name);
                for($i=0;$i<strlen($name);){
                    ++$i;
                    if(!preg_match('/[a-zA-Z]/',$names[$i]) && (' ' != $names[$i])){
                        $info->setname(" value=\"Don't insert numbers and special character like \'$,\'%.*&\'\" style=\"color:red\"");
                        return false;
                    }
                }
                $a = new Admin();
                if($a->isuser($name)){
                    return true;
                }else{
                    $info->setname(" value=\"Admin does not have this name\" style=\"color:red\"");
                    return false;
                }
            }
            if(empty($_POST['name'])){
                $name = false;
                $info->setname(" value=\"Who is logging as admin?\" style=\"color:red\"");
            }else{
                $name = namevalid($_POST['name'],$info);
            }
            if(empty($_POST['pass'])){
                $pass = false;
                $adminpass = "<p style=\"color:red\">Password cannot be skipped</p>";
            }else{
                $pass = true;
            }
            if($name && $pass){
                $isthere = $admin->isok($_POST['name'], $_POST['pass']);
                if($isthere){
                    session_start();
                    $_SESSION['user'] = $_POST['name'];
                    header("Location: adminpage.php");
                }else{
                    $adminpass = "<p style=\"color:red\">Password entered is incorrect</p>";
                }
            }
        }else{
            header("Location: neterror.php");
        }
    }else{
        $adminame="";
        $adminpass="";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GKV | adminlogin</title>
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
            <div class="regular">
                <a href="login.php"><button class="btn" id="regular">Login as regular use</button></a>
            </div>
            <h2 class="reg-text">Admin Login Page</h2>
        </div>
        <div class="allinput">
            <br>
            <form action="admin.php" method="post" id="form1">
                <input type="text" name="name" id="name" <?php echo $info->getname() ?> placeholder="Enter your username">
                <input type="password" name="pass" id="pass" placeholder="Enter the admin's passphrase">
                <button disabled class="pass-box">
                    <ul class="box-border" style="list-style-type: none; width:100%">
                        <li class="side-tip">
                            <?php echo $adminpass ?>
                        </li>
                    </ul>
                </button>
            </form>
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
            <!-- <textarea name="message" type="varchar" id="message" cols="30" rows="4"  placeholder="Give any message or reminder to admin."></textarea> -->
            <!-- <button class="dbmsg" isdisabled style="margin-top: 40px; margin-bottom: 15px;">
                <ul class="box-border" style="list-style-type: none;">
                    <li class="side-tip">
                    </li>
                    <li class="side-tip">
                       
                    </li>
                </ul>
            </button> -->
            <!-- <div class="clearfix"></div> -->
        </div>
        <div class="allbtn" style="border-radius: 7px;">
            <div style="float: right;">
                <button class="btn" form="form1" type="submit" style="float: right;padding: 7px 48px; font-size: 16px; color: brown; border-radius: 22px;">Enter into Databases<br> As Administrator</button>
            </div>
            <!-- <button class="btn" form="form2" type="submit"style="float;left; position:relative; margin: 5px 15px 5px 15px;">Message to admin</button> -->
        </div>
    </div>
    <div style="padding: 0px 25px 0px 25px;">
        <button class="newbtn" disabled>
            <ul class="box-border" style="list-style-type: none;">
                <li class="side-tip">
                    Default username for admin: "charlie".
                </li>
                <li class="side-tip">
                    Default admin password: "Adm!ni$4r@tor".
                </li>
            </ul>
        </button>
    </div>
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

<!-- CREATE TABLE `login_portal`.`admin` ( `name` TEXT NOT NULL , `passphrase` VARCHAR(35) NOT NULL ) ENGINE = InnoDB COMMENT = 'admin_db';  -->