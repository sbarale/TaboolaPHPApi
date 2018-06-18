<?php

namespace F15DTaboola\Backstage\Reports;

use F15DTaboola\Backstage\Contracts\ReportTypesContract;

/**
 * @method itemBreakdown(array $filters = [])
 *
 * Class TopCampaignContent
 * @package F15DTaboola\Backstage\Reports
 */
class TopCampaignContent extends BaseReports implements ReportTypesContract
{
    protected $dimensions = [
        'item_breakdown' => [
            'columns' => [
                'platform',
                'platform_name',
            ],
            'mandatoryFilters' => [
                'start_date',
                'end_date',
            ],
            'optionalFilters' => [
                'campaign',
            ]
        ],
    ];

    /**
     * @param $name
     * @param $args
     * @return mixed
     * @throws \Exception
     */
    function run($name, $args)
    {
        $uri = 'top-campaign-content/dimensions/'.$name;

        $args = $this->checkMandatoryFilters($args[0] ?? []);

        $content = $this->http->get($uri,['query' => $args])->getBody()->getContents();

        return $this->resultTransformer($content);
    }

    function resultTransformer($data, bool $isJson = true)
    {
        if($isJson) {
            $data = json_decode($data,true);
        }

        $data['results'] = collect($data['results']);

        return $data;
    }

}