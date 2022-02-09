<?php
session_start();

if (isset($_SESSION['server_msg'])) {
    echo $_SESSION['server_msg'];
    unset($_SESSION['server_msg']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = 'https://exameniwsergiomateapi.herokuapp.com/coucheses';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, true);

    $data = array(
        "id_pasajeros" => [],
        "id_conductor" => trim($_POST['id_conductor']),
        "fecha_salida" => strtotime($_POST['fecha_salida']),
        "hora_salida" => strtotime($_POST['hora_salida']),
        "lugar_salida" => trim($_POST['lugar_salida']),
        "lugar_llegada" => trim($_POST['lugar_llegada']),
        "price" => intval($_POST['price']),
        "currency" => 'EUR'
    );

    $json = json_encode($data);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $output = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    $result = json_decode($output);

    $_SESSION['server_msg'] = $result->data->msg;

    header('Location: ../../index.php');
}

include "../../includes/header.php";
?>

<div class="container">
    <div class="login-box">
        <div class="login-card">
            <p class="login-text">Oferta tu sofa</p>

            <form action="crear_viaje.php" method="POST">
                <div class="login-inputs">
                    <div class="login-input">
                        <label for="lugar_saluda">Direccion</label>
                        <input type="text" name="direccion" required>
                    </div>
                    <div class="login-input">
                        <label for="lugar_llegada">Latitud</label>
                        <input type="text" name="latitud" required>
                    </div>
                    <div class="login-input">
                        <label for="lugar_llegada">Latitud</label>
                        <input type="text" name="latitud" required>
                    </div>
                    <input type="hidden" value=<?php echo $_SESSION['usuario']->email ?> name="email_propietario">
                    <div class="centro">
                        <button type="submit" value="Crear" class="submit-button">Crear</button>
                        <a href="../../index.php" style="margin: 2rem 1.5rem">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../../includes/footer.php' ?>