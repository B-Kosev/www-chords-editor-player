<?php

require_once '../model/Bootstrap.php';
Bootstrap::initApp();

switch ($_SERVER['REQUEST_METHOD']) {

    case 'GET': {
        
        $songTitle = isset($_GET['title']) ? $_GET['title'] : null;
        
        $response = null;

        if ($songTitle) {
            $response = SongService::getSongByTitle($songTitle);
        } else {
            $response = SongService::getAllSongs();
        }

        // print_r($response);
        echo json_encode($response, JSON_UNESCAPED_UNICODE);

        break;
    }
    case 'POST': {
        break;
    }
}