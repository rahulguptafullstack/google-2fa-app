<?php
	// include vendor autoload file
	require_once __DIR__.'/../vendor/autoload.php';
	// create new object
	$object = new PHPGangsta_GoogleAuthenticator();
	$error_msg	=	"";
	$success	=	false;
	// handle submit form
	if(isset($_POST['submit'])){
		// set the secret code which you scanned
		$secret = isset($_POST['secret_key']) ? $_POST['secret_key'] : '';
		$code = isset($_POST['code'])? $_POST['code'] : '';
		// call verifyCode function
		$check = $object->verifyCode($secret, $code, 0);    // 2 = 2*30sec clock tolerance
		if ($check) {
			$error_msg	=	'Google 2FA authentication verified successfully.';
			$success	=	true;
		} else {
			$error_msg	=	'Google 2FA authentication failed.';
			$success	=	false;
		}
	}else{
		$error_msg	=	"Please fill the all required fields.";
		$success	=	false;
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Verify 2FA</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
		integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
		integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
		integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
	</script>
</head>

<body>
	<div class="container">
		<div class="col-sm-6">
			<h3>2FA Authentication</h3>
			<!--Display message here-->
			<?php if(isset($error_msg) && !empty($error_msg) && isset($success) && $success == true){ ?>
			<div class="alert alert-success" role="alert">
				<?php echo $error_msg; ?>
			</div>
			<?php }else{ ?>
			<div class="alert alert-danger" role="alert">
				<?php echo $error_msg; ?>
			</div>
			<?php } ?>
			<!--Form start-->
			<form action="" method="POST">
				<div class="form-group">
					<label for="secret_key">Secret Key</label>
					<input type="text" class="form-control" id="secret_key" name="secret_key"
						aria-describedby="secretKeyHelp" placeholder="Enter Secret Key"
						value="<?php echo isset($_POST['secret_key']) ? $_POST['secret_key'] : ''; ?>" required>
					<small id="secretKeyHelp" class="form-text text-muted">Fill the secret key which you
						generated</small>
				</div>
				<div class="form-group">
					<label for="code">Code</label>
					<input type="text" class="form-control" aria-describedby="codeHelp" name="code" id="code"
						placeholder="Enter Code" value="<?php echo isset($_POST['code']) ? $_POST['code'] : ''; ?>"
						required>
					<small id="codeHelp" class="form-text text-muted">Fill 6 digit code from google authenticator
						app</small>
				</div>
				<button type="submit" name="submit" class="btn btn-primary">Submit</button>
				<button type="reset" name="reset" class="btn btn-danger">Reset</button>
			</form>
		</div>
	</div>
</body>

</html>