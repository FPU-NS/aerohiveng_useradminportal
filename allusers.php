<?php  
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://cloud-va.aerohive.com/xapi/v1/identity/credentials?ownerId=<OWNERID>",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer <APITOKEN-FROMOAUTH2ORHMNGPORTAL>",
    "cache-control: no-cache",
    "x-ah-api-client-id: <AH-DEV-APP-CLIENTID>",
    "x-ah-api-client-redirect-uri: <AH-DEV-APP-REDIRECTURI>",
    "x-ah-api-client-secret: <AH-DEV-APP-CLIENTSECRET>"
  ),
));

$response = curl_exec($curl);
$json = json_decode($response, true);
$err = curl_error($curl);
$userName = $json['data'][0]['userName'];
$groupId = $json['data'][0]['groupId'];
$phone = $json['data'][0]['phone'];
$email = $json['data'][0]['email'];
$ssids = $json['data'][0]['ssids'][0];
$createTime = $json['data'][0]['createTime'];
$expireTime = $json['data'][0]['expireTime'];
curl_close($curl);

var_dump($json);

#Working on parsing out a list of users still instead of the dump above
#foreach ($json as $key => $jsons) {
#  echo $jsons;
#}

?>