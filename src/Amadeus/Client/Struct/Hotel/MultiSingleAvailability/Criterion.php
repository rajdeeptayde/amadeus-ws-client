<?php
/**
 * amadeus-ws-client
 *
 * Copyright 2015 Amadeus Benelux NV
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @package Amadeus
 * @license https://opensource.org/licenses/Apache-2.0 Apache 2.0
 */

namespace Amadeus\Client\Struct\Hotel\MultiSingleAvailability;

use Amadeus\Client\RequestOptions\Hotel\MultiSingleAvail\Criteria;

/**
 * Criterion
 *
 * @package Amadeus\Client\Struct\Hotel\MultiSingleAvailability
 * @author Dieter Devlieghere <dieter.devlieghere@benelux.amadeus.com>
 */
class Criterion extends HotelSearchCriterionType
{
    /***
     * @var string
     */
    public $AlternateAvailability;

    public $AddressSearchScope;

    public $InfoSource;

    public $MoreDataEchoToken;

    /**
     * Criterion constructor.
     *
     * @param Criteria $criterion
     */
    public function __construct(Criteria $criterion)
    {
        $this->ExactMatch = $criterion->exactMatch;
        $this->Radius = $criterion->Radius;
        $this->Criterion = $criterion;
        if(isset($criterion->Position))
            $this->Position=$criterion->Position;
        foreach ($criterion->hotelReferences as $hotelReference) {
            $this->HotelRef[] = new HotelRef($hotelReference);
        }
        if (isset($criterion->stayStart))
            $this->StayDateRange = new StayDateRange($criterion->stayStart, $criterion->stayEnd);

        foreach ($criterion->rates as $rate) {
            $this->RateRange[] = new RateRange($rate);
        }

        if (!empty($criterion->rooms)) {
            $this->RoomStayCandidates = new RoomStayCandidates();

            foreach ($criterion->rooms as $room) {
                $this->RoomStayCandidates->RoomStayCandidate[] = new RoomStayCandidate($room);
            }
        }

        $this->AlternateAvailability = $criterion->alternateAvailability;
    }
}