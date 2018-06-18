<?php

namespace F15DTaboola\Facades\Reports;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \F15DTaboola\Backstage\Reports\TopCampaignContent setStartDate(string $date)
 * @method static \F15DTaboola\Backstage\Reports\TopCampaignContent setEndDate(string $date)
 *
 * Class TopCampaignContent
 * @package F15DTaboola\Facades\Reports
 */
class TopCampaignContent extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'taboolaReportTopCampaignContent';
    }
}