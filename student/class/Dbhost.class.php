<?php
    class dbhost {
        private $host = "localhost";
        private $user = "root";
        private $passwd = "";
        private $dbName = "login_portal";
        protected function isconnect(){
            $dsn = 'mysql:host='.$this->host .';dbname='.$this->dbName;
            try{
                $pdo = new PDO($dsn, $this->user, $this->passwd);
            }catch(Exception $e){
                return false;
            }
            return true;
        }
        protected function connect(){
            $dsn = 'mysql:host='.$this->host .';dbname='.$this->dbName;
            try{
                $pdo = new PDO($dsn, $this->user, $this->passwd);
            }catch(Exception $e){
                $e = "Error: ".$e->getMessage();
                echo "<h2 style='font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size=28px'>$e</h2>";
                return false;
            }
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        }
    }
?>