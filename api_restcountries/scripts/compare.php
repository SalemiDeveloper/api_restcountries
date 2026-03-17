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
$pop1  = number_format($c1['population'],0,',','.');
$pop2  = number_format($c2['population'],0,',','.');
$name1 = $c1['name']['common'];
$name2 = $c2['name']['common'];
$most_populous  = $api->get_most_populous();
$max_population = $most_populous['population'];
$largest_area   = $api->get_largest_area();
$pop1_percent   = ($c1['population'] / $max_population) * 100;
$pop2_percent   = ($c2['population'] / $max_population) * 100;
$area1  = number_format($c1['area'],0,',','.');
$area2  = number_format($c2['area'],0,',','.');

$max_area = $largest_area['area'];

$area1_percent = ($c1['area'] / $max_area) * 100;
$area2_percent = ($c2['area'] / $max_area) * 100;

// Comparação de população
$dif = abs($c1['population'] - $c2['population']);

if ($c1['population'] == $c2['population']) {
    $compare = "$name1 e $name2 têm a mesma população";
} else {
    $maior = $c1['population'] > $c2['population'] ? $name1 : $name2;
    $menor = $c1['population'] > $c2['population'] ? $name2 : $name1;

    $compare = "$maior tem <strong>".number_format($dif,0,',','.')."</strong> habitantes a mais que $menor";
}
?>

<div class="container mt-5">
    <div class="mb-4">
        <a href="?route=home" class="btn btn-primary px-5">Início</a>
    </div>
    <h3 class="text-center">Comparação de países</h3>
    <hr>
    <div class="row text-center">
        <div class="col-md-6">
            <h4><?= $c1['name']['common'] ?></h4>

            <div class="card compare-card p-2 shadow bg-light mx-auto" style="width:120px;";>
                <img src="<?= $c1['flags']['png'] ?>" crossorigin="anonymous">
                <a href="?route=country&country_name=<?= urlencode($name1) ?>" 
                class="stretched-link"></a>
            </div>

        </div>
        <div class="col-md-6">
            <h4><?= $c2['name']['common'] ?></h4>
            <div class="card compare-card p-2 shadow bg-light mx-auto" style="width:120px;";>
                <img src="<?= $c2['flags']['png'] ?>" crossorigin="anonymous">
                <a href="?route=country&country_name=<?= urlencode($name2) ?>" 
                class="stretched-link"></a>
            </div>

        </div>

    </div>

   <h5 class="mt-4">População</h5>

    <p><?= $c1['name']['common'] ?>(<?= $pop1 ?>)</p>
    <div class="progress mb-3">
        <div class="progress-bar bg-primary"style="width: <?= $pop1_percent ?>%"></div>
    </div>
    <p><?= $c2['name']['common'] ?>(<?= $pop2 ?>)</p>
    <div class="progress mb-2">
        <div class="progress-bar bg-success"style="width: <?= $pop2_percent ?>%"></div>
    </div>

    <p><?= $compare ?></p>
    <p class="text-muted">Maior população do mundo: <?= $most_populous['name'].' com '.number_format($most_populous['population'],0,',','.')?> habitantes.</p>

    <h5>Território</h5>
    <p><?= $c1['name']['common'] ?> (<?= $area1 ?> km²)</p>
    <div class="progress mb-3">
        <div class="progress-bar bg-info"style="width: <?= $area1_percent ?>%"></div>
    </div>

    <p><?= $c2['name']['common'] ?> (<?= $area2 ?> km²)</p>
    <div class="progress mb-2">
        <div class="progress-bar bg-warning"style="width: <?= $area2_percent ?>%"></div>
    </div>
    <p class="text-muted">Maior território do mundo: <?= $largest_area['name'].' com '.number_format($largest_area['area'],0,',','.')?> km<sup>2</sup>.</p>
</div>

