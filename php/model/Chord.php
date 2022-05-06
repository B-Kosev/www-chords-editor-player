<?php

class Chord implements \JsonSerializable{
    private $id; // 'c' or 'cm' etc

    private $name; // C Minor

    private $first; // 1c
    private $third; // 1ds
    private $fifth; // 1g

    private $inversion;

    public function __construct(string $id, string $name, string $first, string $third, string $fifth, int $inversion){
        $this->id = $id;
        $this->name = $name;
        $this->first = $first;
        $this->third = $third;
        $this->fifth = $fifth;
        $this->inversion = $inversion;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getFirst(): string {
        return $this->first;
    }

    public function getThird(): string {
        return $this->third;
    }

    public function getFifth(): string {
        return $this->fifth;
    }

    public function getInversion(): int {
        return $this->inversion;
    }

    public static function createFromAssoc(array $assocChord): Chord {
        return new Chord($assocChord['id'], 
            $assocChord['name'], 
            $assocChord['first'], 
            $assocChord['third'],
            $assocChord['fifth'], 
            $assocChord['inversion']);
    }

    public function jsonSerialize(){
        return get_object_vars($this);
    }
}