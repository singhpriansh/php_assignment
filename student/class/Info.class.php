<?php
    class Info{
        private $adminame="";
        private $adminoldpass="";
        private $adminnewpass="";
        private $adminconfpass="";
        public function setname($str){
            $this->adminame=$str;
        }
        public function getname(){
            return $this->adminame;
        }
        public function setoldpass($str){
            $this->adminoldpass=$str;
        }
        public function getoldpass(){
            return $this->adminoldpass;
        }
        public function setnewpass($str){
            $this->adminnewpass=$str;
        }
        public function getnewpass(){
            return $this->adminnewpass;
        }
        public function setconfpass($str){
            $this->adminconfpass=$str;
        }
        public function getconfpass(){
            return $this->adminconfpass;
        }
    }

?>