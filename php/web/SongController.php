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

        echo json_encode($response, JSON_UNESCAPED_UNICODE);

        break;
    }
    case 'POST': {
        $requestBody = json_decode(file_get_contents("php://input"), true);
        
        $newSong = new Song(0, $requestBody['title'], $requestBody['author'], $requestBody['key'], 
        intval($requestBody['year']), $requestBody['duration'], intval($requestBody['tempo']),
        $requestBody['signature'], $requestBody['ytlink'], $requestBody['text']);

        SongService::addSong($newSong);
        
        break;
    }
}