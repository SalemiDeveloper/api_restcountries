<?php

require_once 'inc/api_consumer.php';

$api = new ApiConsumer();

var_dump($api->get_all_countries_name());