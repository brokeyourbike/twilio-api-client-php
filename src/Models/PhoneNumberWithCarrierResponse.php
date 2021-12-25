<?php

// Copyright (C) 2021 Ivan Stasiuk <ivan@stasi.uk>.
//
// This Source Code Form is subject to the terms of the Mozilla Public
// License, v. 2.0. If a copy of the MPL was not distributed with this file,
// You can obtain one at https://mozilla.org/MPL/2.0/.

namespace BrokeYourBike\Twilio\Models;

use Spatie\DataTransferObject\Attributes\MapFrom;
use BrokeYourBike\Twilio\Models\Carrier;
use BrokeYourBike\DataTransferObject\JsonResponse;

/**
 * @author Ivan Stasiuk <ivan@stasi.uk>
 */
class PhoneNumberWithCarrierResponse extends JsonResponse
{
    public Carrier $carrier;

    #[MapFrom('country_code')]
    public string $countryCode;

    #[MapFrom('national_format')]
    public string $nationalFormat;

    #[MapFrom('phone_number')]
    public string $phoneNumber;

    public string $url;
}
