<?php
    class Log{
        public $id;
        public $date_time;
        public $requisition;
    }

    interface LogDAOInterface{
        public function create($requisition);
    }