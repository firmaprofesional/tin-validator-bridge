# tin-validator-bridge
This library provides an static bridge to European TIN check [WSDL](https://ec.europa.eu/taxation_customs/tin/checkTinService.wsdl)

If you have questions or problems with installation or usage [create an Issue](https://github.com/firmaprofesional/tin-validator-bridge/issues).

## Installation

In order to install this library via composer run the following command in the console:

```sh
composer require firmaprofesional/tin-validator-bridge
```

or add the package manually to your composer.json file in the require section:

```json
"firmaprofesional/tin-validator-bridge": ">0.1"
```

## Usage examples

Simple checkTin will return an array
```php
$result = EuropeanTinValidatorService::checkTin('99999999R', 'ES');

var_dump($result);
```
Will return
```php
array(5) {
  'countryCode' =>
  string(2) "ES"
  'tinNumber' =>
  string(9) "99999999R"
  'requestDate' =>
  string(16) "2018-05-24+02:00"
  'validStructure' =>
  bool(true)
  'validSyntax' =>
  bool(true)
}
```

Check isValidTin will return a bool
```php
$result = EuropeanTinValidatorService::isValidTin('99999999R', 'ES');

var_dump($result);
```
Will return
```php
true
```

## Testing

In order to test the library:

1. Create a fork
2. Clone the fork to your machine
3. Install the depencies `composer install`
4. Run the unit tests `./vendor/phpunit/bin/phpunit -c phpunit.xml --testsuite general`
