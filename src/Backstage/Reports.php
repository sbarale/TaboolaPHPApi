<?php

namespace F15DTaboola\Backstage;

use Carbon\Carbon;

/**
 * @method campaignSummary
 * @method topCampaignContent
 * @method revenueSummary
 * @method visitValue
 *
 * Class Reports
 * @package F15DTaboola\Backstage
 */
class Reports extends Base
{
    protected $types = [
        'campaign-',
        'top-campaign-content',
        'revenue-summary',
        'visit-value'
    ];

    public function __construct()
    {
        parent::__construct('reports');
    }

    /**
     * @param $type
     * @param $argments
     * @return string
     * @throws \Exception
     */
    protected function run($type, $argments)
    {
        $uri = $type;

        $dimension = $argments[0];

        $uri .= '/dimensions/'.$dimension;

        if(!isset($argments[1])) {
            throw new \Exception('');
        }

        $args = $argments[1];

        $content = $this->http->get($uri,['query' => $args])->getBody()->getContents();
        return $this->resultTransformer($content);
    }

    private function resultTransformer($data, bool $isJson = true)
    {
        if($isJson) {
            $data = json_decode($data,true);
        }

        $data['results'] = collect($data['results']);

        return $data;
    }

    public function __call($name, $arguments)
    {
        $name = kebab_case($name);

        $dimensions = $this->types;

        if(in_array($name,$dimensions)) {
            return $this->run($name,$arguments);
        }
    }
}