<?php

// Copyright (C) 2021 Ivan Stasiuk <brokeyourbike@gmail.com>.
//
// This Source Code Form is subject to the terms of the Mozilla Public
// License, v. 2.0. If a copy of the MPL was not distributed with this file,
// You can obtain one at https://mozilla.org/MPL/2.0/.

namespace BrokeYourBike\Twilio\Enums;

/**
 * @author Ivan Stasiuk <brokeyourbike@gmail.com>
 *
 * @method static CarrierTypeEnum LANDLINE()
 * @method static CarrierTypeEnum MOBILE()
 * @method static CarrierTypeEnum VOIP()
 * @psalm-immutable
 */
final class CarrierTypeEnum extends \MyCLabs\Enum\Enum
{
    private const LANDLINE = 'landline';
    private const MOBILE = 'mobile';
    private const VOIP = 'voip';
}
