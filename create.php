<html>
<head>
<title>Create</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link href="https://fonts.googleapis.com/css?family=Cutive" rel="stylesheet">
</head>

<body>
<img src="logo.jpg">
<p>  
 
<?php
include 'tokens.php';  
curl_setopt($process, CURLOPT_SSL_VERIFYPEER, true);
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$policy = "GUEST";
$userName = $_POST["email"];
$userGroup = $_POST["userGroup"];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://cloud-va.aerohive.com/xapi/v1/identity/credentials?ownerId=$ownerId",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\r\n  \"deliverMethod\": \"EMAIL\",\r\n  \"policy\": \"$policy\",\r\n  \"email\": \"$email\",\r\n  \"firstName\": \"$firstName\",\r\n  \"groupId\": \"$userGroup\",\r\n  \"lastName\": \"$lastName\",\r\n \"phone\": \"$phone\",\r\n \"userName\": \"$userName\"\r\n}",
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer $guesttoken",
    "cache-control: no-cache",
    "content-type: application/json",
    "x-ah-api-client-id: $clientid",
    "x-ah-api-client-redirect-uri: $redirecturi",
    "x-ah-api-client-secret: $clientsecret"
  ),
));

$response = curl_exec($curl);
$json = json_decode($response);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else { 
    echo "SSID " .$json->data->ssid[0];
    echo " Password: " .$json->data->password; 
}
?>
<p>
<a id="returnbutton" href="<?php echo $returnurl ?>">Return</a>

</body>
</html>