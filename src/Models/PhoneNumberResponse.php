<?php

// Copyright (C) 2021 Ivan Stasiuk <brokeyourbike@gmail.com>.
//
// This Source Code Form is subject to the terms of the Mozilla Public
// License, v. 2.0. If a copy of the MPL was not distributed with this file,
// You can obtain one at https://mozilla.org/MPL/2.0/.

namespace BrokeYourBike\Twilio\Models;

use Spatie\DataTransferObject\Attributes\MapFrom;
use BrokeYourBike\Twilio\Models\Carrier;
use BrokeYourBike\Twilio\Models\CallerName;
use BrokeYourBike\DataTransferObject\JsonResponse;

/**
 * @author Ivan Stasiuk <brokeyourbike@gmail.com>
 */
class PhoneNumberResponse extends JsonResponse
{
    #[MapFrom('caller_name')]
    public CallerName|null $callerName;

    public Carrier|null $carrier;

    #[MapFrom('country_code')]
    public string $countryCode;

    #[MapFrom('national_format')]
    public string $nationalFormat;

    #[MapFrom('phone_number')]
    public string $phoneNumber;

    public string $url;
}
