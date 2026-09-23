<?php

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once __DIR__ . '/inc/api_consumer.php';

$api = new ApiConsumer();

var_dump($api->get_all_countries_name());