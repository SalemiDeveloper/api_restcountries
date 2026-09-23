<?php

class ApiConsumer
{
    private const BASE_URL = 'https://api.restcountries.com/countries/v5';
    private const PAGE_LIMIT = 100;

    private function api($endpoint)
    {
        $apiKey = $_ENV['RESTCOUNTRIES_API_KEY'];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => self::BASE_URL . $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $apiKey,
                'Accept: application/json',
            ],
        ]);

        $response = curl_exec($curl);

        if ($response === false) {
            $error = curl_error($curl);

            curl_close($curl);

            throw new RuntimeException('cURL Error: ' . $error);
        }

        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        $data = json_decode($response, true);

        if ($httpCode >= 400) {
            $message = $data['errors'][0]['message']
                ?? 'Erro desconhecido na API REST Countries.';

            throw new RuntimeException(
                "REST Countries API ({$httpCode}): {$message}"
            );
        }

        return $data['data']['objects'] ?? [];
    }

    /**
     * Retorna todos os países da API.
     */
    private function get_all_countries()
    {
        $countries = [];
        $offset = 0;

        do {
            $results = $this->api(
                "?limit=" . self::PAGE_LIMIT . "&offset={$offset}"
            );

            $countries = array_merge($countries, $results);

            $count = count($results);

            $offset += $count;

        } while ($count === self::PAGE_LIMIT);

        return $countries;
    }

    // =========================================================================

    public function get_all_countries_name()
    {
        $countries = [];

        foreach ($this->get_all_countries() as $country) {
            $countries[] = $country['names']['common'];
        }

        sort($countries);

        return $countries;
    }

    // =========================================================================

    public function get_country($country_name)
    {
        $endpoint = '/names.common/' . rawurlencode($country_name);

        return $this->api($endpoint);
    }

    // =========================================================================

    public function get_neighbors($codes)
    {
        $neighbors = [];

        foreach (explode(',', $codes) as $code) {
            $code = trim($code);

            if ($code === '') {
                continue;
            }

            $results = $this->api(
                '/borders/' . rawurlencode($code)
            );

            $neighbors = array_merge($neighbors, $results);
        }

        return $neighbors;
    }

    // =========================================================================

    public function get_most_populous()
    {
        $most_populous = null;

        foreach ($this->get_all_countries() as $country) {
            if (
                $most_populous === null
                || $country['population'] > $most_populous['population']
            ) {
                $most_populous = [
                    'name' => $country['names']['common'],
                    'population' => $country['population'],
                    'flag' => $country['flag']['url_png'],
                    'colors' => $country['flag']['colors']['palette'] ?? [],
                ];
            }
        }

        return $most_populous;
    }

    // =========================================================================

    public function get_least_populous()
    {
        $least_populous = null;

        foreach ($this->get_all_countries() as $country) {
            if ($country['population'] <= 0) {
                continue;
            }

            if (
                $least_populous === null
                || $country['population'] < $least_populous['population']
            ) {
                $least_populous = [
                    'name' => $country['names']['common'],
                    'population' => $country['population'],
                    'flag' => $country['flag']['url_png'],
                    'colors' => $country['flag']['colors']['palette'] ?? [],
                ];
            }
        }

        return $least_populous;
    }

    // =========================================================================

    public function get_largest_area()
    {
        $largest = null;

        foreach ($this->get_all_countries() as $country) {
            $area = $country['area']['kilometers'];

            if (
                $largest === null
                || $area > $largest['area']
            ) {
                $largest = [
                    'name' => $country['names']['common'],
                    'area' => $area,
                    'flag' => $country['flag']['url_png'],
                    'colors' => $country['flag']['colors']['palette'] ?? [],
                ];
            }
        }

        return $largest;
    }

    // =========================================================================

    public function get_smallest_area()
    {
        $smallest = null;

        foreach ($this->get_all_countries() as $country) {
            $area = $country['area']['kilometers'];

            if (
                $smallest === null
                || $area < $smallest['area']
            ) {
                $smallest = [
                    'name' => $country['names']['common'],
                    'area' => $area,
                    'flag' => $country['flag']['url_png'],
                    'colors' => $country['flag']['colors']['palette'] ?? [],
                ];
            }
        }

        return $smallest;
    }
}