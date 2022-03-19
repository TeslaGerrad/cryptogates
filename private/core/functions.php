<?php
    function show($data){
        echo("<pre>");
        print_r($data);
    }
    
    function esc($data) {
        $data = addslashes($data);
        return htmlspecialchars($data);
    }