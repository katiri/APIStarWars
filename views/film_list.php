<?php
    if($http_code){
        http_response_code($http_code);
    }
    
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");

    header('Content-Type: application/json');
    
    echo json_encode($list_films);