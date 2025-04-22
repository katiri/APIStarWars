<?php
    class Film{
        public $id = null;
        public $url;
        public $name;
        public $episode_number;
        public $synopsis;
        public $release_date;
        public $director;
        public $producers;
        public $characters;
        public $film_age = null;

        public function getFilmID(){
            $film_url_explode = explode('/', rtrim($this->url, '/'));
            $id = end($film_url_explode);

            return $id;
        }

        public function getFilmAge(){
            $releaseDate = new DateTime($this->release_date);
            $today = new DateTime();
        
            $difference = $releaseDate->diff($today);
        
            return [
                'years' => $difference->y,
                'months' => $difference->m,
                'days' => $difference->d
            ];
        }

        public function getCharactersIDs(){
            $characters_ids = [];
            
            $characters = $this->characters;

            foreach($characters as $character){
                $character_url_explode = explode('/', rtrim($character, '/'));
                $id = end($character_url_explode);

                $characters_ids[] = $id;
            }

            return $characters_ids;
        }
    }

    interface FilmDAOInterface{
        public function buildFilm($data);
        public function list();
        public function findById($id);
        public function consultAPI($url);
    }