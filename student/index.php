<?php
    include 'class/class-autoload.class.php';
    if((isset($_POST['name'])&&($_POST['name'])) || (isset($_POST['email'])&&($_POST['email'])) || (isset($_POST['phone'])&&($_POST['phone'])) || (isset($_POST['dob'])&&($_POST['dob'])) || (isset($_POST['reg'])&&($_POST['reg'])) || (isset($_POST['pass'])&&($_POST['pass']))){
        $student = new Student();
        if($student->isconnected()){
            $page = new InputvaluesofStudent($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['dob'], $_POST['reg'], $_POST['suggest']);
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
                    $page->setdate('Are you a kid? Minimum age for registration is 18','purple');
                    return false;
                }elseif($dt[0]-100>$bd[0]){
                    $page->setdate('Are you still alive? Enter correct date.','drange');
                    return false;
                }
                $page->setdate('Birth date is ok','green');
                return true;
            }
            function regvalid($reg,$page){
                $digits = preg_split('//',$reg);
                for($i=1;$i<strlen($reg);$i++){
                    if(!preg_match('/\d/',$digits[$i])){
                        $page->set('reg','Only numbers are allowed')->colored('reg','red');
                        return false;
                    }
                }
                if(strlen($reg) != 9){
                    $page->set('reg','Only 9 digit number allowed')->colored('reg','red');
                    return false;
                }
                $tempvar = new Student();
                if($tempvar->isregistered($reg)){
                    $page->set('reg','This number already has a registered account')->colored('reg','red');
                    return false;
                }
                return true;
            }
            function passverification($password,$page){
                $uppercase = preg_match('@[A-Z]@', $password);
                $lowercase = preg_match('@[a-z]@', $password);
                $number    = preg_match('@[0-9]@', $password);
                $specialChars = preg_match('@[^\w]@', $password);                
                if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8){
                    $page->pass('Password should be atleast 8 characters including atleast one upper case letter, one number, and one special character.','red');
                    return false;
                }else{
                    $page->pass('Strong password.','green');
                    return true;
                }
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
                $pass = passverification($_POST['pass'],$page);
            }
            if($name && $email && $phone && $dob && $reg && $pass){
                $student->pushdata($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['dob'], $_POST['reg'], $_POST['pass'], $_POST['suggest']);
                session_start();
                $_SESSION['greeting'] = "Registered successfully";
                header("Location: login.php");
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
    <title>Student Registration</title>
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
            <h2 class="heading-text">Registration form for your database</h2>
        </div>
        <div class="allinput">
            <form action="index.php" method="post" id="formed">
            <input type="text" name="name" id="name" <?php echo $page->get('name')?> placeholder='Enter your name'>
            <input type="email" name="email" id="email" <?php echo $page->get('email')?> placeholder="Enter your email">
            <input type="varchar" name="phone" id="phone" <?php echo $page->get('phone')?> placeholder="Enter your phone number">
            <button disabled class="pass-box" style="margin-top:40px">
                <ul class="box-border" style="list-style-type: none; width:100%">
                    <li class="side-tip">
                        <?php echo $page->get('date')?>
                    </li>
                </ul>
            </button>
            <div style="width: 73%; margin:0px 49px;">
                <p id="dob"> Enter your Date of Birth: </p>
                <input type="date" name="dob" id="dob-inp" <?php echo $page->get('dob')?> >
            </div>
            <input type="varchar" name="reg" id="reg" <?php echo $page->get('reg')?> placeholder="Enter your Registration id">
            <input type="password" name="pass" id="pass" placeholder="Type a strong password">
            <button disabled class="pass-box">
                <ul class="box-border" style="list-style-type: none; width:100%">    
                    <li class="side-tip">
                        <?php echo $page->get('pass')?>
                    </li>
                </ul>
            </button>
            <input name="suggest" type="varchar" id="suggest" style="height:80px; padding-bottom:50px" <?php echo $page->get('suggest')?> placeholder='Suggest any improvements'>
            <!-- <textarea name="suggest" type="varchar" id="suggest" cols="30" rows="4" value="no required" placeholder="Suggest any improvements"></textarea> -->
            <div class="clearfix"></div>
            </form>
        </div>
        <div class="allbtn" style="border-radius: 7px;">
            <button class="btn" form="formed" type="submit" style="margin: 5px 10px 5px 30px">Submit</button>
            <a href="index.php"><button type ="reset" class="btn" style="margin: 5px 15px;">Reset</button></a>
            <div style="float: right;">
                <a href="login.php"><button class="btn" style="float: right;padding: 7px 48px;font-size: 16px; color: brown; border-radius: 22px;" >Already registred ??<br>login here</button></a>
            </div>
        </div>
    </div>
    <div style="padding: 0px 25px 0px 25px;">
        <button class="newbtn">
            <ul class="box-border" style="list-style-type: none;">
                <li class="side-pop">
                    These pages are made by
                </li>
                <li class="side-pop">
                    Priyanshu Kumar
                </li>
                <li class="side-pop">
                    of second year 4th sem 
                </li>
                <li class="side-pop">
                    Reg no : 186301056 
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