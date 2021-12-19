# twilio-api-client

[![Latest Stable Version](https://img.shields.io/github/v/release/brokeyourbike/twilio-api-client-php)](https://github.com/brokeyourbike/twilio-api-client-php/releases)
[![Total Downloads](https://poser.pugx.org/brokeyourbike/twilio-api-client/downloads)](https://packagist.org/packages/brokeyourbike/twilio-api-client)
[![License: MPL-2.0](https://img.shields.io/badge/license-MPL--2.0-purple.svg)](https://github.com/brokeyourbike/twilio-api-client-php/blob/main/LICENSE)


[![tests](https://github.com/brokeyourbike/twilio-api-client-php/actions/workflows/tests.yml/badge.svg)](https://github.com/brokeyourbike/twilio-api-client-php/actions/workflows/tests.yml)

Twilio API Client for PHP

## Installation

```bash
composer require brokeyourbike/twilio-api-client
```

## Usage

```php
use BrokeYourBike\Twilio\Client;

$apiClient = new Client($config, $httpClient, $psrCache);
$apiClient->fetchAuthTokenRaw();
```

## Why

[twilio/sdk](https://github.com/twilio/twilio-php) is not typed enough

## License
[Mozilla Public License v2.0](https://github.com/brokeyourbike/twilio-api-client-php/blob/main/LICENSE)
