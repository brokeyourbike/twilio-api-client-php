<?php

// Copyright (C) 2021 Ivan Stasiuk <ivan@stasi.uk>.
//
// This Source Code Form is subject to the terms of the Mozilla Public
// License, v. 2.0. If a copy of the MPL was not distributed with this file,
// You can obtain one at https://mozilla.org/MPL/2.0/.

namespace BrokeYourBike\Twilio\Models;

use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\MapFrom;

/**
 * @author Ivan Stasiuk <ivan@stasi.uk>
 */
class CallerName extends DataTransferObject
{
    #[MapFrom('error_code')]
    public ?string $errorCode;

    #[MapFrom('caller_name')]
    public ?string $callerName;

    #[MapFrom('caller_type')]
    public ?string $callerType;
}
