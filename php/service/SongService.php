<?php

class SongService {

    public static function getSongByTitle(string $songTitle): Song {

        $sql   = "SELECT * FROM `songs` WHERE title = :song_title";
        $selectStatement = (new Database())->getConnection()->prepare($sql);

        $selectStatement->execute(['song_title' => $songTitle]);

        $songDbRow = $selectStatement->fetch();

        if (!$songDbRow) {
            throw new NotFoundException("Song with title $songTitle not found");
        }

        return Song::createFromAssoc($songDbRow);
    }

    public static function getAllSongs(): array {

        $sql   = "SELECT * FROM `songs` ORDER BY title ASC";
        $selectStatement = (new Database())->getConnection()->prepare($sql);
        $selectStatement->execute();

        $allSongs = [];
        foreach ($selectStatement->fetchAll() as $song) {
            $allSongs[] = Song::createFromAssoc($song);
        }

        return $allSongs;
    }

    public static function addSong(Song $song): void{
        $errors = SongService::validation($song);

        if(sizeof($errors) > 0){
            $errors += ["success" => false];
            echo json_encode($errors, JSON_UNESCAPED_UNICODE);
        }else{
            $conn = (new Database())->getConnection();
            
            $stmt = $conn->prepare("INSERT INTO `songs` (`title`, `author`, `key`, `year`, `duration`, `tempo`, `signature`, `url`, `text`) VALUES (:title, :author, :songKey, :year, :duration, :tempo, :signature, :ytlink, :text)");
            $stmt->execute([':title' => $song->getTitle(), ':author'=> $song->getAuthor(),':songKey' => $song->getKey(),
            ':year' => $song->getYear(), ':duration' => $song->getDuration(), ':tempo' => $song->getTempo(), 
            ':signature' => $song->getSignature(), ':ytlink' => $song->getUrl(), ':text' => $song->getText()]);
            
            echo json_encode(["success" => true]);
        }
        
    }

    private static function validation(Song $song): array{
        $errors = array();
       
        if($song->getTitle() == null){
            $errors += ["title" => "Title field is required."];
        }

        if($song->getAuthor() == null){
            $errors += ["author" => "Author field is required."];
        }

        if($song->getKey() == null){
            $errors += ["key" => "Key field is required."];
        }

        if($song->getYear() == null){
            $errors += ["year" => "Year field is required."];
        }

        if($song->getDuration() == null){
            $errors += ["duration" => "Duration field is required."];
        }

        if($song->getText() == null){
            $errors += ["text" => "Text field is required."];
        }

        if($song->getYear() <= 0){
            $errors += ["year" => "Year must be positive number."];
        }

        if($song->getYear() > 2022){
            $errors += ["year" => "Invalid year."];
        }

        $keyRegex = '/^[A-G]$|^[ACDFG][\#]$/i';
        if(!preg_match($keyRegex,$song->getKey())){
            $errors += ["key" => "Key is not valid."];
        }

        $durationRegex = '/^[0-5]?[0-9]\:[0-5][0-9]$/';
        if(!preg_match($durationRegex,$song->getDuration())){
            $errors += ["duration" => "Duration should be set in format mm:ss."];
        }

        if($song->getTempo() < 20 || $song->getTempo() > 300){
            $errors += ["tempo" => "Tempo must be between 20 and 300."];
        }

        $signatureRegex = '/^[2-4]\/[4]$|^[69]\/8$|^2\/2$|^12\/8$/';
        if(!preg_match($signatureRegex,$song->getSignature())){
            $errors += ["signature" => "Time signature must be one of 2/4, 3/4, 4/4, 2/2, 6/8, 9/8, 12/8."];
        }

        $ytlinkRegex='/^(https:\/\/www\.)?youtube.com\/watch\?v=/';
        if(!preg_match($ytlinkRegex,$song->getUrl())){
            $errors += ["ytlink" => "Should be provided valid link to a YouTube video."];
        }

        $newUrl = str_replace("watch?v=","embed/",$song->getUrl());
        $song->setUrl($newUrl);

        $textRegex ='/\[([^A-G]|[^ACDFG][\#]|[A-G][^\#\]][^m]*)\]/';
        if(preg_match($textRegex,$song->getText()) == 1){
            $errors += ["text" => "Lyrics are not valid."];
        }

        return $errors;
    }
}