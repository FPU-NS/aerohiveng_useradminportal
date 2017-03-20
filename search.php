<html>
<head>
<title>Credential Search</title>
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
$phone = $_POST["phone"];
$userName = $_POST["userName"];
$email = $_POST["email"];
$curl = curl_init();
$URL = "https://cloud-va.aerohive.com/xapi/v1/identity/credentials?ownerId=<OWNERID>&phone=1$phone&userName=$userName&email=$email";

curl_setopt_array($curl, array(
  CURLOPT_URL => "$URL",
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
$id = $json['data'][0]['id'];
$userName = $json['data'][0]['userName'];
$groupId = $json['data'][0]['groupId'];
$phone = $json['data'][0]['phone'];
$email = $json['data'][0]['email'];
$ssids = $json['data'][0]['ssids'][0];
$createTime = $json['data'][0]['createTime'];
$expireTime = $json['data'][0]['expireTime'];

if ($groupId == "groupIdnumber") {
  $type = "student";
} elseif ($groupId == "groupIdnumber") { 
  $type = "guest";
} else { 
  $type = "Not Found or Unknown Error";
}

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} 
?>

<p>
username: 
<?php
  echo $userName;
?>
<p>
type: 
<?php
  echo $type;
?>
<p>
credential id: 
<?php
  echo $id;
?>
<p>
phone: 
<?php
  echo $phone;
?>
<p>
email: 
<?php
  echo $email;
?>
<p>
ssid(s): 
<?php
  echo $ssids;
?>  
<p>
Creation Time: 
<?php
  echo $createTime;
?>    
<p>
Expiration: 
<?php
  echo $expireTime;
?>    
<div style="float: left;">
<p>
<a href="<ORGINALFORMURL>">Return</a>
</div>

<div style="float: left;">
<form action="renew.php" method="post" onsubmit="return confirm('Are you sure you want to renew <?php echo htmlspecialchars($userName); ?>?');">
<input type="hidden" name="userName" value="<?php echo htmlspecialchars($userName); ?>">
<input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
<input type="submit" name="submit" value="Renew" />
</form>
</div>

<div style="float: left;">
<form action="delete.php" method="post" onsubmit="return confirm('Are you sure you want to delete <?php echo htmlspecialchars($userName); ?>?');">
<input type="hidden" name="userName" value="<?php echo htmlspecialchars($userName); ?>">
<input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
<input type="submit" name="submit" value="Delete" />
</form>
</div>

</font>
</body>
</html>