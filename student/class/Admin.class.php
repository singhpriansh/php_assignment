<?php
    class Admin extends dbhost{
        public $connected = true;
        public function isconnected(){
            return $this->isconnect();
        }
        public function isuser($user){
            $query ="SELECT * FROM `admin` WHERE name=?";
            $stmnt =$this->connect()->prepare($query);
            $stmnt->execute([$user]);
            $row = $stmnt->fetch();
            if($row['name'] ?? false){
                return true;
            }else{
                return false;
            }
        }
        public function isok($user, $pass){
            $query ="SELECT * FROM `admin` WHERE name=?";
            $stmnt =$this->connect()->prepare($query);
            $stmnt->execute([$user]);
            $row = $stmnt->fetch();
            if($row['passphrase'] == $pass){
                return true;
            }else{
                return false;
            }
        }
        public function fetch_all_studentdata(){
            $query ="SELECT * FROM student_login";
            $stmnt =$this->connect()->query($query);
            return $stmnt->fetchAll();
        }
        public function update($name,$pass){
            $query ="UPDATE `admin` SET `name`=?,`passphrase`=?";
            $stmnt =$this->connect()->prepare($query);
            $stmnt->execute([$name, $pass]);
        }
        public function getstudent($reg){
            $query ="SELECT * FROM student_login WHERE reg=?";
            $stmnt =$this->connect()->prepare($query);
            $stmnt->execute([$reg]);
            return $stmnt->fetch();
        }
        public function updatethis($reg, $name, $email, $phNo, $dob){
            $query ="UPDATE `student_login` SET `name`=?,`email`=?,`phone`=?,`dob`=? WHERE `reg` = ? ";
            $stmnt =$this->connect()->prepare($query);
            $stmnt->execute([$name, $email, $phNo, $dob, $reg]);
        }
        public function delete($reg){
            $query ="DELETE FROM `student_login` WHERE `student_login`.`reg` = ?";
            $stmnt =$this->connect()->prepare($query);
            $stmnt->execute([$reg]);
        }
    }
?>
