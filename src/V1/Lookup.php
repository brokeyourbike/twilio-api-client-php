<?php

// Copyright (C) 2021 Ivan Stasiuk <brokeyourbike@gmail.com>.
//
// This Source Code Form is subject to the terms of the Mozilla Public
// License, v. 2.0. If a copy of the MPL was not distributed with this file,
// You can obtain one at https://mozilla.org/MPL/2.0/.

namespace BrokeYourBike\Twilio\V1;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\ClientInterface;
use BrokeYourBike\Twilio\Options;
use BrokeYourBike\Twilio\Models\PhoneNumberWithCarrierResponse;
use BrokeYourBike\Twilio\Models\PhoneNumberResponse;
use BrokeYourBike\Twilio\Models\PhoneNumberOptions;
use BrokeYourBike\Twilio\Interfaces\ConfigInterface;
use BrokeYourBike\ResolveUri\ResolveUriTrait;
use BrokeYourBike\HttpEnums\HttpMethodEnum;
use BrokeYourBike\HttpClient\HttpClientTrait;
use BrokeYourBike\HttpClient\HttpClientInterface;

/**
 * @author Ivan Stasiuk <brokeyourbike@gmail.com>
 */
class Lookup implements HttpClientInterface
{
    use HttpClientTrait;
    use ResolveUriTrait;

    public const BASE_URL = 'https://lookups.twilio.com/v1/';

    private ConfigInterface $config;

    public function __construct(ConfigInterface $config, ClientInterface $httpClient)
    {
        $this->config = $config;
        $this->httpClient = $httpClient;
    }

    public function phoneNumberWithCarrier(string $phoneNumber, ?string $countryCode = null): PhoneNumberWithCarrierResponse
    {
        $options = (new PhoneNumberOptions())->setType('carrier');

        if ($countryCode !== null) {
            $options->setCountryCode($countryCode);
        }

        $response = $this->phoneNumberRaw($phoneNumber, $options);
        return new PhoneNumberWithCarrierResponse($response);
    }

    public function phoneNumber(string $phoneNumber, ?PhoneNumberOptions $options = null): PhoneNumberResponse
    {
        $response = $this->phoneNumberRaw($phoneNumber, $options ?? new PhoneNumberOptions());
        return new PhoneNumberResponse($response);
    }

    public function phoneNumberRaw(string $phoneNumber, ?PhoneNumberOptions $options = null): ResponseInterface
    {
        return $this->performRequest(HttpMethodEnum::GET(), "PhoneNumbers/{$phoneNumber}", $options ?? new PhoneNumberOptions());
    }

    /**
     * @param HttpMethodEnum $method
     * @param string $uri
     * @param Options $data
     * @return ResponseInterface
     */
    private function performRequest(HttpMethodEnum $method, string $uri, Options $data): ResponseInterface
    {
        $options = [
            \GuzzleHttp\RequestOptions::HTTP_ERRORS => false,
            \GuzzleHttp\RequestOptions::HEADERS => [
                'Accept' => 'application/json',
            ],
            \GuzzleHttp\RequestOptions::AUTH => [
                $this->config->getSid(),
                $this->config->getSecret(),
            ],
        ];

        if (HttpMethodEnum::GET()->equals($method)) {
            $options[\GuzzleHttp\RequestOptions::QUERY] = $data->toArray();
        } elseif (HttpMethodEnum::POST()->equals($method)) {
            $options[\GuzzleHttp\RequestOptions::JSON] = $data->toArray();
        }

        $uri = (string) $this->resolveUriFor(self::BASE_URL, $uri);
        return $this->httpClient->request((string) $method, $uri, $options);
    }
}
