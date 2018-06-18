<?php

namespace F15DTaboola\Facades\Reports;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \F15DTaboola\Backstage\Reports\RecirculationSummary setStartDate(string $date)
 * @method static \F15DTaboola\Backstage\Reports\RecirculationSummary setEndDate(string $date)
 *
 * Class RecirculationSummary
 * @package F15DTaboola\Facades\Reports
 */
class RecirculationSummary extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'taboolaReportRecirculationSummary';
    }
}