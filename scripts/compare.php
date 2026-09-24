<?php

defined('CONTROL') or die('Acesso inválido.');

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

// ---------------------------------------------------------
// Dados básicos
// ---------------------------------------------------------

$name1 = $c1['names']['common'];
$name2 = $c2['names']['common'];

$pop1 = number_format($c1['population'], 0, ',', '.');
$pop2 = number_format($c2['population'], 0, ',', '.');

// ---------------------------------------------------------
// Cores das bandeiras
// ---------------------------------------------------------

$palette1 = $c1['flag']['colors']['palette'] ?? [];
$palette2 = $c2['flag']['colors']['palette'] ?? [];

$color1_1 = $palette1[0]['hex'] ?? '#cccccc';
$color1_2 = $palette1[1]['hex'] ?? '#999999';

$color2_1 = $palette2[0]['hex'] ?? '#cccccc';
$color2_2 = $palette2[1]['hex'] ?? '#999999';

// ---------------------------------------------------------
// População
// ---------------------------------------------------------

$most_populous = $api->get_most_populous();

$max_population = $most_populous['population'];

$pop1_percent = ($c1['population'] / $max_population) * 100;
$pop2_percent = ($c2['population'] / $max_population) * 100;

// ---------------------------------------------------------
// Área
// ---------------------------------------------------------

$area1_value = $c1['area']['kilometers'];
$area2_value = $c2['area']['kilometers'];

$area1 = number_format($area1_value, 0, ',', '.');
$area2 = number_format($area2_value, 0, ',', '.');

$largest_area = $api->get_largest_area();
$max_area = $largest_area['area'];

$area1_percent = ($area1_value / $max_area) * 100;
$area2_percent = ($area2_value / $max_area) * 100;

// ---------------------------------------------------------
// Comparação de população
// ---------------------------------------------------------

$dif_pop = abs($c1['population'] - $c2['population']);

if ($c1['population'] == $c2['population']) {

    $compare_pop =
        "$name1 e $name2 têm a mesma população.";

} else {

    $maior = $c1['population'] > $c2['population'] ? $name1 : $name2;
    $menor = $c1['population'] > $c2['population'] ? $name2 : $name1;

    $compare_pop = "$maior tem <strong>" . number_format($dif_pop, 0, ',', '.') . "</strong> habitantes a mais que $menor.";
}

// ---------------------------------------------------------
// Comparação de área
// ---------------------------------------------------------

$dif_area = abs($area1_value - $area2_value);

if ($area1_value == $area2_value) {

    $compare_area = "$name1 e $name2 têm a mesma medida de território.";

} else {

    $maior = $area1_value > $area2_value ? $name1 : $name2;
    $menor = $area1_value > $area2_value ? $name2 : $name1;

    $compare_area = "$maior tem <strong>" . number_format($dif_area, 0, ',', '.') . "</strong> km<sup>2</sup> a mais em território que $menor.";
}

?>

<div class="container mt-5">

    <div class="mb-4">
        <a
            href="?route=home"
            class="btn btn-primary px-5"
        >
            Início
        </a>
    </div>

    <h3 class="text-center">
        Comparação de países
    </h3>

    <hr>

    <!-- Países -->
    <div class="row text-center">

        <!-- País 1 -->
        <div class="col-md-6">

            <h4>
                <?= htmlspecialchars($name1) ?>
            </h4>

            <div
                class="card compare-card p-2 shadow bg-light mx-auto"
                style="width:120px;"
                data-color-1="<?= htmlspecialchars($color1_1) ?>"
                data-color-2="<?= htmlspecialchars($color1_2) ?>"
            >

                <img
                    src="<?= htmlspecialchars($c1['flag']['url_png']) ?>"
                    alt="Bandeira de <?= htmlspecialchars($name1) ?>"
                >

                <a
                    href="?route=country&country_name=<?= urlencode($name1) ?>"
                    class="stretched-link"
                ></a>

            </div>

        </div>

        <!-- País 2 -->
        <div class="col-md-6">

            <h4>
                <?= htmlspecialchars($name2) ?>
            </h4>

            <div
                class="card compare-card p-2 shadow bg-light mx-auto"
                style="width:120px;"
                data-color-1="<?= htmlspecialchars($color2_1) ?>"
                data-color-2="<?= htmlspecialchars($color2_2) ?>"
            >

                <img
                    src="<?= htmlspecialchars($c2['flag']['url_png']) ?>"
                    alt="Bandeira de <?= htmlspecialchars($name2) ?>"
                >

                <a
                    href="?route=country&country_name=<?= urlencode($name2) ?>"
                    class="stretched-link"
                ></a>

            </div>

        </div>

    </div>

    <!-- População -->

    <h5 class="mt-4">
        População
    </h5>

    <p>
        <?= htmlspecialchars($name1) ?>
        (<?= $pop1 ?>)
    </p>

    <div class="progress mb-3">

        <div
            class="progress-bar bg-primary"
            style="width: <?= $pop1_percent ?>%"
        ></div>

    </div>

    <p>
        <?= htmlspecialchars($name2) ?>
        (<?= $pop2 ?>)
    </p>

    <div class="progress mb-2">

        <div
            class="progress-bar bg-success"
            style="width: <?= $pop2_percent ?>%"
        ></div>

    </div>

    <p>
        <?= $compare_pop ?>
    </p>

    <p class="text-muted">
        Maior população do mundo:
        <?= htmlspecialchars($most_populous['name']) ?>
        com
        <?= number_format($most_populous['population'], 0, ',', '.') ?>
        habitantes.
    </p>

    <!-- Território -->

    <h5>Território</h5>
    <p><?= htmlspecialchars($name1) ?>(<?= $area1 ?> km²)</p>

    <div class="progress mb-3">

        <div
            class="progress-bar bg-info"
            style="width: <?= $area1_percent ?>%"
        ></div>

    </div>

    <p><?= htmlspecialchars($name2) ?>(<?= $area2 ?> km²)</p>

    <div class="progress mb-2">

        <div
            class="progress-bar bg-warning"
            style="width: <?= $area2_percent ?>%"
        ></div>

    </div>

    <p><?= $compare_area ?></p>

    <p class="text-muted">
        Maior território do mundo:
        <?= htmlspecialchars($largest_area['name']) ?>
        com
        <?= number_format($largest_area['area'], 0, ',', '.') ?>
        km<sup>2</sup>.
    </p>

</div>