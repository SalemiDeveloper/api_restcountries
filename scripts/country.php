<?php
defined('CONTROL') or die('Acesso inv�lido.');

$api = new ApiConsumer();
$country = $_GET['country_name'] ?? null;

if (!$country) {
    header('Location: ?route=home');
    die();
}

// Pegando os dados do p�is
$country_data = $api->get_country($country);

$country_info = $country_data[0];

$flags = $country_info['flag']['url_png'];
$palette = $country_info['flag']['colors']['palette'] ?? [];
$color1 = $palette[0]['hex'] ?? '#cccccc';
$color2 = $palette[1]['hex'] ?? '#999999';

$name_common = $country_info['names']['common'];
$capital     = $country_info['capitals'][0]['name'] ?? 'Não informado';
$population  = number_format($country_info['population'], 0, ',', '.');
$currency    = $country_info['currencies'][0] ?? null;
$region      = $country_info['region'];
$area        = number_format($country_info['area']['kilometers'], 0, ',', '.');
$lat         = $country_info['coordinates']['lat'];
$lng         = $country_info['coordinates']['lng'];
$cca3        = $country_info['codes']['alpha_3'];
$borders     = $country_info['borders'] ?? [];

$languages = [];

foreach ($country_info['languages'] as $language) {
    $languages[] = $language['name'];
}

if (!empty($borders)) {
    $codes = implode(',', $borders);
    $neighbors = $api->get_neighbors($codes);
}
?>

<div class="container mt-5">
    <div class="mb-4">
        <a href="?route=home" class="btn btn-primary px-5">Início</a>
    </div>
    
    <div class="d-flex">
        <div
            class="card country-card p-2 shadow bg-light"
            data-color-1="<?= htmlspecialchars($color1) ?>"
            data-color-2="<?= htmlspecialchars($color2) ?>"
        >
            <img src="<?= htmlspecialchars($flags) ?>">
        </div>

        <div class="ms-5 allign-self-center">
            <h3>Nome do país</h3>
            <p class="display-3"><?php echo $name_common ?></p>
            <p><strong>Capital: </strong><?php echo $capital ?></p>
        </div>

    </div>

    <div class="row mt-3">
        <div class="col">
            <p><strong>População:</strong> <?php echo $population ?></p>
            <p><strong>Região:</strong> <?php echo $region ?></p>
            <p><strong>Idiomas: </strong>
                <?php echo implode(', ', $languages) ?>
            </p>
        </div>
        <div class="col">
            <p><strong>Área:</strong> <?php echo $area ?> km<sup>2</sup></p>            
            <p><strong>Moeda:</strong><?= $currency? $currency['symbol'] . ' - ' . $currency['name']: 'Não informado'?></p>

        </div>
    </div>

    <div class="row my-4">
        <div class="col-md-8 mx-auto">
            <h4>Localização no mapa</h4>
            <div id="map" style="height:300px; border-radius:10px;"></div>
        </div>
    </div>

    <div class="mt-4">
    <h4>Países vizinhos</h4>

    <?php if (!empty($neighbors)): ?>
        <?php foreach ($neighbors as $neighbor): ?>

    <a class="btn btn-outline-primary btn-sm me-2 mb-2"
    href="?route=country&country_name=<?= urlencode($neighbor['names']['common']) ?>">
    <?= htmlspecialchars($neighbor['names']['common']) ?>
    </a>

    <?php endforeach; ?>

    <?php else: ?>

    <p>Este país não possui fronteiras terrestres.</p>

    <?php endif; ?>

    </div>



</div>



<script>

var map = L.map('map').setView([<?php echo $lat ?>, <?php echo $lng ?>], 4);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap'
}).addTo(map);

L.marker([<?php echo $lat ?>, <?php echo $lng ?>])
    .addTo(map)
    .bindPopup('<?php echo $name_common ?>')
    .openPopup();


const countryCode = "<?php echo $cca3 ?>";

fetch(`https://raw.githubusercontent.com/johan/world.geo.json/master/countries/${countryCode}.geo.json`)
  .then(response => response.json())
  .then(data => {

    const geoLayer = L.geoJSON(data, {
        style: {
            color: "#ff0000",
            weight: 2,
            fillOpacity: 0.2
        }
    }).addTo(map);

    map.fitBounds(geoLayer.getBounds());

  });
</script>

