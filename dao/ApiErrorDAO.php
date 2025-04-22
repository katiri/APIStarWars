<?php
    require_once('models/ApiError.php');

    class ApiErrorDAO implements ApiErrorDAOInterface{
        private $conn;

        public function __construct(PDO $conn){
            $this->conn = $conn;
        }

        public function create(ApiError $error){
            $stmt = $this->conn->prepare("INSERT INTO errors 
                (date_time, requisition, http_code, message)
                VALUES
                (:date_time, :requisition, :http_code, :message)
            ");
            $stmt->bindParam(':date_time', $error->date_time);
            $stmt->bindParam(':requisition', $error->requisition);
            $stmt->bindParam(':http_code', $error->http_code);
            $stmt->bindParam(':message', $error->message);

            $stmt->execute();
        }
    }