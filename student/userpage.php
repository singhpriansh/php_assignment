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
            <div class="logo"><a href="https://www.gkv.ac.in/"></a><img src="./pictures/logo.png"></a></div>
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
            <h2 class="heading-text">
            <?php
                session_start();
                if(isset($_SESSION['user'])){
                    echo $_SESSION['user'];
                }
            ?>'s page</h2>
        </div>
        <div class="allinput">
            <p style="font-family:cursive; font-size:16px; margin: 5px 25px; width:97%">Gurukula Kangri Vishwavidyalaya was founded on March 4, 1902 by Swami Shraddhanandaji with the sole aim to revive the ancient Indian Gurukula System of education, on the bank of Ganges at a distance of about 6 km. from Hardwar and about 200 km. from Delhi. This institution was established with the objective of providing an indigenous alternative to Lord Macaulay’s education policy by imparting education in the areas of vedic literature, Indian philosophy, Indian culture, modern sciences and research.It is a deemed to be university fully funded by UGC/Govt. of India.
            
            Arya Samaj has been advocating women’s education since the day it was founded. As part of its policies for the up-liftment of women in the country, Kanya Gurukula Campus, Dehradun was established in 1922 by Acharya Ramdevji as a second campus of women’s education. To give real shape to the dreams of Swami Shraddhanandaji, Kanya Gurukula Campus, Hardwar was established in 1993.</p>
            <button class="dbmsg" isdisabled style="margin-top: 9px; margin-bottom: 15px;">
                <ul class="box-border" style="list-style-type: none;">
                    <li class="side-tip">
                        You can log out now.
                    </li>
                </ul>
            </button>
        </div>
        <div class="allbtn" style="border-radius: 7px;">
            <a href="login.php"><button class="btn" style="margin: 5px 5px 5px 34px;">Sign out now</button></a>
            <a href="usereset.php"><button class="btn" style="margin: 5px 5px 5px 34px;">Reset your password</button></a>
        </div>
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