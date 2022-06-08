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
        
        $title =  $requestBody['title'];
        $author =  $requestBody['author'];
        $songKey =  $requestBody['key'];
        $year = intval($requestBody['year']);
        $duration = $requestBody['duration'];
        $tempo = intval($requestBody['tempo']);
        $signature = $requestBody['signature'];
        $ytlink = $requestBody['ytlink'];
        $text = $requestBody['text'];

        $success = true;
        $errors = array();

        if(empty($title)){
            $success = false;
            $errors += ["title" => "Title field is required."];
        }

        if(empty($author)){
            $success = false;
            $errors += ["author" => "Author field is required."];
        }

        if(empty($songKey)){
            $success = false;
            $errors += ["key" => "Key field is required."];
        }

        if(empty($year)){
            $success = false;
            $errors += ["year" => "Year field is required."];
        }

        if(empty($duration)){
            $success = false;
            $errors += ["duration" => "Duration field is required."];
        }

        if(empty($text)){
            $success = false;
            $errors += ["text" => "Text field is required."];
        }

        if($year <= 0){
            $success = false;
            $errors += ["year" => "Year must be positive number."];
        }

        if($year > 2022){
            $success = false;
            $errors += ["year" => "Invalid year."];
        }

        $keyRegex = '/^[A-G]$|^[ACDFG][\#]$/i';
        if(!preg_match($keyRegex,$songKey)){
            $success = false;
            $errors += ["key" => "Key is not valid."];
        }

        $durationRegex = '/^[0-5]?[0-9]\:[0-5][0-9]$/';
        if(!preg_match($durationRegex,$duration)){
            $success = false;
            $errors += ["duration" => "Duration should be set in format mm:ss."];
        }

        if($tempo < 20 || $tempo > 300){
            $success = false;
            $errors += ["tempo" => "Tempo must be between 20 and 300."];
        }

        $signatureRegex = '/^[2-4]\/[4]$|^[69]\/8$|^2\/2$|^12\/8$/';
        if(!preg_match($signatureRegex,$signature)){
            $success = false;
            $errors += ["signature" => "Time signature must be one of 2/4, 3/4, 4/4, 2/2, 6/8, 9/8, 12/8."];
        }

        $ytlinkRegex='/^(https:\/\/www\.)?youtube.com\/watch\?v=/';
        if(!preg_match($ytlinkRegex,$ytlink)){
            $success = false;
            $errors += ["ytlink" => "Should be provided valid link to a YouTube video."];
        }

        $ytlink = str_replace("watch?v=","embed/",$ytlink);

        $textRegex ='/\[([^A-G]|[^ACDFG][\#]|[A-G][^\#\]][^m]*)\]/';
        if(preg_match($textRegex,$text) == 1){
            $success = false;
            $errors += ["text" => "Lyrics are not valid."];
        }

        if(!$success){
            $errors += ["success" => $success];
            echo json_encode($errors, JSON_UNESCAPED_UNICODE);
        }else{
            $conn = (new Database())->getConnection();
            
            $stmt = $conn->prepare("INSERT INTO `songs` (`title`, `author`, `key`, `year`, `duration`, `tempo`, `signature`, `url`, `text`) VALUES (:title, :author, :songKey, :year, :duration, :tempo, :signature, :ytlink, :text)");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':author', $author);
            $stmt->bindParam(':songKey', $songKey);
            $stmt->bindParam(':year', $year);
            $stmt->bindParam(':duration', $duration);
            $stmt->bindParam(':tempo', $tempo);
            $stmt->bindParam(':signature', $signature);
            $stmt->bindParam(':ytlink', $ytlink);
            $stmt->bindParam(':text', $text);
            $stmt->execute();
            
            echo json_encode(["success" => $success]);
        }
        break;
    }
}