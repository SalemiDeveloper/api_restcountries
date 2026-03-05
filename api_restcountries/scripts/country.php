<?php
defined('CONTROL') or die('Acesso inválido.');

$api = new ApiConsumer();
$country = $_GET['contry_name'] ?? null;

if (!$country) {
    header('Location: ?route=home');
    die();
}

// Pegando os dados do páis
$country_data = $api->get_country($country);
?>

<div class="contianer mt-5">
    <div class="d-flex">
        <div class="card p-2 shadows">
            <img src="<?php echo $country_data[0]['flags']['png'] ?>" alt="">
        </div>

        <div class="ms-5 allign-self-c">
            <p><?php echo $country_data[0]['name']['common'] ?></p>
            <p>Capital:</p>
            <p><?php echo $country_data[0]['capital'][0] ?></p>
        </div>

    </div>
</div>

