<?php
    include 'class/class-autoload.class.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GKV admin</title>
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
            <h2 class="reg-text">Admin Page</h2>
        </div>
        <div class="allinput">
            <table class="tab-new table table-bordered table- table-responsive">
                <thead class="thead-inverse" style="font-size:18px">
                    <tr>
                        <th>Reg No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date of Birth</th>
                        <th>Operate</th>
                    </tr>
                </thead>
                    <?php
                        $adm = new Admin();
                        $table =$adm->fetch_all_studentdata();
                        echo "<tbody style=\"font-size:16px\">";
                            foreach($table as $student){
                                echo "<tr style=\"text-align:center\">";
                                    echo "<form action=\"validity.php\" name=\"confidential\" method=\"post\">
                                            <td style=\"width:15%;\"><input readonly class=\"disabledinput\" name=\"confidential\" value=\"".$student['reg']."\"></td>";
                                            echo "<td style=\"width:10%; text-align:left\">".$student['name']."</td>";
                                            echo "<td>".$student['email']."</td>";
                                            echo "<td>".$student['phone']."</td>";
                                            echo "<td>".$student['dob']."</td>";
                                    echo "<td style=\"width:10%\"><button type=\"submit\" class=\"opbtn\"><--+ this_student </button></td></form>";
                                echo "</tr>";
                            }
                        echo "</tbody>";
                    ?>
            </table>
            <button readonly style="padding: 0px; margin: 45px 60px 35px 60px; border: medium none; background-color: white">
            </button>
            <!-- <form  id="qry"><input type="text" name="query" id="query" placeholder="Run a custom query"><button class="opbtn" form="query" type="submit" style="margin:5px; padding:1px 5px 4px 14px;">query<form> -->
                <?php?>
        </div>
        <div class="allbtn" style="border-radius: 7px; padding: 5px;">
            <a href="adminreset.php"><button class="btn" style="margin: 5px 15px 5px 15px;">Reset account</button></a>
            <a href="admin.php"><button class="btn" style="float:right; margin: 5px 5px 5px 34px;">Sign out</button></a>
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
                    The student Database has been created using the command:
                </li>
                <li class="side-tip" style="font-size: 16px;">
                    CREATE TABLE `login_portal`.`student_login` ( `name` TEXT NOT NULL , `email` VARCHAR(35) NOT NULL , `phone` BIGINT(10) NOT NULL , `dob` DATE NOT NULL , `reg` INT NOT NULL , `pass` VARCHAR(30) NOT NULL , `suggestion` TEXT NOT NULL , `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`reg`, `timestamp`), UNIQUE (`reg`)) ENGINE = InnoDB COMMENT = 'Storage engine InnoDB';
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