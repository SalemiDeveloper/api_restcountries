<?php
defined('CONTROL') or die('Acesso invÃ¡lido.');

$api = new ApiConsumer();

// Pegando todos os países
$countries = $api->get_all_contries();

// Pegando um país específico
$country = $api->get_country('brazil');
?>

<!-- <div class="container mt-5">
    <div class="row">
        <div class="col text-center">
            <h3>Vamos consumir uma API com PHP puro.</h3>
        </div>
    </div>
</div> -->

<pre>
    <?php print_r($countries) ?>
    <?php print_r($country) ?>
</pre>