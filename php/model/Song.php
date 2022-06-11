<?php

class Song implements \JsonSerializable {
    private $id;
    private $title; 
    private $author;
    private $key; 
    private $year;
    private $duration;
    private $tempo;
    private $signature;
    private $url; 
    private $text;

    public function __construct(int $id, string $title, string $author, string $key, int $year, string $duration, 
    int $tempo, string $signature, string $url, string $text) {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->key = $key;
        $this->year = $year;
        $this->duration = $duration;
        $this->tempo = $tempo;
        $this->signature = $signature;
        $this->url = $url;
        $this->text = $text;
    }

    public function setUrl($newUrl): void {
        $this->url = $newUrl;
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

    public function getDuration(): string {
        return $this->duration;
    }

    public function getTempo(): int {
        return $this->tempo;
    }

    public function getSignature(): string {
        return $this->signature;
    }

    public function getUrl(): string {
        return $this->url;
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
            $assocSong['duration'], 
            $assocSong['tempo'], 
            $assocSong['signature'], 
            $assocSong['url'], 
            $assocSong['text']);
    }

    public function jsonSerialize(){
        return get_object_vars($this);
    }
}