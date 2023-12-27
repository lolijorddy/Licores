<?php
if (isset($_GET['ruc'])) {
    $ruc_proveedor = $_GET['ruc'];

    $curl = curl_init();

    curl_setopt_array($curl, [
      CURLOPT_URL => "https://api.migo.pe/api/v1/ruc",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => json_encode([
        'token' => 'gbGR894xCBg0gTdigYe2Kxbw2osepLbQaharB1TBIzsnBFT3SqJVzKhpGQXM', // Reemplaza con tu token real
        'ruc' => $ruc_proveedor
      ]),
      CURLOPT_HTTPHEADER => [
        "accept: application/json",
        "content-type: application/json"
      ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      echo $response;
    }
}
?>
