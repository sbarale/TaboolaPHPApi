<?php

namespace F15DTaboola\Facades\Reports;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \F15DTaboola\Backstage\Reports\VisitValue setStartDate(string $date)
 * @method static \F15DTaboola\Backstage\Reports\VisitValue setEndDate(string $date)
 *
 * Class Campaigns
 * @package F15DTaboola\Facades\Reports
 */
class Campaigns extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'campaigns';
    }
}