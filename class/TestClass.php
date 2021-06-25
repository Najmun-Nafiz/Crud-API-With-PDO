<?php
    class Test{

        // Connection
        private $conn;

        // Table
        private $db_table = "test";

        // Columns
        public $id;
        public $name;
        public $email;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // all data to fetch...
        public function getData(){
            $sqlQuery = "SELECT * FROM ".$this->db_table ."";
            $data = $this->conn->prepare($sqlQuery);
            $data->execute();
            return $data;
        }

        // create data to database...
        public function createData(){

            $sqlQuery = "INSERT INTO ".$this->db_table." SET name = :name, email = :email";
            $data = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->email=htmlspecialchars(strip_tags($this->email));
        
            // bind data
            $data->bindParam(":name", $this->name);
            $data->bindParam(":email", $this->email);

            if($data->execute()){
               return true;
            }
            return false;
        }

        // single data to fetch...
        public function getSingleData(){
            $sqlQuery = "SELECT id, name, email FROM ".$this->db_table." WHERE id=?";

            $data = $this->conn->prepare($sqlQuery);
            $data->bindParam(1, $this->id);
            $data->execute();

            $dataRow = $data->fetch(PDO::FETCH_ASSOC);
            $this->name = $dataRow['name'];
            $this->email = $dataRow['email'];
        }        

        // single data update from database...
        public function updateData(){
            $sqlQuery = "UPDATE ".$this->db_table." SET name=:name, email=:email WHERE id=:id";
        
            $data = $this->conn->prepare($sqlQuery);
        
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $data->bindParam(":name", $this->name);
            $data->bindParam(":email", $this->email);
            $data->bindParam(":id", $this->id);
        
            if($data->execute()){
               return true;
            }
            return false;
        }

        // delete data from database...
        function deleteData(){
            $sqlQuery = "DELETE FROM ".$this->db_table." WHERE id=?";
            $data = $this->conn->prepare($sqlQuery);
            $data->bindParam(1, $this->id);
        
            if($data->execute()){
                return true;
            }
            return false;
        }

    }
?>