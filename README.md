Google Authenticator PHP class
==============================
* Author: Rahul Gupta 
* Package Used: PHPGangsta [https://github.com/PHPGangsta](https://github.com/PHPGangsta)
Usage:
------

See following example:

```php
<?php
require_once 'PHPGangsta/GoogleAuthenticator.php';

$ga = new PHPGangsta_GoogleAuthenticator();
$secret = $ga->createSecret();
echo "Secret is: ".$secret."\n\n";

$qrCodeUrl = $ga->getQRCodeGoogleUrl('Blog', $secret);
echo "Google Charts URL for the QR-Code: ".$qrCodeUrl."\n\n";

$oneCode = $ga->getCode($secret);
echo "Checking Code '$oneCode' and Secret '$secret':\n";

$checkResult = $ga->verifyCode($secret, $oneCode, 2);    // 2 = 2*30sec clock tolerance
if ($checkResult) {
    echo 'OK';
} else {
    echo 'FAILED';
}
```
Running the script provides the following output:
```
Secret is: TEV6D4UCJF6JRZRX

Google Charts URL for the QR-Code: https://www.google.com/chart?chs=200x200&chld=M|0&cht=qr&chl=otpauth://totp/infoATphpgangsta.de%3Fsecret%3DOQB6ZZGYHCPSX4AK

Checking Code '789569' and Secret 'TEV6D4UCJF6JRZRX':
OK
```

Installation:
-------------

- Use [Composer](https://getcomposer.org/doc/01-basic-usage.md) to
  install the package if vendor folder not found otherwise simply clone the repo and run

- From project root directory execute following

```composer install```

- [Composer](https://getcomposer.org/doc/01-basic-usage.md) will take care of autoloading
  the library. Just include the following at the top of your file

  `require_once __DIR__ . '/../vendor/autoload.php';`
