# Paystack

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

This is where your description should go. Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

``` bash
$ composer require prosperoking/paystack
```

After installing run vendor publish and select PaystackTransfer from the prompt
```bash
$ php artisan vendor:publish
```

## Usage

- Validate an Account Number: 
 Now you can have a bank account validator *bankaccount* to enable you to validate an account number you will need to pass the bankcode field to it.
```php

Validator::validate($data,[
    'bankcode'=>'required|string',
    'account_no'=>'required|bankaccount,bankcode'
])
```

- Get Banks

```php

    Paystack::getBanks(); // returns  a laravel collection

```

- Create a transfer Recipient
```php

    \PaystackTransfer::createTransferReciept($account_no,$bank_code, $account_name);

```

- Make a transfer

```php
    \PaystackTransfer::transfer($recipient_code, $amount, $reason);

```
- Get transfer 
```php
    \PaystackTransfer::fetchTransfer(string $id_or_code);

```

- Get Transfer Balance

```php
    \PaystackTransfer::balance()
```

- Make Bulk Transfer

```php

    $payload = $transfers->map(fn(Transfer $transfer)=>[
                    'reference'=>$transfer->id,
                    'recipient'=>$transfer->recipient,
                    'amount'=> (int) round($transfer->amount * 100)
                ])->toArray();
    \PaystackTransfer::bulkTransfer($payload);

```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [author name][link-author]
- [All Contributors][link-contributors]

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/prosperoking/paystack.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/prosperoking/paystack.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/prosperoking/paystack/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/prosperoking/paystack
[link-downloads]: https://packagist.org/packages/prosperoking/paystack
[link-travis]: https://travis-ci.org/prosperoking/paystack
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/prosperoking
[link-contributors]: ../../contributors
