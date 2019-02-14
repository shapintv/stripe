# Stripe PHP SDK

[![Latest Version](https://img.shields.io/github/release/shapintv/stripe.svg?style=flat-square)](https://github.com/shapintv/stripe/releases)
[![Build Status](https://img.shields.io/travis/shapintv/stripe.svg?style=flat-square)](https://travis-ci.org/shapintv/stripe)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/shapintv/stripe.svg?style=flat-square)](https://scrutinizer-ci.com/g/shapintv/stripe)
[![Quality Score](https://img.shields.io/scrutinizer/g/shapintv/stripe.svg?style=flat-square)](https://scrutinizer-ci.com/g/shapintv/stripe)
[![Total Downloads](https://img.shields.io/packagist/dt/shapin/stripe.svg?style=flat-square)](https://packagist.org/packages/shapin/stripe)


## Install

Via Composer

``` bash
$ composer require shapintv/stripe
```

## Usage

``` php
$stripeClient = StripeClient::create($stripeApiKey);
$subscription = $apiClient->subscriptions()->get('sub_myid');
echo $subscription->isActive(); // true
echo $subscription->getCreatedAt()->getTimestamp(); // 1234567890
```

## Contributing

In order to test locally, you need to have [stripe-mock](https://github.com/stripe/stripe-mock#usage) installed.

To install the correct version, use `make install`.

You can start the Stripe mock server with `make start` and stop it with `make stop`.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
