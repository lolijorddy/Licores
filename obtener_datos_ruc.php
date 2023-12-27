<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos del formulario
    $ruc_proveedor = $_POST['ruc_proveedor'];
    $razon_social = $_POST['razon_social'];
    $direccion = $_POST['direccion'];
    $razon_comercial = $_POST['razon_comercial'];
    $representante = $_POST['representante'];
    $telefono = $_POST['telefono'];
    $observacion = $_POST['observacion'];

    // Inicializar cURL
    $curl = curl_init();

    // Configurar las opciones de cURL
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.migo.pe/api_endpoint/' . $ruc_proveedor, // URL de la API
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer tu_api_key', // Clave API
      ),
    ));

    // Ejecutar cURL y obtener la respuesta
    $response = curl_exec($curl);

    // Verificar si hay errores en cURL
    if (curl_errno($curl)) {
        echo 'Error en cURL: ' . curl_error($curl);
    } else {
        // Convertir la respuesta JSON a un array PHP
        $datos = json_decode($response, true);
        // Aquí puedes procesar y almacenar los datos en tu base de datos
        // Por ejemplo, imprimir los datos obtenidos:
        echo '<pre>'; print_r($datos); echo '</pre>';
    }

    // Cerrar el recurso cURL
    curl_close($curl);
}
?>
