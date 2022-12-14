<?php

    class database{
        public $db;
        private $db_host = "sql213.epizy.com";
        private $db_user = "icei_32517729";
        private $db_password = "opkinshuk09999";
        private $db_name = "icei_32517729_idk";

        public function connect()
        {
            $this->db = new PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_name, $this->db_user, $this->db_password);

            if(!$this->db){
                die("Failed to connect");
            }
        }

        public function custom_query($query,$arr = NULL){
            $q = $this->db->prepare($query);
            $q->execute($arr);
            return $q->fetchall();
        }

        public function delete_all($table){
            $q = $this->db->prepare("TRUNCATE TABLE $table");
            return $q->execute();
        }

        public function select_all($table){
            $q = $this->db->prepare("SELECT * FROM $table");
            $q->execute();
            return $q->fetchall();
        }

        public function select($what,$table, $specifier = NULL,$val = NULL, $type = NULL){
            if(!$type){
                $q = $this->db->prepare("SELECT $what FROM $table WHERE $specifier = :s");
                $q->execute(array("s"=>$val));
                return $q->fetchall();
            }else{
                $q = $this->db->prepare("SELECT $what FROM $table");
                $q->execute(array("s"=>$val));
                return $q->fetchall();
            }

        }

        public function insert_query($where, $col){
            $vals = NULL;
            $column = NULL;
            foreach ($col as $key => $val){
                if($column){
                    $column .= " , `".$key."`";
                }else{
                    $column .= "`".$key."`";
                }

                if($vals){
                    $vals .= ",:".$key;
                }else{
                    $vals .= ":".$key;
                }
            }
            $q = $this->db->prepare("INSERT INTO $where ($column) VALUES ($vals) ");
            return $q->execute($col);
        }

        public function update($where,$col,$specifier,$spec){ //where = table, col = column, spesifier = spesify column i.e where xx, spec = value i.e where = spec
            $vals = NULL;
            $column = NULL;
            foreach ($col as $key => $val){
                if($column){
                    $column .= " , `".$key."` = :".$key;
                }else{
                    $column .= "`".$key."` = :".$key;
                }

            }

            $q = $this->db->prepare("UPDATE $where SET $column WHERE $specifier = :spec ");
            $col['spec'] = $spec;
            return $q->execute($col);

        }
        public function insert_id(){
            return $this->db->mysqli_insert_id();
        }
        static function sanitize($val){
            return htmlspecialchars($val);
        }

        public function generateRandomString() {
            $length = rand(4, 4);
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return strtoupper($randomString);
        }
        public function generateRandomString10() {
            $length = rand(10, 10);
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return strtoupper($randomString);
        }

    }