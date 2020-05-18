<?php
    include 'class/class-autoload.class.php';
    $admin = new Admin();
    session_start();
    if($admin->isconnected()){
        if($_SESSION['var'] ==true){
            $page = new InputvaluesofStudent($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['dob'], $_POST['reg'],$_POST['suggestion']);
            if(empty($_POST['suggestion'])){
                $page->set('suggest','Field is empty')->colored('suggest','lightblue');
            }
            function namevalid($name,$page){
                $names = preg_split('//',$name);
                for($i=0;$i<strlen($name);){
                    ++$i;
                    if(!preg_match('/[a-zA-Z]/',$names[$i]) && (' ' != $names[$i])){
                        $page->set('name','Special character like \'$,\'%.*&\' and numbers are not allowed')->colored('name','red');
                        return false;
                    }
                }
                return true;
            }
            function emailvalid($email,$page){
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $page->set('email',"Invalid email format")->colored('email','red');
                    return false;
                }
                return true;
            }
            function phonevalid($phone,$page){
                $digits = preg_split('//',$phone);
                for($i=1;$i<11;$i++){
                    if(!preg_match('/\d/',$digits[$i])){
                        $page->set('phone','Only numbers are allowed')->colored('phone','red');
                        return false;
                    }
                }
                if(strlen($phone) != 10){
                    $page->set('phone','Only 10 digit number allowed')->colored('phone','red');
                    return false;
                }
                return true;
            }
            function dobvalid($dob,$page){
                $dt = date('Y-m-d');
                $bd = preg_split('/-/',$dob);
                $dt = preg_split('/-/',$dt);
                if($dt[0]<=$bd[0]){
                    $page->setdate('Date entered is invalid','red');
                    return false;
                }elseif($dt[0]-18<=$bd[0]){
                    $page->setdate('Kids not allowed minimum age for registration is 18','purple');
                    return false;
                }elseif($dt[0]-100>$bd[0]){
                    $page->setdate('Still alive? Enter correct date.','drange');
                    return false;
                }
                return true;
            }
            if(empty($_POST['name'])){
                $name = false;
                $page->set('name','Name is required')->colored('name','red');
            }else{
                $name = namevalid($_POST['name'],$page);
            }
            if(empty($_POST['email'])){
                $email = false;
                $page->set('email','Email is required')->colored('email','red');
            }else{
                $email = emailvalid($_POST['email'],$page);
            }
            if(empty($_POST['phone'])){
                $phone = false;
                $page->set('phone','Phone Number is required')->colored('phone','red');
            }else{
                $phone = phonevalid($_POST['phone'],$page);
            }
            if(empty($_POST['dob'])){
                $dob = false;
                $page->setdate('Date not entered','red');
            }else{
                $dob = dobvalid($_POST['dob'],$page);
            }
            if($name && $email && $phone && $dob){
                $admin->updatethis($_POST['reg'], $_POST['name'], $_POST['email'], $_POST['phone'], $_POST['dob']);
                unset($_SESSION['name']);
                unset($_SESSION['email']);
                unset($_SESSION['phone']);
                unset($_SESSION['dob']);
                unset($_SESSION['reg']);
                unset($_SESSION['pass']);
                unset($_SESSION['timestamp']);
                unset($_SESSION['suggestion']);
                session_destroy();
                header("Location: adminpage.php");
            }
        }else{
            $page = new InputvaluesofStudent($_SESSION['name'], $_SESSION['email'], $_SESSION['phone'], $_SESSION['dob'], $_SESSION['reg'],$_SESSION['suggestion']);
            if(empty($_SESSION['suggestion'])){
                $page->set('suggest','Field is empty')->colored('suggest','lightblue');
            }
            $_POST['name']=$_SESSION['name'];
            $_POST['reg']=$_SESSION['reg'];
            $_SESSION['var']= true;
        }
        $_SESSION['reg']=$_POST['reg']; 
    }else{
        header("Location: neterror.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GKV student Info</title>
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
            <h2 class="reg-text"><?php echo $_POST['name']?>'s Data</h2>
        </div>
        <div class="updateinput">
            <form action="student_info.php" method="post" id="form_fill">
            <button disabled class="pass-box" style="padding-top:160px" >
                <ul class="box-border" style="list-style-type: none; width:100%">
                    <li class="side-tip">
                        <?php echo $page->get('date')?>
                    </li>
                </ul>
            </button>
            <!-- <input type="varchar"  name="reg" style="color: darkgreen; background: aquamarine " id="reg" value="Registration No." > -->
            <div style="width:75%; margin: 4px 0px 4px 35px;">
                <div class="item" style="width:100%">
                    <p class="query" style="width:25%; float:left;" >Registration no : </p>
                    <input type="varchar" class="readonly" readonly style="color: darkgreen; background: aquamarine " name="reg" id="reg" value="<?php echo $_POST["reg"]?>"?>
                </div>
                <div class="item" style="width:100%">
                    <p class="query" style="width:25%; float:left;" >Name : </p>
                    <input type="text" class="readonly" name="name" id="name" <?php echo $page->get('name')?> >
                </div>
                <div class="item" style="width:100%">
                    <p class="query" style="width:25%; float:left;" >Email : </p>
                    <input type="email" class="readonly" name="email" id="email" <?php echo $page->get('email')?> >
                </div>
                <div class="item" style="width:100%">
                    <p class="query" style="width:25%; float:left;" >Phone no. : </p>
                    <input type="varchar" class="readonly" name="phone" id="phone" <?php echo $page->get('phone')?> >
                </div>
                <div class="item" style="width:100%">
                    <p class="query" style="width:25%; float:left;" >Date of Birth : </p>
                    <input type="date" class="readonly" name="dob" id="dob-inp"<?php echo $page->get('dob')?> >
                </div>
                <div class="item" style="width:100%">
                    <p class="query" style="width:25%; float:left;" >Login password:</p>
                    <input type="varchar" class="readonly" readonly name="pass" id="pass" <?php echo "value=\"".$_SESSION['pass']."\""?>>
                </div>
                <div class="item" style="width:100%">
                    <p class="query" style="width:25%; float:left;" >Suggested : </p>
                    <input name="suggestion" class="readonly" <?php echo $page->get('suggest')?> readonly type="varchar" id="suggestion" >
                </div>
                <div class="item" style="width:100%">
                    <p class="query" style="width:25%; float:left;" >Account timestamp: </p>
                <input name="timestamp" class="readonly" readonly type="varchar" id="time" <?php echo "value=\"".$_SESSION['timestamp']."\""?>>
                </div>
            </div>
            </form>
            <!-- <form  id="qry"><input type="text" name="query" id="query" placeholder="Run a custom query"><button class="opbtn" form="query" type="submit" style="margin:5px; padding:1px 5px 4px 14px;">query<form> -->
                <?php?>
        </div>
        <div class="allbtn" style="border-radius: 7px; padding: 5px;">
            <a href="delete_student.php"><button class="btn" style="margin: 5px 15px 5px 15px;">Delete</button></a>
            <button form="form_fill" class="btn" style="margin: 5px 15px 5px 15px;">Update</button>
            <a href="adminpage.php"><button class="btn" style="float:right; margin: 5px 5px 5px 34px;">Back</button></a>
        </div>
    </div>
    <div style="padding: 0px 25px 0px 25px;">
        <button class="newbtn">
            <ul class="box-border" style="list-style-type: none;">
                <li class="side-tip">
                    With great power comes great responsibility.
                </li>
                <li class="side-tip">
                    Use your power with ease.
                </li>
            </ul>
        </button>
        <button class="newbtn">
            <ul class="box-border" style="list-style-type: none;">
                <li class="side-tip">
                    The password and Suggested field cannot be edited.
                </li>
                <li class="side-tip">
                    The timestamp shown the time when student created the account.
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