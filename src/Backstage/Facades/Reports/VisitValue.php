<?php

namespace F15DTaboola\Facades\Reports;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \F15DTaboola\Backstage\Reports\VisitValue setStartDate(string $date)
 * @method static \F15DTaboola\Backstage\Reports\VisitValue setEndDate(string $date)
 *
 * Class VisitValue
 * @package F15DTaboola\Facades\Reports
 */
class VisitValue extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'taboolaReportVisitValue';
    }
}