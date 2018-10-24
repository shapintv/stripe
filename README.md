# FriendsOfApi Stripe

[![Latest Version](https://img.shields.io/github/release/FriendsOfApi/boilerplate.svg?style=flat-square)](https://github.com/FriendsOfApi/boilerplate/releases)
[![Build Status](https://img.shields.io/travis/FriendsOfApi/boilerplate.svg?style=flat-square)](https://travis-ci.org/FriendsOfApi/boilerplate)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/FriendsOfApi/boilerplate.svg?style=flat-square)](https://scrutinizer-ci.com/g/FriendsOfApi/boilerplate)
[![Quality Score](https://img.shields.io/scrutinizer/g/FriendsOfApi/boilerplate.svg?style=flat-square)](https://scrutinizer-ci.com/g/FriendsOfApi/boilerplate)
[![Total Downloads](https://img.shields.io/packagist/dt/friendsofapi/boilerplate.svg?style=flat-square)](https://packagist.org/packages/friendsofapi/boilerplate)


## Install

Via Composer

``` bash
$ composer require friendsofapi/stripe
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
