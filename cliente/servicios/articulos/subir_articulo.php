<?php
session_start();

if (isset($_SESSION['server_msg'])) {
    echo $_SESSION['server_msg'];
    unset($_SESSION['server_msg']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = 'https://vendavalsergiomateapi.herokuapp.com/travels/add';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, true);

    $data = array(
        "titulo" => trim($_POST['titulo']),
        "descripcion" => trim($_POST['descripcion']),
        "precio_salida" => trim($_POST['precio_salida'])
    );

    $json = json_encode($data);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $output = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    $result = json_decode($output);

    $_SESSION['server_msg'] = $result->data->msg;

    header('Location: ../../perfil_usuario.php');
}

include "../../includes/header.php";
?>

<div class="container">
    <div class="login-box">
        <div class="login-card">
            <p class="login-text">Subir artículo</p>

            <form action="subir_articulo.php" method="POST">
                <div class="login-inputs">
                    <div class="login-input">
                        <label for="lugar_saluda">Título</label>
                        <input type="text" name="titulo" required>
                    </div>
                    <div class="login-input">
                        <label for="lugar_llegada">Descripción</label>
                        <input type="text" name="descripcion" required>
                    </div>
                    <div class="login-input">
                        <label for="price">Precio (€)</label>
                        <input type="number" name="precio_salida" required>
                    </div>
                    <input type="hidden" value=<?php echo $_SESSION['usuario']->email ?> name="vendedor">
                    <div class="centro">
                        <button type="submit" value="Subir" class="submit-button">Subir</button>
                        <a href="../../index.php" style="margin: 2rem 1.5rem">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../../includes/footer.php' ?>