<html>
<head>
<title>List</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link href="https://fonts.googleapis.com/css?family=Cutive" rel="stylesheet">
</head>

<body>
<img src="logo.jpg">
<p>  

<?php
include 'tokens.php';  
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://cloud-va.aerohive.com/xapi/v1/identity/credentials?ownerId=$ownerId&pageSize=1000",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer $accesstoken",
    "cache-control: no-cache",
    "x-ah-api-client-id: $clientid",
    "x-ah-api-client-redirect-uri: $redirecturi",
    "x-ah-api-client-secret: $clientsecret"
  ),
));

$response = curl_exec($curl);
$json = json_decode($response, true);
$err = curl_error($curl);
$x = 0;
foreach ($json['data'] as $key => $jsons) {
#$arrlength = count($jsons);

#You must fill in the groupId numbers here. I usually utilize postman to list each usergroup's id.
$groupId = $json['data'][$x]['groupId'];
if ($groupId == "") {
  $type = "student";
} elseif ($groupId == "") { 
  $type = "guest";
} elseif ($groupId == "") { 
  $type = "bulk guest";
} else { 
  $type = "Not Found or Unknown Error";
}
echo "username: ";
echo $json['data'][$x]['userName'];
echo "<br>email: ";
echo $json['data'][$x]['email'];
echo "<br>mobile: ";
echo $json['data'][$x]['phone'];
echo "<br>group id: ";
echo $type;
echo "<br>user id: ";
echo $json['data'][$x]['id'];
echo "<br>ssid: ";
echo $json['data'][$x]['ssids'][0];
echo "<br>creation: ";
echo $json['data'][$x]['createTime'];
echo "<br>expiration: ";
echo $json['data'][$x]['expireTime'];
echo "<p>";
$x ++;
}
curl_close($curl);
?>

<p>
<a id="returnbutton" href="<?php echo $returnurl ?>">Return</a>

</body>
</html>