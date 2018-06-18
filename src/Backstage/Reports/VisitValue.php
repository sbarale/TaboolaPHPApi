<?php

namespace F15DTaboola\Backstage\Reports;

use F15DTaboola\Backstage\Contracts\ReportTypesContract;

/**
 * @method day(array $filters = [])
 * @method week(array $filters = [])
 * @method month(array $filters = [])
 * @method byReferral(array $filters = [])
 * @method landingPageBreakdown(array $filters = [])
 * @method platformBreakdown(array $filters = [])
 * @method countryBreakdown(array $filters = [])
 * @method pageTypeBreakdown(array $filters = [])
 * @method dayReferralLandingPageBreakdown(array $filters = [])
 * @method bySourceMedium(array $filters = [])
 * @method byCampaign(array $filters = [])
 * @method byCustomTrackingCode(array $filters = [])
 * @method byReferralAndTrackingCode(array $filters = [])
 *
 * Class VisitValue
 * @package F15DTaboola\Backstage\Reports
 */
class VisitValue extends BaseReports implements ReportTypesContract
{
    protected $optionalFilters = [
        'campaign',
        'platform',
        'country',
        'site',
        'partner_name',
    ];

    protected $dimensions = [
        'day' => [
            'columns' => [
                'date'
            ],
            'mandatoryFilters' => [
                'start_date',
                'end_date',
            ]
        ],
        'week' => [
            'columns' => [
                'date',
                'date_end_period',
            ],
            'mandatoryFilters' => [
                'start_date',
                'end_date',
            ]
        ],
        'month' => [
            'columns' => [
                'date',
                'date_end_period',
            ],
            'mandatoryFilters' => [
                'start_date',
                'end_date',
            ]
        ],
        'by_referral' => [
            'columns' => [
                'content_provider',
                'content_provider_name',
                'content_num',
            ],
            'mandatoryFilters' => [
                'start_date',
                'end_date',
            ]
        ],
        'landing_page_breakdown' => [
            'columns' => [
                'campaign',
                'campaign_name',
            ],
            'mandatoryFilters' => [
                'start_date',
                'end_date',
            ],
            'optionalFilters' => [
                'platform',
                'country',
                'site',
            ]
        ],
        'platform_breakdown' => [
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
        'country_breakdown' => [
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
        'page_type_breakdown' => [
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
        'day_referral_landing_page_breakdown' => [
            'columns' => [
                'date',
                'campaign',
                'campaign_name',
            ],
            'mandatoryFilters' => [
                'start_date',
                'end_date',
            ],
            'optionalFilters' => [
                'platform',
                'country',
                'site',
            ]
        ],
        'by_source_medium' => [
            'columns' => [
                'date',
                'campaign',
                'campaign_name',
            ],
            'mandatoryFilters' => [
                'start_date',
                'end_date',
            ],
            'optionalFilters' => [
                'platform',
                'country',
                'site',
            ]
        ],
        'by_campaign' => [
            'columns' => [
                'date',
                'campaign',
                'campaign_name',
            ],
            'mandatoryFilters' => [
                'start_date',
                'end_date',
            ],
            'optionalFilters' => [
                'platform',
                'country',
                'site',
            ]
        ],
        'by_custom_tracking_code' => [
            'columns' => [
                'date',
                'campaign',
                'campaign_name',
            ],
            'mandatoryFilters' => [
                'start_date',
                'end_date',
            ],
            'optionalFilters' => [
                'platform',
                'country',
                'site',
            ]
        ],
        'by_referral_and_tracking_code' => [
            'columns' => [
                'date',
                'campaign',
                'campaign_name',
            ],
            'mandatoryFilters' => [
                'start_date',
                'end_date',
            ],
            'optionalFilters' => [
                'platform',
                'country',
                'site',
            ]
        ]
    ];

    /**
     * @param $name
     * @param $args
     * @return mixed
     * @throws \Exception
     */
    function run($name, $args)
    {
        $uri = 'visit-value/dimensions/'.$name;

        $args = $this->checkMandatoryFilters($args[0] ?? []);

        $content = $this->http->get($uri,['query' => $args])->getBody()->getContents();

        return $this->resultTransformer($content);
    }

    /**
     * @param $data
     * @param bool $isJson
     * @return mixed
     */
    function resultTransformer($data, bool $isJson = true)
    {
        if($isJson) {
            $data = json_decode($data,true);
        }

        $data['results'] = collect($data['results']);

        return $data;
    }

}