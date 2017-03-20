<html>
<head>
<title>Credential Renewal</title>
<style>
body {
    background-color: #000000;
}
a:link, a:visited {
    background-color: #0039e6;
    color: white;
    width: 75px;
    height:40px;
    border: none;
    border-radius: 4px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
}


a:hover, a:active {
    background-color: #002db3;
}

input[type=submit] {
    width: 75px;
    height:40px;
    background-color: #0039e6;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
</style>  
<link href="https://fonts.googleapis.com/css?family=Cutive" rel="stylesheet">  
</head>

<body text="#FFFFFF">
<font face='Cutive'>
<img src="logo.jpg">
<p> 


<?php
$userName = $_POST["userName"];
$id = $_POST["id"];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://cloud-va.aerohive.com/xapi/v1/identity/credentials/$id/renew?ownerId=<OWNERID>",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "PUT",
  CURLOPT_POSTFIELDS => "",
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
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
}  else { 
     echo $response;
}
?>
<p>
<?php
echo $userName;
?>
 has been renewed
<p>
<a href="<ORGINALFORMURL>">Return</a>
</font>
</body>
</html>