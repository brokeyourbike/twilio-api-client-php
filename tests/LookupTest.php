<?php

// Copyright (C) 2021 Ivan Stasiuk <ivan@stasi.uk>.
//
// This Source Code Form is subject to the terms of the Mozilla Public
// License, v. 2.0. If a copy of the MPL was not distributed with this file,
// You can obtain one at https://mozilla.org/MPL/2.0/.

namespace BrokeYourBike\Twilio\Tests;

use PHPUnit\Framework\TestCase;
use BrokeYourBike\Twilio\V1\Lookup;
use BrokeYourBike\Twilio\Interfaces\ConfigInterface;
use BrokeYourBike\ResolveUri\ResolveUriTrait;
use BrokeYourBike\HttpClient\HttpClientTrait;
use BrokeYourBike\HttpClient\HttpClientInterface;

/**
 * @author Ivan Stasiuk <ivan@stasi.uk>
 */
class LookupTest extends TestCase
{
    /** @test */
    public function it_implemets_http_client_interface(): void
    {
        /** @var ConfigInterface */
        $mockedConfig = $this->getMockBuilder(ConfigInterface::class)->getMock();

        /** @var \GuzzleHttp\ClientInterface */
        $mockedHttpClient = $this->getMockBuilder(\GuzzleHttp\ClientInterface::class)->getMock();

        /** @var \Psr\SimpleCache\CacheInterface */
        $mockedCache = $this->getMockBuilder(\Psr\SimpleCache\CacheInterface::class)->getMock();

        $api = new Lookup($mockedConfig, $mockedHttpClient, $mockedCache);

        $this->assertInstanceOf(HttpClientInterface::class, $api);
    }

    /** @test */
    public function it_uses_http_client_trait(): void
    {
        $usedTraits = class_uses(Lookup::class);

        $this->assertArrayHasKey(HttpClientTrait::class, $usedTraits);
    }

    /** @test */
    public function it_uses_resolve_uri_trait(): void
    {
        $usedTraits = class_uses(Lookup::class);

        $this->assertArrayHasKey(ResolveUriTrait::class, $usedTraits);
    }
}
