<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 8/29/18
 * Time: 10:03 AM
 */

include "../vendor/autoload.php";

use F15DTaboola\Backstage\Reports\CampaignSummary;

$camps = CampaignSummary::with([])
                        ->setStartDate(Carbon::now()->toDateString())
                        ->setEndDate(Carbon::now()->toDateString())
                        ->campaignBreakdown([]);