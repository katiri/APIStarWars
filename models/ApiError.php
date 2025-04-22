<?php
    class ApiError{
        public $id;
        public $date_time;
        public $requisition;
        public $http_code;
        public $message;
    }

    interface ApiErrorDAOInterface{
        public function create(ApiError $error);
    }