<?php
    class Student extends dbhost{
        public $connected = true;
        public function isconnected(){
            return $this->isconnect();
        }
        public function pushdata($name, $email, $phNo, $dob, $reg, $pass, $suggestion){
            $query ="INSERT INTO student_login (`name`, `email`, `phone`, `dob`, `reg`, `pass`, `suggestion`, `timestamp`) VALUES (?, ?, ?, ?, ?, ?, ?, current_timestamp())";
            $stmnt = $this->connect()->prepare($query);
            $stmnt->execute([$name, $email, $phNo, $dob, $reg, $pass, $suggestion]);
        }
        public function isregistered($reg){
            $query ="SELECT * FROM student_login WHERE reg=?";
            $stmnt =$this->connect()->prepare($query);
            $stmnt->execute([$reg]);
            $row = $stmnt->fetch();
            if($row['reg'] ?? false){
                return true;
            }else{
                return false;
            }
        }
        public function isuser($reg, $pass){
            $query ="SELECT * FROM student_login WHERE reg=?";
            $stmnt =$this->connect()->prepare($query);
            $stmnt->execute([$reg]);
            $row = $stmnt->fetch();
            if($row['pass'] == $pass){
                return true;
            }else{
                return false;
            }
        }
        public function getuser($reg, $pass){
            $query ="SELECT * FROM student_login WHERE reg=?";
            $stmnt =$this->connect()->prepare($query);
            $stmnt->execute([$reg]);
            $row = $stmnt->fetch();
            return $row['name'];
        }
        public function update($reg,$pass){
            $query ="UPDATE `student_login` SET `pass`=? WHERE reg=?";
            $stmnt =$this->connect()->prepare($query);
            $stmnt->execute([$reg, $pass]);
        }
    }
?>
