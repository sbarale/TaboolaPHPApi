<?php

namespace F15DTaboola\Facades\Reports;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \F15DTaboola\Backstage\Reports\CampaignSummary setStartDate(string $date)
 * @method static \F15DTaboola\Backstage\Reports\CampaignSummary setEndDate(string $date)
 *
 * Class CampaignSummary
 * @package F15DTaboola\Facades\Reports
 */
class CampaignSummary extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'taboolaReportCampaignSummary';
    }
}