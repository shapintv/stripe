<?php

declare(strict_types=1);

// Send a request to stripe-mock
$ch = curl_init('http://localhost:12111/');
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_NOBODY, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$resp = curl_exec($ch);

if (curl_errno($ch)) {
    echo "Couldn't reach stripe-mock at `localhost:12111`. Is it running? Please see README for setup instructions.\n";
    exit(1);
}

// Retrieve the Stripe-Mock-Version header
$version = null;
$headers = explode("\n", $resp);
foreach ($headers as $header) {
    $pair = explode(':', $header, 2);
    if ('Stripe-Mock-Version' == $pair[0]) {
        $version = trim($pair[1]);
    }
}

if (null === $version) {
    echo 'Could not retrieve Stripe-Mock-Version header. Are you sure that the server at `localhost:12111` is a stripe-mock instance?';
    exit(1);
}

if ('master' != $version && -1 == version_compare($version, '0.78.0')) {
    echo "Your version of stripe-mock ($version) is too old. The minimum version to run this test suite is 0.78.0.\n";
    exit(1);
}
