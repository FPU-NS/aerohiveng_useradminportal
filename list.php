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
  CURLOPT_URL => "https://cloud-va.aerohive.com/xapi/v1/identity/credentials?ownerId=$ownerId",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer $guesttoken",
    "cache-control: no-cache",
    "x-ah-api-client-id: $clientid",
    "x-ah-api-client-redirect-uri: $redirecturi",
    "x-ah-api-client-secret: $clientsecret"
  ),
));

$response = curl_exec($curl);
$json = json_decode($response, true);
$err = curl_error($curl);

#$userName = $json['data'][0]['userName'];
#$groupId = $json['data'][0]['groupId'];
#$id = $json['data'][0]['id'];
#$organization = $json['data'][0]['organization'];
#$ssids = $json['data'][0]['ssids'][0];
#$createTime = $json['data'][0]['createTime'];
#$expireTime = $json['data'][0]['expireTime'];
curl_close($curl);

foreach ($json['data'] as $key => $jsons) {
  foreach ($jsons as $objects) {     
    echo $objects; 
  }
}

?>

 
<!--- <p>
username: 
<?php
#  echo $userName;
?>
<br>
groupId: 
<?php
#  echo $groupId;
?>
<br>
credential id: 
<?php
#  echo $id;
?>
<br>
organization: 
<?php
#  echo $organization;
?>
<br>
ssid(s): 
<?php
#  echo $ssids;
?>  
<br>
Creation Time: 
<?php
#  echo $createTime;
?>    
<br>
Expiration: 
<?php
#  echo $expireTime;
?>    
-->

<p>
<a id="returnbutton" href="<?php echo $returnurl ?>">Return</a>

</body>
</html>