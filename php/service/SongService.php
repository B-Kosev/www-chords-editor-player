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
}