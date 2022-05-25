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
        $key =  $requestBody['key'];
        $year = $requestBody['year'];
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

        if(empty($key)){
            $success = false;
            $errors += ["key" => "Key field is required."];
        }

        if(empty($year)){
            $success = false;
            $errors += ["year" => "Year field is required."];
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
        if(!preg_match($keyRegex,$key)){
            $success = false;
            $errors += ["key" => "Key is not valid."];
        }

        // $textRegex ='/([^\[\]])*\[([A-G]|[ACDFG][\#])([m])?\]([^\[\]])*/s';
        $textRegex = '/([A-Za-z\s,!;\.0-9]*\[([A-G]|[ACDFG][\#])[m]?\][A-Za-z\s,!;\.0-9]*)*/';
        if(!preg_match($textRegex,$text)){
            $success = false;
            $errors += ["text" => "Lyrics are not valid."];
        }

        if(!$success){
            $errors += ["success" => $success];
            echo json_encode($errors, JSON_UNESCAPED_UNICODE);
        }else{
            $conn = new mysqli("localhost","root","","chordsplayereditor");
        
            if($conn->connect_error){
                die("Connection Failed : ".$conn->connect_error);
            }else{
                $stmt = $conn->prepare("INSERT INTO songs (title, author, key, year, text) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssis", $title, $author, $key, $year, $text);
                $stmt->execute();
                $stmt->close();
                $conn->close();

                echo json_encode(["success" => $success]);
            }
        }
        break;
    }
}