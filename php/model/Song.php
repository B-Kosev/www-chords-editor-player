<?php

class Song implements \JsonSerializable {
    private $id;
    private $title; 
    private $author;
    private $key; 
    private $year; 
    private $text;

    public function __construct(string $id, string $title, string $author, string $key, string $year, string $text){
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->key = $key;
        $this->year = $year;
        $this->text = $text;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getAuthor(): string {
        return $this->author;
    }

    public function getKey(): string {
        return $this->key;
    }

    public function getYear(): int {
        return $this->year;
    }

    public function getText(): string {
        return $this->text;
    }

    public static function createFromAssoc(array $assocSong): Song {
        return new Song($assocSong['id'], 
            $assocSong['title'], 
            $assocSong['author'], 
            $assocSong['key'],
            $assocSong['year'], 
            $assocSong['text']);
    }

    public function jsonSerialize(){
        return get_object_vars($this);
    }
}