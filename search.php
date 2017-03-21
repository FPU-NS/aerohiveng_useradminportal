<html>
<head>
<title>Search</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cutive">  
</head>

<body>
<img src="logo.jpg" valign="top">
<p> 

<?php
include 'tokens.php';
$phone = $_POST["phone"];
$userName = $_POST["userName"];
$email = $_POST["email"];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://cloud-va.aerohive.com/xapi/v1/identity/credentials?ownerId=$ownerId&phone=1$phone&userName=$userName&email=$email",
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
$id = $json['data'][0]['id'];
$userName = $json['data'][0]['userName'];
$groupId = $json['data'][0]['groupId'];
$phone = $json['data'][0]['phone'];
$email = $json['data'][0]['email'];
$ssids = $json['data'][0]['ssids'][0];
$createTime = $json['data'][0]['createTime'];
$expireTime = $json['data'][0]['expireTime'];

if ($groupId == "7799660611852") {
  $type = "student";
} elseif ($groupId == "7799660611659") { 
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

<div class="buttons">
<a id="returnbutton" href="<?php echo $returnurl ?>">Return</a>
</div>

<div class="buttons">
<form action="renew.php" method="post" onsubmit="return confirm('Are you sure you want to renew <?php echo htmlspecialchars($userName); ?>?');">
<input type="hidden" name="userName" value="<?php echo htmlspecialchars($userName); ?>">
<input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
<input id="buttons" type="submit" name="submit" value="Renew">
</form>
</div>

<div class="buttons">
<form  action="delete.php" method="post" onsubmit="return confirm('Are you sure you want to delete <?php echo htmlspecialchars($userName); ?>?');">
<input type="hidden" name="userName" value="<?php echo htmlspecialchars($userName); ?>">
<input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
<input id="buttons" type="submit" name="submit" value="Delete" />
</form>
</div>

</body>
</html>