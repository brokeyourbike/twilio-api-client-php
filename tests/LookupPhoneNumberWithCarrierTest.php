<?php

// Copyright (C) 2021 Ivan Stasiuk <brokeyourbike@gmail.com>.
//
// This Source Code Form is subject to the terms of the Mozilla Public
// License, v. 2.0. If a copy of the MPL was not distributed with this file,
// You can obtain one at https://mozilla.org/MPL/2.0/.

namespace BrokeYourBike\Twilio\Tests;

use Psr\Http\Message\ResponseInterface;
use BrokeYourBike\Twilio\V1\Client;
use BrokeYourBike\Twilio\Models\PhoneNumberWithCarrierResponse;
use BrokeYourBike\Twilio\Interfaces\ConfigInterface;

/**
 * @author Ivan Stasiuk <brokeyourbike@gmail.com>
 */
class LookupPhoneNumberWithCarrierTest extends TestCase
{
    private string $sid = '12345';
    private string $secret = 'super-secure-token';
    private string $phone = '+123456789';

    /** @test */
    public function it_can_prepare_request(): void
    {
        $mockedConfig = $this->getMockBuilder(ConfigInterface::class)->getMock();
        $mockedConfig->method('getUrl')->willReturn('https://api.example/');
        $mockedConfig->method('getSid')->willReturn($this->sid);
        $mockedConfig->method('getSecret')->willReturn($this->secret);

        $mockedResponse = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $mockedResponse->method('getStatusCode')->willReturn(200);
        $mockedResponse->method('getBody')
            ->willReturn('{
                "url":"https://api.example/v1/PhoneNumbers/'. $this->phone .'",
                "caller_name":null,
                "country_code":"US",
                "phone_number":"'. $this->phone .'",
                "national_format":"012 345 6789",
                "carrier": {
                    "name":"Kyivstar GSM JSC",
                    "type":"mobile",
                    "error_code":null,
                    "mobile_country_code":"255",
                    "mobile_network_code":"03"
                }
            }');

        /** @var \Mockery\MockInterface $mockedClient */
        $mockedClient = \Mockery::mock(\GuzzleHttp\Client::class);
        $mockedClient->shouldReceive('request')->withArgs([
            'GET',
            'https://api.example/v1/PhoneNumbers/+123456789',
            [
                \GuzzleHttp\RequestOptions::HTTP_ERRORS => false,
                \GuzzleHttp\RequestOptions::HEADERS => [
                    'Accept' => 'application/json',
                ],
                \GuzzleHttp\RequestOptions::AUTH => [
                    $this->sid,
                    $this->secret,
                ],
                \GuzzleHttp\RequestOptions::QUERY => [
                    'type' => 'carrier',
                ],
            ],
        ])->once()->andReturn($mockedResponse);

        /**
         * @var ConfigInterface $mockedConfig
         * @var \GuzzleHttp\Client $mockedClient
         * */
        $api = new Client($mockedConfig, $mockedClient);

        $requestResult = $api->lookupPhoneNumberWithCarrier($this->phone);

        $this->assertInstanceOf(PhoneNumberWithCarrierResponse::class, $requestResult);
    }

    /** @test */
    public function it_can_set_country_code()
    {
        $mockedConfig = $this->getMockBuilder(ConfigInterface::class)->getMock();
        $mockedConfig->method('getUrl')->willReturn('https://api.example/');
        $mockedConfig->method('getSid')->willReturn($this->sid);
        $mockedConfig->method('getSecret')->willReturn($this->secret);

        $mockedResponse = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $mockedResponse->method('getStatusCode')->willReturn(200);
        $mockedResponse->method('getBody')
            ->willReturn('{
                "url":"https://api.example/v1/PhoneNumbers/'. $this->phone .'",
                "caller_name":null,
                "country_code":"US",
                "phone_number":"'. $this->phone .'",
                "national_format":"012 345 6789",
                "carrier": {
                    "name":"Kyivstar GSM JSC",
                    "type":"mobile",
                    "error_code":null,
                    "mobile_country_code":"255",
                    "mobile_network_code":"03"
                }
            }');

        /** @var \Mockery\MockInterface $mockedClient */
        $mockedClient = \Mockery::mock(\GuzzleHttp\Client::class);
        $mockedClient->shouldReceive('request')->withArgs([
            'GET',
            'https://api.example/v1/PhoneNumbers/+123456789',
            [
                \GuzzleHttp\RequestOptions::HTTP_ERRORS => false,
                \GuzzleHttp\RequestOptions::HEADERS => [
                    'Accept' => 'application/json',
                ],
                \GuzzleHttp\RequestOptions::AUTH => [
                    $this->sid,
                    $this->secret,
                ],
                \GuzzleHttp\RequestOptions::QUERY => [
                    'type' => 'carrier',
                    'countryCode' => 'US',
                ],
            ],
        ])->once()->andReturn($mockedResponse);

        /**
         * @var ConfigInterface $mockedConfig
         * @var \GuzzleHttp\Client $mockedClient
         * */
        $api = new Client($mockedConfig, $mockedClient);

        $requestResult = $api->lookupPhoneNumberWithCarrier($this->phone, 'US');

        $this->assertInstanceOf(PhoneNumberWithCarrierResponse::class, $requestResult);
    }
}