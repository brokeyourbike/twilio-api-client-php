<?php

// Copyright (C) 2021 Ivan Stasiuk <ivan@stasi.uk>.
//
// This Source Code Form is subject to the terms of the Mozilla Public
// License, v. 2.0. If a copy of the MPL was not distributed with this file,
// You can obtain one at https://mozilla.org/MPL/2.0/.

namespace BrokeYourBike\Twilio\Models;

use BrokeYourBike\Twilio\Options;

/**
 * @author Ivan Stasiuk <ivan@stasi.uk>
 */
class PhoneNumberOptions extends Options
{
    public function setCountryCode(string $countryCode): self
    {
        $this->options['countryCode'] = $countryCode;
        return $this;
    }

    public function setType(string $type): self
    {
        $this->options['type'] = $type;
        return $this;
    }
}
