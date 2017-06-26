<html>
<head>
<title>Bulk Create</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link href="https://fonts.googleapis.com/css?family=Cutive" rel="stylesheet">
</head>

<body>
<img src="logo.jpg">
<p>  
 
<?php
include 'tokens.php';
$count = $_POST["count"];
$userNamePrefix = $_POST["userNamePrefix"];
$organization = $_POST["organization"];
$email = $_POST["email"];
$groupId = $_POST["groupId"];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://cloud-va.aerohive.com/xapi/v1/identity/credentials/bulk?ownerId=$ownerId",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\r\n  \"count\": $count,\r\n  \"offset\": $count,\r\n  \"deliverMethod\": \"EMAIL\",\r\n  \"email\": \"$email\",\r\n  \"groupId\": $groupId,\r\n  \"organization\": \"$organization\",\r\n  \"policy\": \"$policy\",\r\n  \"userNamePrefix\": \"$userNamePrefix\"\r\n}",
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer $accesstoken",
    "cache-control: no-cache",
    "content-type: application/json",
    "x-ah-api-client-id: $clientid",
    "x-ah-api-client-redirect-uri: $redirecturi",
    "x-ah-api-client-secret: $clientsecret"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
}
?>

<p>
Check 
<?php
echo $email;
?>
 for a spreadsheet containing the credentials just created.
<p>
Bulk credentials will start with "
<?php
echo $userNamePrefix;
?>
."
<p>
<a id="returnbutton" href="<?php echo $returnurl ?>">Return</a>

</body>
</html>