<?php

namespace F15DTaboola;

use F15DTaboola\Backstage\Reports\CampaignSummary;
use F15DTaboola\Backstage\Reports\RecirculationSummary;
use F15DTaboola\Backstage\Reports\TopCampaignContent;
use F15DTaboola\Backstage\Reports\VisitValue;
use Illuminate\Support\ServiceProvider;

class F15DTaboolaProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/taboola.php' => config_path('taboola.php')
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/taboola.php', 'taboola'
        );

        $this->app->bind('taboolaReportCampaignSummary', function () {
            return new CampaignSummary;
        });

        $this->app->bind('taboolaReportRecirculationSummary', function () {
            return new RecirculationSummary;
        });

        $this->app->bind('taboolaReportTopCampaignContent', function () {
            return new TopCampaignContent;
        });

        $this->app->bind('taboolaReportVisitValue', function () {
            return new VisitValue;
        });

    }
}