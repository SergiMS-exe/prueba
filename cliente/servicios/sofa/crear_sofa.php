<?php
session_start();

if (isset($_SESSION['server_msg'])) {
    echo $_SESSION['server_msg'];
    unset($_SESSION['server_msg']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = 'https://exameniwsergiomateapi.herokuapp.com/couches';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, true);

    $data = array(
        "fotos" => [],
        "email_propietario" => trim($_POST['email_propietario']),
        "direccion" => trim($_POST['direccion']),
        "latitud" => trim($_POST['latitud']),
        "longitud" => trim($_POST['email_propietario']),
        "fecha_inicio_disponible" => strtotime($_POST['fecha_inicio_disponible']),
        "fecha_fin_disponible" => strtotime($_POST['fecha_fin_disponible'])
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

            <form action="crear_sofa.php" method="POST">
                <div class="login-inputs">
                    <div class="login-input">
                        <label for="direccion">Direccion</label>
                        <input type="text" name="direccion" required>
                    </div>
                    <div class="login-input">
                        <label for="latitud">Latitud</label>
                        <input type="text" name="latitud" required>
                    </div>
                    <div class="login-input">
                        <label for="longitud">Longitud</label>
                        <input type="text" name="longitud" required>
                    </div>
                    <div class="col">
                        <label for="fecha_inicio_disponible">fecha inicio</label>
                        <input type="date" name="fecha_inicio_disponible" required>
                    </div>
                    <div class="col">
                        <label for="fecha_fin_disponible">fecha fin</label>
                        <input type="date" name="fecha_fin_disponible" required>
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