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

$flags       = $country_data[0]['flags']['png'];
$name_common = $country_data[0]['name']['common'];
$capital     = $country_data[0]['capital'][0];
$population  = number_format($country_data[0]['population'], 0, ',', '.');
$currency    = array_values($country_data[0]['currencies'])[0];
$region      = $country_data[0]['region'];
$area        = number_format($country_data[0]['area'], 0, ',', '.');
$lat         = $country_data[0]['latlng'][0];
$lng         = $country_data[0]['latlng'][1];
$cca3        = $country_data[0]['cca3'];
$borders     = $country_data[0]['borders'] ?? [];

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
        <div class="card p-2 shadow">
            <img src="<?php echo $flags ?>" alt="">
        </div>

        <div class="ms-5 allign-self-center">
            <h3>Nome do país</h3>
            <p class="display-3"><?php echo $name_common ?></p>
            <h3>Capital:</h3>
            <p><?php echo $capital ?></p>
        </div>

    </div>

    <div class="row mt-3">
        <div class="col">
            <p><strong>População:</strong> <?php echo $population ?></p>
            <p><strong>Região:</strong> <?php echo $region ?></p>
        </div>
        <div class="col">
            <p><strong>Área:</strong> <?php echo $area ?> km<sup>2</sup></p>            
            <p><strong>Moeda:</strong> <?php echo $currency['symbol'] ?> - <?php echo $currency['name'] ?></p>

        </div>
    </div>

    <div class="row my-4">
        <div class="col-md-8 mx-auto">
            <h4>Localização no mapa</h4>
            <div id="map" style="height:350px; border-radius:10px;"></div>
        </div>
    </div>

    <div class="mt-4">
    <h4>Países vizinhos</h4>

    <?php if (!empty($neighbors)): ?>
        <?php foreach ($neighbors as $neighbor): ?>

    <a class="btn btn-outline-primary btn-sm me-2 mb-2"
    href="?route=country&country_name=<?php echo $neighbor['name']['common'] ?>">
    <?php echo $neighbor['name']['common'] ?>
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

