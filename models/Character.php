<?php
    class Character{
        public $url;
        public $name;

        public function getCharacterID(){
            $character_url_explode = explode('/', rtrim($this->url, '/'));
            $id = end($character_url_explode);

            return $id;
        }
    }

    interface CharacterDAOInterface{
        public function buildCharacter($data);
        public function list();
        public function consultAPI($url);
    }