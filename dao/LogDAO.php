<?php
    require_once('models/Log.php');

    class LogDAO implements LogDAOInterface{
        private $conn;

        public function __construct(PDO $conn){
            $this->conn = $conn;
        }

        public function create($requisition){
            $now = new DateTime();
            $now = $now->format('Y-m-d H:i:s');

            $stmt = $this->conn->prepare("INSERT INTO logs 
                (date_time, requisition)
                VALUES
                (:date_time, :requisition)
            ");
            $stmt->bindParam(':date_time', $now);
            $stmt->bindParam(':requisition', $requisition);

            $stmt->execute();
        }
    }