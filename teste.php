<?php
 ini_set('display_errors', 1);
$curl = curl_init();
$keyFile = "/key.pem";
//$caFile = "ca.pem";
$certFile = "client.pem";
$certPass = "equestrian";

//curl_setopt($curl, CURLOPT_URL, $actualUrl);


/*
/ this with CURLOPT_SSLKEYPASSWD
  curl_setopt($ch, CURLOPT_SSLKEY, $keyFile);

  // The --cacert option
  curl_setopt($ch, CURLOPT_CAINFO, $caFile);

  // The --cert option
  curl_setopt($ch, CURLOPT_SSLCERT, $certFile);
  curl_setopt($ch, CURLOPT_SSLCERTPASSWD, $certPass);
 */

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://auth.sicoob.com.br/auth/realms/cooperado/protocol/openid-connect/token',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

  CURLOPT_SSLKEYPASSWD => $keyFile,
  //CURLOPT_CAINFO => $caFile,
  CURLOPT_SSLCERT => $certFile,
  CURLOPT_SSLCERTPASSWD => $certPass,
  CURLOPT_SSL_VERIFYPEER => FALSE,

  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'grant_type=client_credentials&client_id=93055852-9d4b-48e4-8eca-43bc992edd44&scope=cob.read%20cob.write%20cobv.write%20cobv.read%20lotecobv.write%20lotecobv.read%20pix.write%20pix.read%20webhook.read%20webhook.write%20payloadlocation.write%20payloadlocation.read',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/x-www-form-urlencoded',
    'Cookie: TS01dfa94a=017a3a183b61f7caae2729d9af7af2f8fc0b2564909738710ca519d25f055c04ab27648e4c9fb832383604c08ed77b550f0fa21eb111b0cf5ce183f3eb1d12084721259ad9; 447fb61b35fb4f9d67cbcbbebfb597fc=958cdcf2189cae303bb6b13a08c83a60; TS01dd6f1a=017a3a183bd853c53effc2df64a7c459c711e5d19807c163b4b8a270f75227dddc4512ace9b589acd4e8f04cab893452f0350080edfc31da877beed1963ac65962e7e28aac'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
