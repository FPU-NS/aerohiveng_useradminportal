<html>
<head>
<title>Credential Creation</title>
<style>
body {
    background-color: #000000;
}
a:link, a:visited {
    background-color: #0039e6;
    color: white;
    padding: 14px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
}


a:hover, a:active {
    background-color: #002db3;
}
</style>  
<link href="https://fonts.googleapis.com/css?family=Cutive" rel="stylesheet">  
</head>

<body text="#FFFFFF">
<font face='Cutive'>
<img src="logo.jpg">
<p>  
 
<?php 
curl_setopt($process, CURLOPT_SSL_VERIFYPEER, true);
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$policy = "GUEST";
$userName = $_POST["userName"];
$userGroup = $_POST["userGroup"];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://cloud-va.aerohive.com/xapi/v1/identity/credentials?ownerId=<OWNERID>",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\r\n  \"deliverMethod\": \"EMAIL_AND_SMS\",\r\n  \"policy\": \"$policy\",\r\n  \"email\": \"$email\",\r\n  \"firstName\": \"$firstName\",\r\n  \"groupId\": \"$userGroup\",\r\n  \"lastName\": \"$lastName\",\r\n \"phone\": \"1$phone\",\r\n  \"userName\": \"$userName\"\r\n}",
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer <APITOKEN-FROMOAUTH2ORHMNGPORTAL>",
    "cache-control: no-cache",
    "content-type: application/json",
    "x-ah-api-client-id: <AH-DEV-APP-CLIENTID>",
    "x-ah-api-client-redirect-uri: <AH-DEV-APP-REDIRECTURI>",
    "x-ah-api-client-secret: <AH-DEV-APP-CLIENTSECRET>"
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
<a href="<ORGINALFORMURL>">Return</a>
</font>
</body>
</html>