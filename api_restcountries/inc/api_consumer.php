<?php

class ApiConsumer {
    private function api($endpoint, $method = "GET", $post_fields = array()) {
        $curl = curl_init();

        curl_setopt_array($curl, array(

            CURLOPT_URL => "https://restcountries.com/v3.1/$endpoint",
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

    // Retornando todos os países (apenas nomes, em ordem alfabética).
    public function get_all_countries() {
        $results =  $this->api('all?fields=name');

        $countries = array();
        foreach($results as $result) {
            $countries[] = $result['name']['common'];
        }

        sort($countries); // Ordenando em ordem alfabética.
        return $countries;
    }

    public function get_country($country_name) {

        // Retornando um país específico
        return $this->api("name/$country_name");
    }
}
