<?php
require_once("vendor/autoload.php");

$test_keys = array(
    "publishable_key" => "pk_test_51LZuhFLHyPqv3x1TF5F269Ye7pt1I2Gc87lSxMWGOdcLPAQtjeqsvbO1WMFLCcZOJJ9HMUDUnv5DrSoiHt6qCCLm00iEukYOfb",
    "secret_key" => "sk_test_51LZuhFLHyPqv3x1TjaGwJeadd8Ox7jTDkiNRWr0kvtx9fiZBjvLMnEdnF4GrxrlSYpU2hGWiCsuOoHBYkXQuSKjR00zIMG6BB4"
);
\Stripe\Stripe::SetApiKey($test_keys['secret_key']);
?>