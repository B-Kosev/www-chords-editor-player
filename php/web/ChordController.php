<?php

require_once '../model/Bootstrap.php';
Bootstrap::initApp();

switch ($_SERVER['REQUEST_METHOD']) {

    case 'GET': {
        
        $selectedChordId = isset($_GET['id']) ? $_GET['id'] : null;
        
        $response = null;

        if ($selectedChordId) {
            $response = ChordService::getChordById($selectedChordId);
        } else {
            break;
        }

        // print_r($response);
        echo json_encode($response, JSON_UNESCAPED_UNICODE);

        break;
    }
    case 'POST': {
        break;
    }
}