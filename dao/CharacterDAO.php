<?php
    require_once('models/Character.php');

    class CharacterDAO implements CharacterDAOInterface{
        private $api_url;

        public function __construct($api_url){
            $this->api_url = $api_url;
        }

        public function buildCharacter($data){
            $character = new Character();

            $character->url = $data['url'];
            $character->name = $data['name'];

            return $character;
        }

        public function list(){
            $characters = [];

            $url = $this->api_url . 'people/'; 
            $response = $this->consultAPI($url);

            if(isset($response['output'])){
                if($response['http_code'] === 200){
                    $data = json_decode($response['output'], true);

                    foreach($data['results'] as $character){
                        $data_processed = [
                            'url' => $character['url'],
                            'name' => $character['name'],
                        ];
        
                        $characters[] = $this->buildCharacter($data_processed);
                    }
                    
                    return [
                        'response' => $characters
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