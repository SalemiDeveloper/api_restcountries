<?php

defined('CONTROL') or die('Acesso inv�lido.');

$api = new ApiConsumer();

$country1 = $_GET['country1'] ?? null;
$country2 = $_GET['country2'] ?? null;

if (!$country1 || !$country2) {
    header('Location: ?route=home');
    die();
}

$data1 = $api->get_country($country1);
$data2 = $api->get_country($country2);

$c1 = $data1[0];
$c2 = $data2[0];

// Barras comparativas
$pop1 = $c1['population'];
$pop2 = $c2['population'];

$most_populous = $api->get_most_populous();
$max_population = $most_populous['population'];
$largest_area = $api->get_largest_area();

$pop1_percent = ($c1['population'] / $max_population) * 100;
$pop2_percent = ($c2['population'] / $max_population) * 100;

$area1 = $c1['area'];
$area2 = $c2['area'];

$max_area = $largest_area['area'];

$area1_percent = ($c1['area'] / $max_area) * 100;
$area2_percent = ($c2['area'] / $max_area) * 100;

?>

<div class="container mt-5">
    <h3 class="text-center">Comparação de países</h3>
    <hr>
    <div class="row text-center">
        <div class="col-md-6">
            <h4><?= $c1['name']['common'] ?></h4>
            <div class="card bg-light p-3 mx-auto" style="width:120px;">
                <img src="<?= $c1['flags']['png'] ?>" class="img-fluid">
            </div>

        </div>
        <div class="col-md-6">
            <h4><?= $c2['name']['common'] ?></h4>
            <div class="card bg-light p-3 mx-auto" style="width:120px;">
                <img src="<?= $c2['flags']['png'] ?>" class="img-fluid">
            </div>

        </div>

    </div>

   <h5 class="mt-4">População</h5>

    <p><?= $c1['name']['common'] ?>(<?= number_format($c1['population'],0,',','.') ?>)</p>

    <div class="progress mb-3">
        <div class="progress-bar bg-primary"style="width: <?= $pop1_percent ?>%"></div>
    </div>

    <p><?= $c2['name']['common'] ?>(<?= number_format($c2['population'],0,',','.') ?>)</p>

    <div class="progress mb-2">
        <div class="progress-bar bg-success"style="width: <?= $pop2_percent ?>%"></div>
    </div>
    <p class="text-muted">Maior população do mundo: <?= $most_populous['name'].' com '.number_format($most_populous['population'],0,',','.')?> habitantes.</p>

    <h5>Território</h5>
    <p><?= $c1['name']['common'] ?> (<?= number_format($area1,0,',','.') ?> km²)</p>

    <div class="progress mb-3">
        <div class="progress-bar bg-info"style="width: <?= $area1_percent ?>%"></div>
    </div>

    <p><?= $c2['name']['common'] ?> (<?= number_format($area2,0,',','.') ?> km²)</p>

    <div class="progress mb-2">
        <div class="progress-bar bg-warning"style="width: <?= $area2_percent ?>%"></div>
    </div>
    <p class="text-muted">Maior território do mundo: <?= $largest_area['name'].' com '.number_format($largest_area['area'],0,',','.')?> km<sup>2</sup>.</p>
</div>

