<?php
$dataUsers = file_get_contents("https://vendavalsergiomateapi.herokuapp.com/");
$users = json_decode($dataUsers)->data->usuarios;

$dataViajes = file_get_contents("https://vendavalsergiomateapi.herokuapp.com/listaviajes");
$viajes = json_decode($dataViajes)->data->viajes;

include './includes/header.php';
?>

<section>
    <div class="container">
        <div class="admin__info-box">
            <div class="admin__info-card" onclick="window.location.href='./users.php'">
                <span>Total de usuarios</span>
                <p><?php echo count($users) ?></p>
            </div>
            <div class="admin__info-card" onclick="window.location.href='./viajes.php'">
                <span>Total de viajes</span>
                <p><?php echo count($viajes) ?></p>
            </div>
        </div>
    </div>
</section>
</body>

</html>