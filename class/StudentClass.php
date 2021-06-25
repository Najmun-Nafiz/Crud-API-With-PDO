<?php
    class Student{

        // Connection
        private $conn;

        // Table
        private $db_table = "students";

        // Columns
        public $id;
        public $name;
        public $batch;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // all data to fetch...
        public function getData(){
            $sqlQuery = "SELECT * FROM ".$this->db_table."";
            $data = $this->conn->prepare($sqlQuery);
            $data->execute();
            return $data;
        }

        // create data to database...
        public function createData(){

            $sqlQuery = "INSERT INTO ".$this->db_table." SET name=:name, batch=:batch";
            $data = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->batch=htmlspecialchars(strip_tags($this->batch));
        
            // bind data
            $data->bindParam(":name", $this->name);
            $data->bindParam(":batch", $this->batch);

            if($data->execute()){
               return true;
            }
            return false;
        }

        // single data to fetch...
        public function getSingleData(){
            $sqlQuery = "SELECT id, name, batch FROM ".$this->db_table." WHERE id=?";

            $data = $this->conn->prepare($sqlQuery);
            $data->bindParam(1, $this->id);
            $data->execute();

            $dataRow = $data->fetch(PDO::FETCH_ASSOC);
            $this->name = $dataRow['name'];
            $this->batch = $dataRow['batch'];
        }        

        // single data update from database...
        public function updateData(){
            $sqlQuery = "UPDATE ".$this->db_table." SET name=:name, batch=:batch WHERE id=:id";
        
            $data = $this->conn->prepare($sqlQuery);
        
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->batch=htmlspecialchars(strip_tags($this->batch));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $data->bindParam(":name", $this->name);
            $data->bindParam(":batch", $this->batch);
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