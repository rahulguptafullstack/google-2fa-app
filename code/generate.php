<?php
    // include vendor autoload file
	require_once __DIR__.'/../vendor/autoload.php';
	// create new object
    $object = new PHPGangsta_GoogleAuthenticator();

    // generate secret key
    $secret = $object->createSecret();
    $qrCodeUrl = $object->getQRCodeGoogleUrl('TeamOfDevelopers', $secret,'www.teamofdevelopers.com');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>2FA QR Code</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
		integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
		integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
		integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
	</script>
</head>

<body>
	<div class="container">
		<div class="col-sm-6">
			<h3>Secret Key & QR Code</h3>
            <div><label for="UTC">UTC Date Time: </label> <?php echo date("Y-m-d H:i:s"); ?></div>
            <div><label for="secret_key">Secret Key: </label>
            <input type="text" name="secret_key" id="secret_key" value="<?php echo $secret; ?>">
            <!-- The button used to copy the text -->
            <button onclick="copySecretKey()">Copy</button></div>
            <div>
                <label for="QR_CODE">QR Code: </label><br> 
                <img src="<?php echo $qrCodeUrl; ?>" alt="<?php echo $secret; ?>">
            </div>
		</div>
        <div class="clearfix"></div>
        <br>
        <div class="col-sm-6">
            <label>Note*:</label>
            <p>1) Please download the google authenticator app first.</p>
            <p>2) For Andorid Users download from  <a target="_blank" rel="noopener noreferrer" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en_IN">Play Store</a></p>
            <p>3) For Iphone Users download from  <a target="_blank" rel="noopener noreferrer" href="https://apps.apple.com/us/app/google-authenticator/id388497605">App Store</a></p>
            <p>4) After successful installation scan qr code or add manually. You will get auto generate 6 digit code in app which will be use for authentication.Code will be regenerate in every 30 seconds make sure verify the code before new generated.</p>
            <p>Now, we will validate and authenticate the code for that we copy the secret key and 6 digits code from app. Go to verify.php page or <a target="_blank" rel="noopener noreferrer" href="http://localhost/google-2fa-app/code/verify.php">Verify Code</a></p>
        </div>
	</div>
    <script>
        function copySecretKey() {
            /* Get the text field */
            var copyText = document.getElementById("secret_key");
            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /*For mobile devices*/

            /* Copy the text inside the text field */
            document.execCommand("copy");

            /* Alert the copied text */
            alert("Copied : " + copyText.value);
        }
    </script>
</body>
</html>