<?php
class InputvaluesofStudent{
    public $name ;
    public $email ;
    public $phone ;
    public $dob ;
    public $date ;
    public $reg ;
    public $pass ;
    public $suggest;
    public function __construct($name,$email,$phNo,$dob,$reg,$suggestion){
        $this->name =" value=\"".$name."\"";
        $this->email =" value=\"".$email."\"";
        $this->phone =" value=\"".$phNo."\"";
        $this->dob =" value=\"".$dob."\"";
        $this->date ="";
        $this->reg =" value=\"".$reg."\"";
        $this->pass ="";
        $this->suggest =" value=\"".$suggestion."\"";
    }
    public function set($obj,$msg){
        $tmp =" value=\"".$msg."\"";
        $this->$obj =$tmp;
        return $this;
    }
    public function pass($msg,$color){
        $tmp ="<p style=\"color:".$color."\">".$msg."</p>";
        $this->pass =$tmp;
        return $this;
    }
    public function setdate($msg,$color){
        $tmp ="<p style=\"color:".$color."\">".$msg."</p>";
        $this->date =$tmp;
        return $this;
    }
    public function get($obj){
        return $this->$obj;
    }
    public function colored($obj,$color){
        $this->$obj = $this->$obj." style=\"color:".$color."\"";
    }
}
?>