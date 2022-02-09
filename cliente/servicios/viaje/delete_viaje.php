<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $url = 'https://exameniwsergiomateapi.herokuapp.com/travels';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $data = array(
            "id" => $_POST['id']
        );

        $json = json_encode($data);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        
        $output = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch); 
        $result = json_decode($output);
        
        $_SESSION['server_msg'] = $result->data->msg;
    }
    if (isset($_SESSION['admin']))
        header('Location: ../../admin/viajes.php');
    else
        header('Location: ../../perfil_usuario.php');
?>