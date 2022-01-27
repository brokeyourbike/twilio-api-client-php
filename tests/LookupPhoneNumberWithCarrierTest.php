<?php

// Copyright (C) 2021 Ivan Stasiuk <ivan@stasi.uk>.
//
// This Source Code Form is subject to the terms of the Mozilla Public
// License, v. 2.0. If a copy of the MPL was not distributed with this file,
// You can obtain one at https://mozilla.org/MPL/2.0/.

namespace BrokeYourBike\Twilio\Tests;

use Psr\Http\Message\ResponseInterface;
use BrokeYourBike\Twilio\V1\Lookup;
use BrokeYourBike\Twilio\Models\PhoneNumberResponse;
use BrokeYourBike\Twilio\Interfaces\ConfigInterface;

/**
 * @author Ivan Stasiuk <ivan@stasi.uk>
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
            Lookup::BASE_URL.'PhoneNumbers/+123456789',
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
                    'Type' => 'carrier',
                ],
            ],
        ])->once()->andReturn($mockedResponse);

        /**
         * @var ConfigInterface $mockedConfig
         * @var \GuzzleHttp\Client $mockedClient
         * */
        $api = new Lookup($mockedConfig, $mockedClient);

        $requestResult = $api->phoneNumberWithCarrier($this->phone);

        $this->assertInstanceOf(PhoneNumberResponse::class, $requestResult);
    }

    /** @test */
    public function it_can_set_country_code()
    {
        $mockedConfig = $this->getMockBuilder(ConfigInterface::class)->getMock();
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
            Lookup::BASE_URL.'PhoneNumbers/+123456789',
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
                    'Type' => 'carrier',
                    'CountryCode' => 'US',
                ],
            ],
        ])->once()->andReturn($mockedResponse);

        /**
         * @var ConfigInterface $mockedConfig
         * @var \GuzzleHttp\Client $mockedClient
         * */
        $api = new Lookup($mockedConfig, $mockedClient);

        $requestResult = $api->phoneNumberWithCarrier($this->phone, 'US');

        $this->assertInstanceOf(PhoneNumberResponse::class, $requestResult);
    }

    /** @test */
    public function it_can_handle_404_error_respose()
    {
        $mockedConfig = $this->getMockBuilder(ConfigInterface::class)->getMock();
        $mockedConfig->method('getSid')->willReturn($this->sid);
        $mockedConfig->method('getSecret')->willReturn($this->secret);

        $mockedResponse = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $mockedResponse->method('getStatusCode')->willReturn(200);
        $mockedResponse->method('getBody')
            ->willReturn('{
                "code": 20404,
                "message": "The requested resource /PhoneNumbers/+123456789 was not found",
                "more_info": "https://www.twilio.com/docs/errors/20404",
                "status": 404
            }');

        /** @var \Mockery\MockInterface $mockedClient */
        $mockedClient = \Mockery::mock(\GuzzleHttp\Client::class);
        $mockedClient->shouldReceive('request')->withArgs([
            'GET',
            Lookup::BASE_URL.'PhoneNumbers/+123456789',
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
                    'Type' => 'carrier',
                ],
            ],
        ])->once()->andReturn($mockedResponse);

        /**
         * @var ConfigInterface $mockedConfig
         * @var \GuzzleHttp\Client $mockedClient
         * */
        $api = new Lookup($mockedConfig, $mockedClient);

        $requestResult = $api->phoneNumberWithCarrier($this->phone);

        $this->assertInstanceOf(PhoneNumberResponse::class, $requestResult);
    }
}
