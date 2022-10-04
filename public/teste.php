<?php
 ini_set('display_errors', 1);
$curl = curl_init();
$keyFile = __DIR__."/key.pem";
//$caFile = "ca.pem";
$certFile = __DIR__."/client.pem";
$certPass = "equestrian";



$ch= curl_init();


$payload = [
    'grant_type' => 'client_credentials',
    'scope' => 'cob.read cob.write cobv.write cobv.read lotecobv.write lotecobv.read pix.write pix.read webhook.read webhook.write payloadlocation.write payloadlocation.read'
   
];

/*

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://auth.sicoob.com.br/auth/realms/cooperado/protocol/openid-connect/token',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  
  CURLOPT_SSLKEYPASSWD => $keyFile,
  //CURLOPT_CAINFO => $caFile,
  CURLOPT_SSLCERT => $certFile,
  CURLOPT_SSLCERTPASSWD => $certPass,
  CURLOPT_SSL_VERIFYPEER => FALSE,
 CURLOPT_SSL_VERIFYHOST => FALSE,
  
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'grant_type=client_credentials&client_id=93055852-9d4b-48e4-8eca-43bc992edd44&scope=cob.read%20cob.write%20cobv.write%20cobv.read%20lotecobv.write%20lotecobv.read%20pix.write%20pix.read%20webhook.read%20webhook.write%20payloadlocation.write%20payloadlocation.read',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/x-www-form-urlencoded'
  ),
));
*/


curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$curl = "curl -k -v --insecure --cert ./client.pem:equestrian--key ./key.pem -X POST -H 'Content-Type: application/x-www-form-urlencoded' --data-urlencode 'grant_type=client_credentials' --data-urlencode 'scope=cob.read cob.write cobv.write cobv.read lotecobv.write lotecobv.read pix.write pix.read webhook.read webhook.write payloadlocation.write payloadlocation.read' 'https://auth.sicoob.com.br/auth/realms/cooperado/protocol/openid-connect/token'";


$response = curl_exec($curl);

curl_close($curl);
echo $response;

