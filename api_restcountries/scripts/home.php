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
                    <div class="card country-card shadow-sm p-3 w-100 bg-light position-relative">
                        <h6>Maior população</h6>
                        <strong><?= $most_populous['name'] ?></strong>
                        <p><?= number_format($most_populous['population'],0,',','.') ?></p>

                        <img 
                        class="country-flag bg-secondary p-1 rounded"
                        src="<?= $most_populous['flag'] ?>" 
                        crossorigin="anonymous"
                        width="40">

                        <a href="?route=country&country_name=<?= urlencode($most_populous['name']) ?>" 
                        class="stretched-link"></a>
                    </div>
                </div>

                <div class="col-md-3 d-flex">
                    <div class="card country-card shadow-sm p-3 w-100 bg-light position-relative">
                        <h6>Menor população</h6>
                        <strong><?= $least_populous['name'] ?></strong>
                        <p><?= number_format($least_populous['population'],0,',','.') ?></p>

                        <img 
                        class="country-flag bg-secondary p-1 rounded"
                        src="<?= $least_populous['flag'] ?>" 
                        crossorigin="anonymous"
                        width="40">

                        <a href="?route=country&country_name=<?= urlencode($least_populous['name']) ?>" 
                        class="stretched-link"></a>
                    </div>
                </div>                

                <div class="col-md-3 d-flex">
                    <div class="card country-card shadow-sm p-3 w-100 bg-light position-relative">
                        <h6>Maior território</h6>
                        <strong><?= $largest_area['name'] ?></strong>
                        <p><?= number_format($largest_area['area'],0,',','.') ?></p>

                        <img 
                        class="country-flag bg-secondary p-1 rounded"
                        src="<?= $largest_area['flag'] ?>" 
                        crossorigin="anonymous"
                        width="40">

                        <a href="?route=country&country_name=<?= urlencode($largest_area['name']) ?>" 
                        class="stretched-link"></a>
                    </div>
                </div>

                <div class="col-md-3 d-flex">
                    <div class="card country-card shadow-sm p-3 w-100 bg-light position-relative">
                        <h6>Menor Território</h6>
                        <strong><?= $smallest_area['name'] ?></strong>
                        <p><?= number_format($smallest_area['area'],0,',','.') ?></p>

                        <img 
                        class="country-flag bg-secondary p-1 rounded"
                        src="<?= $smallest_area['flag'] ?>" 
                        crossorigin="anonymous"
                        width="40">

                        <a href="?route=country&country_name=<?= urlencode($smallest_area['name']) ?>" 
                        class="stretched-link"></a>
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




<script>

    document.addEventListener('DOMContentLoaded', () => {

        const select_country = document.querySelector("#select_country");
        select_country.addEventListener('change', () => {
            const country = select_country.value;
            window.location.href = `?route=country&country_name=`+country;
        })
    })


    document.addEventListener('DOMContentLoaded', () => {

        const compareBtn = document.querySelector("#compare_btn");

        compareBtn.addEventListener('click', () => {

            const country1 = document.querySelector("#country1").value;
            const country2 = document.querySelector("#country2").value;

            if (!country1 || !country2) {
                alert("Selecione dois países para comparar");
                return;
            }

            window.location.href =
                `?route=compare&country1=${country1}&country2=${country2}`;
        });

    });


document.addEventListener("DOMContentLoaded", function(){

    const colorThief = new ColorThief();

    const cards = document.querySelectorAll(".country-card");

    cards.forEach(card => {

        const img = card.querySelector(".country-flag");

        function aplicarCores(){

            const palette = colorThief.getPalette(img, 2);
            const c1 = `rgb(${palette[0][0]},${palette[0][1]},${palette[0][2]})`;
            const c2 = `rgb(${palette[1][0]},${palette[1][1]},${palette[1][2]})`;
            const gradient = `linear-gradient(45deg, ${c1}, ${c2})`;

            card.dataset.gradient = gradient;
            card.style.setProperty("--gradient", gradient);

        }

        if (img.complete) {
            aplicarCores();
        } else {
            img.addEventListener("load", aplicarCores);
        }

    });

});
</script>
