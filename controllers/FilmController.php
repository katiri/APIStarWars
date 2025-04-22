<?php
    require_once('dao/FilmDAO.php');
    require_once('dao/CharacterDAO.php');
    require_once('dao/LogDAO.php');
    require_once('dao/ApiErrorDAO.php');

    class FilmController{
        private $conn;
        private $url;
        private $api_url;
        private $filmDao;
        private $characterDao;
        private $logDao;
        private $apiErrorDao;

        public function __construct(PDO $conn, $url, $api_url){
            $this->conn = $conn;
            $this->url = $url;
            $this->api_url = $api_url;

            $this->filmDao = new FilmDAO($api_url);
            $this->characterDao = new CharacterDAO($api_url);
            $this->logDao = new LogDAO($conn);
            $this->apiErrorDao = new ApiErrorDAO($conn);
        }

        public function list(){
            $now = new DateTime();
            $requisition = 'GET films/';

            $list_films = $this->filmDao->list();
            $this->logDao->create($requisition);

            if(!isset($list_films['error'])){
                $http_code = 200;
                $list_films = $list_films['response'];

                foreach($list_films as $film){
                    $film->film_age = $film->getFilmAge();
                }
            }
            else{
                $error = new ApiError();
                $error->date_time = $now->format('Y-m-d H:i:s');
                $error->requisition = $requisition;
                $error->http_code = $list_films['http_code'];
                $error->message = $list_films['error'];

                $this->apiErrorDao->create($error);

                $http_code = $list_films['http_code'] === 0 ? 502 : $list_films['http_code'];
                $list_films = [
                    'error' => $list_films['error']
                ];
            }

            $data = [
                'BASE_URL' => $this->url,
                'list_films' => $list_films,
                'http_code' => $http_code
            ];

            $this->render('film_list', $data);
        }

        public function detail($id){
            $now = new DateTime();
            $requisition = 'GET films/' . $id . '/';

            $film = $this->filmDao->findById($id);
            $this->logDao->create($requisition);

            if(!isset($film['error'])){
                $http_code = 200;

                $film = $film['response'];

                $film->film_age = $film->getFilmAge();

                $characters = $this->characterDao->list();
                $this->logDao->create('GET people/');

                if(!isset($characters['error'])){
                    $characters = $characters['response'];
                    
                    $characters_names = [];

                    $characters_ids = $film->getCharactersIDs();

                    foreach($characters as $character){
                        if(in_array($character->getCharacterID(), $characters_ids)){
                            $characters_names[] = $character->name;
                        }
                    }
    
                    $film->characters = $characters_names;
                }
                else{
                    $error = new ApiError();
                    $error->date_time = $now->format('Y-m-d H:i:s');
                    $error->requisition = $requisition;
                    $error->http_code = $characters['http_code'];
                    $error->message = $characters['error'];

                    $this->apiErrorDao->create($error);

                    $characters['http_code'] = $characters['http_code'] === 0 ? 502 : $characters['http_code'];

                    $film->characters = $characters;
                }
            }
            else{
                $error = new ApiError();
                $error->date_time = $now->format('Y-m-d H:i:s');
                $error->requisition = $requisition;
                $error->http_code = $film['http_code'];
                $error->message = $film['error'];

                $this->apiErrorDao->create($error);

                $http_code = $film['http_code'] === 0 ? 502 : $film['http_code'];
                $film = [
                    'error' => $film['error']
                ];
            }

            $data = [
                'BASE_URL' => $this->url,
                'film' => $film,
                'http_code' => $http_code ? $http_code : false
            ];

            $this->render('film_detail', $data);
        }

        private function render($view, $data = []) {
            extract($data);
            require __DIR__ . "/../views/{$view}.php";
        }
    }