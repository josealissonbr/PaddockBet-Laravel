<?php

$curl = curl_init();

$certFile = __DIR__."cert.p12";
$certPass = "equestrian";



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://auth.sicoob.com.br/auth/realms/cooperado/protocol/openid-connect/token");
curl_setopt($ch, CURLOPT_PORT , 443);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_SSLCERT, getcwd() . "/client.pem");
curl_setopt($ch, CURLOPT_SSLKEY, getcwd() . "/key.pem");
//curl_setopt($ch, CURLOPT_CAINFO, "/etc/ssl/certs/ca-certificates.crt");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials&client_id=93055852-9d4b-48e4-8eca-43bc992edd44&scope=cob.read%20cob.write%20cobv.write%20cobv.read%20lotecobv.write%20lotecobv.read%20pix.write%20pix.read%20webhook.read%20webhook.write%20payloadlocation.write%20payloadlocation.read");



$response = curl_exec($ch);
$info =curl_errno($ch)>0 ? array("curl_error_".curl_errno($ch)=>curl_error($ch)) : curl_getinfo($ch);
print_r($info);
curl_close($ch);
echo $response;