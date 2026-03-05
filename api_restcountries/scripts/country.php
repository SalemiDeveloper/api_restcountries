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
?>

<div class="contianer mt-5">
    <div class="d-flex">
        <div class="card p-2 shadow">
            <img src="<?php echo $country_data[0]['flags']['png'] ?>" alt="">
        </div>

        <div class="ms-5 allign-self-c">
            <h3>Nome do pa�s</h3>
            <p class="display-3"><?php echo $country_data[0]['name']['common'] ?></p>
            <h3>Capital:</h3>
            <p><?php echo $country_data[0]['capital'][0] ?></p>
            <h3>Popula��o:</h3>
            <p><?php echo $country_data[0]['population'] ?></p>
        </div>

    </div>

    <div class="row mt-3">
        <div class="col">
            <p>Regi�o: </p>
        </div>
    </div>
</div>

