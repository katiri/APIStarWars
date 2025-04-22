<?php
    if($http_code){
        http_response_code($http_code);
    }

    header('Content-Type: application/json');
    
    echo json_encode($film);