<?php

class ChordService {

    public static function getChordById(string $chordId): array {

        $sql   = "SELECT * FROM `chords` WHERE id = :chord_id ORDER BY inversion";
        $selectStatement = (new Database())->getConnection()->prepare($sql);

        $selectStatement->execute(['chord_id' => $chordId]);

        // CAN BE REFACTORED - SEE SON SERVICE
        $chordDbRows = $selectStatement->fetchAll();

        if (!$chordDbRows) {
            throw new NotFoundException("Chord with id $chordId not found");
        }

        $chords = array();

        foreach ($chordDbRows as $chordDbRow){
            $chord = Chord::createFromAssoc($chordDbRow);
            $chords[] = $chord;
        }

        return $chords;
    }
}