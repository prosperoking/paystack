# Changelog

All notable changes to `Paystack` will be documented in this file.

## Version 0.1

### Added
- This release contains fixes and more features
 Now you can have a bank account validator *bankaccount* to enable you to validate an account number you will need to pass the bankcode field to it.
```php

Validator::validate($data,[
    'bankcode'=>'required|string',
    'account_no'=>'required|bankaccount,account.bankcode'
])
