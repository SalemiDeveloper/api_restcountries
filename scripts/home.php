<?php
defined('CONTROL') or die('Acesso inválido.');

$api = new ApiConsumer();

// Pegando todos os pa�ses
$countries_name = $api->get_all_countries_name();
$most_populous  = $api->get_most_populous();
$least_populous = $api->get_least_populous();
$largest_area   = $api->get_largest_area();
$smallest_area  = $api->get_smallest_area();
?>

<html lang="pt-br">
<div class="container mt-5">

    <div class="row">
        <div class="col text-center">
            <h3>Países do mundo</h3>
            <hr>

        </div>
    </div>

    <div class="row justify-content-center">

        <div class="col-4">
            <p>Lista de países</p>

            <select id="select_country" class="form-select">
                <option value="">Selecione um país</option>
                <?php foreach ($countries_name as $country): ?>
                    <option value="<?= htmlspecialchars($country) ?>">
                        <?= htmlspecialchars($country) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            
        </div>

    </div>

    <div class="row mt-5">
        <div class="col-md-10 mx-auto">

            <h4 class="text-center">Estatísticas Globais</h4>
            <hr>

            <div class="row text-left">

                <div class="col-md-3 d-flex">
                    <div
                        class="card home-card shadow-sm p-3 w-100 bg-light position-relative"
                        data-color-1="<?= htmlspecialchars($most_populous['colors'][0]['hex'] ?? '#cccccc') ?>"
                        data-color-2="<?= htmlspecialchars($most_populous['colors'][1]['hex'] ?? '#999999') ?>"
                    >
                        <h6>Maior população</h6>

                        <strong><?= htmlspecialchars($most_populous['name']) ?></strong>

                        <p>
                            <?= number_format($most_populous['population'], 0, ',', '.') ?>
                            habitantes
                        </p>

                        <img
                            class="country-flag bg-secondary p-1 rounded"
                            src="<?= htmlspecialchars($most_populous['flag']) ?>"
                            width="40"
                        >

                        <a
                            href="?route=country&country_name=<?= urlencode($most_populous['name']) ?>"
                            class="stretched-link"
                        ></a>
                    </div>
                </div>

                <div class="col-md-3 d-flex">
                    <div
                        class="card home-card shadow-sm p-3 w-100 bg-light position-relative"
                        data-color-1="<?= htmlspecialchars($least_populous['colors'][0]['hex'] ?? '#cccccc') ?>"
                        data-color-2="<?= htmlspecialchars($least_populous['colors'][1]['hex'] ?? '#999999') ?>"
                    >
                        <h6>Menor população</h6>

                        <strong><?= htmlspecialchars($least_populous['name']) ?></strong>

                        <p>
                            <?= number_format($least_populous['population'], 0, ',', '.') ?>
                            habitantes
                        </p>

                        <img
                            class="country-flag bg-secondary p-1 rounded"
                            src="<?= htmlspecialchars($least_populous['flag']) ?>"
                            width="40"
                        >

                        <a
                            href="?route=country&country_name=<?= urlencode($least_populous['name']) ?>"
                            class="stretched-link"
                        ></a>
                    </div>
                </div>            

                <div class="col-md-3 d-flex">
                    <div
                        class="card home-card shadow-sm p-3 w-100 bg-light position-relative"
                        data-color-1="<?= htmlspecialchars($largest_area['colors'][0]['hex'] ?? '#cccccc') ?>"
                        data-color-2="<?= htmlspecialchars($largest_area['colors'][1]['hex'] ?? '#999999') ?>"
                    >
                        <h6>Maior território</h6>

                        <strong><?= htmlspecialchars($largest_area['name']) ?></strong>

                        <p>
                            <?= number_format($largest_area['area'], 0, ',', '.') ?>
                            km<sup>2</sup>
                        </p>

                        <img
                            class="country-flag bg-secondary p-1 rounded"
                            src="<?= htmlspecialchars($largest_area['flag']) ?>"
                            width="40"
                        >

                        <a
                            href="?route=country&country_name=<?= urlencode($largest_area['name']) ?>"
                            class="stretched-link"
                        ></a>
                    </div>
                </div>

                <div class="col-md-3 d-flex">
                    <div
                        class="card home-card shadow-sm p-3 w-100 bg-light position-relative"
                        data-color-1="<?= htmlspecialchars($smallest_area['colors'][0]['hex'] ?? '#cccccc') ?>"
                        data-color-2="<?= htmlspecialchars($smallest_area['colors'][1]['hex'] ?? '#999999') ?>"
                    >
                        <h6>Menor Território</h6>

                        <strong><?= htmlspecialchars($smallest_area['name']) ?></strong>

                        <p>
                            <?= number_format($smallest_area['area'], 2, ',', '.') ?>
                            km<sup>2</sup>
                        </p>

                        <img
                            class="country-flag bg-secondary p-1 rounded"
                            src="<?= htmlspecialchars($smallest_area['flag']) ?>"
                            width="40"
                        >

                        <a
                            href="?route=country&country_name=<?= urlencode($smallest_area['name']) ?>"
                            class="stretched-link"
                        ></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 justify-content-center">

        <h4 class="col-md-3 text-center">Compare os Países</h4>
        <hr>
        <div class="col-md-3">
            <select id="country1" class="form-select">
                <option value="">País 1</option>
                <?php foreach ($countries_name as $country): ?>
                    <option value="<?= htmlspecialchars($country) ?>">
                        <?= htmlspecialchars($country) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-3">
            <select id="country2" class="form-select">
                <option value="">País 2</option>
                <?php foreach ($countries_name as $country): ?>
                    <option value="<?= htmlspecialchars($country) ?>">
                        <?= htmlspecialchars($country) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-2">
            <button id="compare_btn" class="btn btn-primary w-100">
                Comparar
            </button>
        </div>
    </div>
</div>


