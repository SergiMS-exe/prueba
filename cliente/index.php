<?php
session_start();
if (isset($_SESSION['server_msg'])) {
    echo $_SESSION['server_msg'];
    unset($_SESSION['server_msg']);
}
error_reporting(E_ERROR | E_PARSE);

include 'includes/header.php';

?>

<div class="container">
    <form action="./servicios/sofa/buscar_sofas.php" method="GET">
        <div class="search__box">
            <input type="text" name="direccion" placeholder="Direccion">
            <input type="submit" value="Buscar">
        </div>
    </form>
</div>

<!-- Viajes encontrados -->
<?php
if (isset($_SESSION['msgBusqueda'])) {
    echo $_SESSION['msgBusqueda'];
    unset($_SESSION['msgBusqueda']);
}

if (isset($_SESSION['viajes_encontrados']) && !empty($_SESSION['viajes_encontrados'])) {
    $viajes = $_SESSION['viajes_encontrados'];
} else {
    unset($_SESSION['viajes_encontrados']);
    $res = file_get_contents("http://exameniwsergiomateapi.herokuapp.com/couches");
    $sofas = json_decode($res)->data->sofas;
} ?>
<section class="container">


    <table>
        <tr>
            <th>Propietario</th>
            <th>Direccion</th>
            <th>Latitud</th>
            <th>Longitud</th>
            <th>Disponible Desde</th>
        </tr>
        <?php
        foreach ($sofas as $sofa) {
            
        ?>
            <tr>
                <td><?php echo $sofa->email_propietario; ?></td>
                <td><?php echo $sofa->direccion; ?></td>
                <td><?php echo $sofa->latitud; ?></td>
                <td><?php echo $sofa->longitud; ?></td>
                <td><?php echo gmdate("d-m-Y", $sofa->fecha_inicio_disponible); ?></td>
                <form action="servicios/sofa/detalles_sofa.php" method="GET">
                    <input type="hidden" value="<?php echo $sofa->_id ?>" name="id">
                    <td><input type="submit" value="Detalles"></td>
                </form>
            </tr>

        <?php
            unset($_SESSION['viajes_encontrados']);
        } ?>
    </table>
</section>

<!-- .Viajes encontrados -->

<?php

include 'includes/footer.php';

?>