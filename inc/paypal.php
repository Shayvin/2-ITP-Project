<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api-m.sandbox.paypal.com/v1/oauth2/token');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

curl_setopt($ch, CURLOPT_USERPWD, 'AbFZ3_BhtY9LxaAJXM0QHVbfd1vLSwmQ8Y-XP-gglW8JIzfFdJpvoxNG-JZX1_AjRerNhjSz6S0lR60b:EB2g9yLWbvQEcP-T41PB29n6vDrvFByj8Oy1rRNLp3NAeHPkJJFOpmRjYgJEaEzSat_bSUudWvvzSv8A');

$headers = array();
$headers[] = 'Accept: application/json';
$headers[] = 'Accept-Language: en_US';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);

if (curl_errno($ch))
{
    echo json_encode([
        "status" => "error",
        "message" => curl_error($ch)
    ]);
    exit();
}
curl_close($ch);

$result = json_decode($result);

$access_token = $result->access_token;

$payment_token_parts = explode("-", $_POST["orderID"]);
$payment_id = "";
 
if (count($payment_token_parts) > 1)
{
    $payment_id = $payment_token_parts[1];
}

$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, 'https://api-m.sandbox.paypal.com/v2/checkout/orders/' . $payment_id);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');

$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Authorization: Bearer ' . $access_token;
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($curl);

if (curl_errno($curl))
{
    echo json_encode([
        "status" => "error",
        "message" => "Payment not verified. " . curl_error($curl)
    ]);
    exit();
}
curl_close($curl);


$result = json_decode($result);

echo json_encode([
    "status" => "success",
    "message" => "Payment verified.",
    "result" => $result
]);
exit();
?>