<?php
defined('CONTROL') or die('Acesso inválido.');

$api = new ApiConsumer();

// Pegando todos os pa�ses
$countries = $api->get_all_countries();

// Pegando um pa�s espec�fico
//$country = $api->get_country('brazil');
?>

<html lang="pt-br">
<div class="container mt-5">

    <div class="row">
        <div class="col text-center">
            <h3>Países do mundo.</h3>
            <hr>

        </div>
    </div>

    <div class="row justify-content-center">

        <div class="col-4">
            <p>Lista de países</p>

            <select id="select_country" class="form-select">
                <option value="">Selecione um país</option>
                <?php foreach ($countries as $country): ?>
                    <option value="<?= htmlspecialchars($country) ?>">
                        <?= htmlspecialchars($country) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            
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
