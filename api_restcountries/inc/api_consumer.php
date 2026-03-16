<?php

class ApiConsumer {
    private function api($endpoint, $method = "GET", $post_fields = array()) {
        $curl = curl_init();

        //print_r($endpoint);

        curl_setopt_array($curl, array(

            CURLOPT_URL => "https://restcountries.com/v3.1/".$endpoint,
            CURLOPT_RETURNTRANSFER => true,
            //CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => [
                "Accept: */*"
            ],
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
            die(0);
        } else {
            return json_decode($response, true);
        }
    }

//===========================================================================
    public function get_all_countries_name() {
        // Retornando todos os países (apenas nomes, em ordem alfabética).
        $results =  $this->api('all?fields=name');

        $countries = array();
        foreach($results as $result) {
            $countries[] = $result['name']['common'];
        }

        sort($countries); // Ordenando em ordem alfabética.
        return $countries;
    }
    
//===========================================================================
    public function get_country($country_name) {
        // Retornando um país específico
        return $this->api("name/" . rawurlencode($country_name) . "?fullText=true");
    }

//===========================================================================
    public function get_neighbors($codes) {
        // Retornando os países que fazem fronteira
        return $this->api("alpha?codes=" . $codes);
    }

//===========================================================================
    public function get_most_populous() {
        $most_populous = null;
        $teste = array();
        $countries = $this->api('all?fields=name,population,flags');

        foreach ($countries as $country) {
            $teste[] = $country['population'];

            if ($most_populous == null || $country['population'] > $most_populous['population']) {

                $most_populous = [
                    'name' => $country['name']['common'],
                    'population' => $country['population'],
                    'flag' => $country['flags']['png']
                ];
            }
        }
        // Retornando o país mais populoso
        return $most_populous;
    }

//===========================================================================
    public function get_least_populous() {
        $least_populous = null;
        $countries = $this->api('all?fields=name,population,flags');

        foreach ($countries as $country) {

            if ($least_populous == null || $country['population'] < $least_populous['population'] && $country['population'] != 0) {

                $least_populous = [
                    'name' => $country['name']['common'],
                    'population' => $country['population'],
                    'flag' => $country['flags']['png']
                ];
            }
        }
        // Retornando o país menos populoso
        return $least_populous;
    }

//===========================================================================
    public function get_largest_area() {
        $largest = null;
        $countries = $this->api('all?fields=name,area,flags');

        foreach($countries as $country) {
            if ($largest == null || $country['area'] > $largest['area']) {

                $largest = [
                    'name' => $country['name']['common'],
                    'area' => $country['area'],
                    'flag' => $country['flags']['png']
                ];
            }
        }
        return $largest;
    }

//===========================================================================
    public function get_smallest_area() {
        $smallest = null;
        $countries = $this->api('all?fields=name,area,flags');

        foreach($countries as $country) {
            if ($smallest == null || $country['area'] < $smallest['area']) {

                $smallest = [
                    'name' => $country['name']['common'],
                    'area' => $country['area'],
                    'flag' => $country['flags']['png']
                ];
            }
        }
        return $smallest;
    }
}
