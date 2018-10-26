# Stripe PHP SDK

[![Latest Version](https://img.shields.io/github/release/shapintv/stripe.svg?style=flat-square)](https://github.com/shapintv/stripe/releases)
[![Build Status](https://img.shields.io/travis/shapintv/stripe.svg?style=flat-square)](https://travis-ci.org/shapintv/stripe)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/shapintv/stripe.svg?style=flat-square)](https://scrutinizer-ci.com/g/shapintv/stripe)
[![Quality Score](https://img.shields.io/scrutinizer/g/shapintv/stripe.svg?style=flat-square)](https://scrutinizer-ci.com/g/shapintv/stripe)
[![Total Downloads](https://img.shields.io/packagist/dt/friendsofapi/stripe.svg?style=flat-square)](https://packagist.org/packages/friendsofapi/stripe)


## Install

Via Composer

``` bash
$ composer require shapintv/stripe
```

## Usage

``` php
$stripeClient = StripeClient::create($stripeApiKey);
$balance = $apiClient->balances()->get();
echo $balance->getAvailable()->getAmount()->getAmount(); // 22;
```

## Contributing

In order to test locally, you need to have [stripe-mock](https://github.com/stripe/stripe-mock#usage) installed.

The run `stripe-mock 2>&1 > /dev/null &` and you're done.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
