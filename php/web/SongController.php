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

        $durationRegex = '/^[0-5][0-9]\:[0-5][0-9]$/';
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

        // $textRegex ='/([^\[\]])*\[([A-G]|[ACDFG][\#])([m])?\]([^\[\]])*/s';
        // $textRegex = '/([A-Za-z\s,!;\.0-9]*\[([A-G]|[ACDFG][\#])[m]?\][A-Za-z\s,!;\.0-9]*)*/';
        $textRegex = '/\[([^A-G](.)*|[^ACDFG][\#](.)*|[A-G][^\#][^m]*(.)*)\]g/';
        if(preg_match($textRegex,$text) == 1){
            $success = false;
            $errors += ["text" => "Lyrics are not valid."];
        }

        if(!$success){
            $errors += ["success" => $success];
            echo json_encode($errors, JSON_UNESCAPED_UNICODE);
        }else{
            $conn = (new Database())->getConnection();
            // cast year to int
            $stmt = $conn->prepare("INSERT INTO `songs` (`title`, `author`, `key`, `year`, `text`) VALUES (:title, :author, :songKey, :year, :text)");
            // $stmt = $conn->prepare("INSERT INTO 'songs' ('title', 'author', 'key', 'year', 'text') VALUES (:title, :author, :songKey, :year, :text)");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':author', $author);
            $stmt->bindParam(':songKey', $songKey);
            $stmt->bindParam(':year', $year);
            $stmt->bindParam(':text', $text);
            $stmt->execute();
            echo json_encode(["success" => $success]);
            // echo json_encode(['title' => $title, 'author' => $author, 'key'=>$key, 'year'=> $year, 'text'=> $text]);
            // $conn = new mysqli("localhost","root","","chordsplayereditor");
        
            // if($conn->connect_error){
            //     die("Connection Failed : ".$conn->connect_error);
            // }else{
            //     $stmt = $conn->prepare("INSERT INTO songs (title, author, key, year, text) VALUES (?, ?, ?, ?, ?)");
            //     $stmt->bind_param("sssis", $title, $author, $key, $year, $text);
            //     $stmt->execute();
            //     $stmt->close();
            //     $conn->close();

            //     echo json_encode(["success" => $success]);
            // }
        }
        break;
    }
}