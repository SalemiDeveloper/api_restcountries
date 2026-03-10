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
                    <div class="card shadow-sm p-3 w-100 bg-light">
                        <h6>Maior população</h6>
                        <strong><?= $most_populous['name'] ?></strong>
                        <p><?= number_format($most_populous['population'],0,',','.') ?></p>
                        <img src="<?= $most_populous['flag'] ?>" width="40" class="bg-secondary p-1 rounded">
                    </div>
                </div>

                <div class="col-md-3 d-flex">
                    <div class="card shadow-sm p-3 w-100 bg-light">
                        <h6>Menor população</h6>
                        <strong><?= $least_populous['name'] ?></strong>
                        <p><?= number_format($least_populous['population'],0,',','.') ?></p>
                        <img src="<?= $least_populous['flag'] ?>" width="40" class="bg-secondary p-1 rounded">
                    </div>
                </div>

                <div class="col-md-3 d-flex">
                    <div class="card shadow-sm p-3 w-100 bg-light">
                        <h6>Maior território</h6>
                        <strong><?= $largest_area['name'] ?></strong>
                        <p><?= number_format($largest_area['area'],0,',','.') ?> km²</p>
                        <img src="<?= $largest_area['flag'] ?>" width="40" class="bg-secondary p-1 rounded">
                    </div>
                </div>

                <div class="col-md-3 d-flex">
                    <div class="card shadow-sm p-3 w-100 bg-light">
                        <h6>Menor território</h6>
                        <strong><?= $smallest_area['name'] ?></strong>
                        <p><?= number_format($smallest_area['area'],2,',','.') ?> km²</p>
                        <img src="<?= $smallest_area['flag'] ?>" width="40" class="bg-secondary p-1 rounded">
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<script>

    document.addEventListener('DOMContentLoaded', () => {

        const select_country = document.querySelector("#select_country");
        select_country.addEventListener('change', () => {
            const country = select_country.value;
            console.log(country);
            window.location.href = `?route=country&country_name=`+country;
        })
    })
</script>
