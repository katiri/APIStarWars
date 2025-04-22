<?php
    require_once('models/Film.php');

    class FilmDAO implements FilmDAOInterface{
        private $api_url;

        public function __construct($api_url){
            $this->api_url = $api_url;
        }
        
        public function buildFilm($data){
            $film = new Film();

            $film->name = $data['name'];
            $film->episode_number = $data['episode_number'];
            $film->synopsis = $data['synopsis'];
            $film->release_date = $data['release_date'];
            $film->director = $data['director'];
            $film->producers = $data['producers'];
            $film->characters = $data['characters'];

            return $film;
        }

        public function list(){
            $films = [];

            $url = $this->api_url . 'films/'; 
            $response = $this->consultAPI($url);

            if(isset($response['output'])){
                if($response['http_code'] === 200){
                    $data = json_decode($response['output'], true);

                    foreach($data['results'] as $film){
                        $data_processed = [
                            'name' => $film['title'],
                            'episode_number' => $film['episode_id'],
                            'synopsis' => $film['opening_crawl'],
                            'release_date' => $film['release_date'],
                            'director' => $film['director'],
                            'producers' => $film['producer'],
                            'characters' => $film['characters']
                        ];
        
                        $films[] = $this->buildFilm($data_processed);
                    }

                    return [
                        'response' => $films
                    ];
                }
                else{
                    return [
                        'http_code' => $response['http_code'],
                        'error' => json_decode($response['output'], true)['detail']
                    ];
                }
            }
            else{
                return $response;
            }
        }

        public function findById($id){
            $url = $this->api_url . 'films/' . $id . '/'; 
            $response = $this->consultAPI($url);

            if(isset($response['output'])){
                if($response['http_code'] === 200){
                    $data = json_decode($response['output'], true);

                    $data = [
                        'name' => $data['title'],
                        'episode_number' => $data['episode_id'],
                        'synopsis' => $data['opening_crawl'],
                        'release_date' => $data['release_date'],
                        'director' => $data['director'],
                        'producers' => $data['producer'],
                        'characters' => $data['characters']
                    ];

                    $film = $this->buildFilm($data);

                    return [
                        'response' => $film
                    ];
                }
                else{
                    return [
                        'http_code' => $response['http_code'],
                        'error' => json_decode($response['output'], true)['detail']
                    ];
                }
            }
            else{
                return $response;
            }
        }

        public function consultAPI($url){
            $ch = curl_init();
            
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE'); // Linha usada para causar erro na API e testar mensagem de erro

            $output = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            $curl_errno = curl_errno($ch);
            $curl_error = curl_error($ch);

            curl_close($ch);

            if(!$curl_errno){
                return [
                    'http_code' => $http_code,
                    'output' => $output,
                ];
            }
            else{
                return [
                    'http_code' => $http_code,
                    'error' => $curl_error
                ];
            }
        }
    }