# twilio-api-client

[![Latest Stable Version](https://img.shields.io/github/v/release/brokeyourbike/twilio-api-client-php)](https://github.com/brokeyourbike/twilio-api-client-php/releases)
[![Total Downloads](https://poser.pugx.org/brokeyourbike/twilio-api-client/downloads)](https://packagist.org/packages/brokeyourbike/twilio-api-client)
[![License: MPL-2.0](https://img.shields.io/badge/license-MPL--2.0-purple.svg)](https://github.com/brokeyourbike/twilio-api-client-php/blob/main/LICENSE)

[![Maintainability](https://api.codeclimate.com/v1/badges/cbab9f6ee2fde9c9b0c8/maintainability)](https://codeclimate.com/github/brokeyourbike/twilio-api-client-php/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/cbab9f6ee2fde9c9b0c8/test_coverage)](https://codeclimate.com/github/brokeyourbike/twilio-api-client-php/test_coverage)
[![tests](https://github.com/brokeyourbike/twilio-api-client-php/actions/workflows/tests.yml/badge.svg)](https://github.com/brokeyourbike/twilio-api-client-php/actions/workflows/tests.yml)

Twilio API Client for PHP

## Installation

```bash
composer require brokeyourbike/twilio-api-client
```

## Usage

```php
use BrokeYourBike\Twilio\Interfaces\ConfigInterface;
use BrokeYourBike\Twilio\V1\Lookup;

assert($config instanceof ConfigInterface)
assert($httpClient instanceof \GuzzleHttp\ClientInterface)

$lookup = new Lookup($config, $httpClient);
$lookup->phoneNumber('+123456789');
```

## Why

[twilio/sdk](https://github.com/twilio/twilio-php) is not typed enough

## License
[Mozilla Public License v2.0](https://github.com/brokeyourbike/twilio-api-client-php/blob/main/LICENSE)
