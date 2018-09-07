<?php

namespace F15DTaboola\Backstage\Reports;

use F15DTaboola\Backstage\Contracts\ReportTypesContract;

class CampaignSummary extends BaseReports implements ReportTypesContract {
	protected $mandatoryFilters = [
		'start_date' => '',
		'end_date'   => '',
	];

	protected $optionalFilters = [
		'campaign',
		'platform',
		'country',
		'site',
		'partner_name',
	];

	protected $dimensions = [
		'day'                         => [
			'columns'          => [
				'date',
			],
			'mandatoryFilters' => [
				'start_date',
				'end_date',
			],
			'optionalFilters'  => [
				'campaign',
				'platform',
				'country',
				'site',
			],
		],
		'week'                        => [
			'columns'          => [
				'date',
				'date_end_period',
			],
			'mandatoryFilters' => [
				'start_date',
				'end_date',
			],
			'optionalFilters'  => [
				'campaign',
				'platform',
				'country',
				'site',
			],
		],
		'month'                       => [
			'columns'          => [
				'date',
				'date_end_period',
			],
			'mandatoryFilters' => [
				'start_date',
				'end_date',
			],
			'optionalFilters'  => [
				'campaign',
				'platform',
				'country',
				'site',
			],
		],
		'content_provider_breakdown'  => [
			'columns'          => [
				'content_provider',
				'content_provider_name',
				'content_num',
			],
			'mandatoryFilters' => [
				'start_date',
				'end_date',
			],
			'optionalFilters'  => [
				'platform',
				'country',
				'site',
			],
		],
		'campaign_breakdown'          => [
			'columns'          => [
				'campaign',
				'campaign_name',
			],
			'mandatoryFilters' => [
				'start_date',
				'end_date',
			],
			'optionalFilters'  => [
				'platform',
				'country',
				'site',
			],
		],
		'site_breakdown'              => [
			'columns'          => [
				'site',
				'site_name',
				'blocking_level',
			],
			'mandatoryFilters' => [
				'start_date',
				'end_date',
			],
			'optionalFilters'  => [
				'campaign',
			],
		],
		'country_breakdown'           => [
			'columns'          => [
				'country',
				'country_name',
			],
			'mandatoryFilters' => [
				'start_date',
				'end_date',
			],
			'optionalFilters'  => [
				'campaign',
			],
		],
		'platform_breakdown'          => [
			'columns'          => [
				'platform',
				'platform_name',
			],
			'mandatoryFilters' => [
				'start_date',
				'end_date',
			],
			'optionalFilters'  => [
				'campaign',
			],
		],
		'campaign_day_breakdown'      => [
			'columns'          => [
				'date',
				'campaign',
				'campaign_name',
			],
			'mandatoryFilters' => [
				'start_date',
				'end_date',
			],
			'optionalFilters'  => [
				'platform',
				'country',
				'site',
			],
		],
		'campaign_site_day_breakdown' => [
			'columns'          => [
				'date',
				'campaign',
				'campaign_name',
				'site',
				'site_name',
			],
			'mandatoryFilters' => [
				'start_date',
				'end_date',
			],
			'optionalFilters'  => [
				'include_multi_conversions',
			],
		],
		'user_segment_breakdown'      => [
			'columns'          => [
				'date',
				'campaign',
				'campaign_name',
				'site',
				'site_name',
			],
			'mandatoryFilters' => [
				'start_date',
				'end_date',
			],
			'optionalFilters'  => [
				'campaign',
				'platform',
				'country',
				'partner_name',
			],
		],
	];

	/**
	 * @param $name
	 * @param $args
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	function run( $name, $args ) {
		$uri = 'campaign-summary/dimensions/' . $name;

		$args = $this->checkMandatoryFilters( $args ?? [] );

		$content = $this->http->get( $uri, [ 'query' => $args ] )->getBody()->getContents();

		return $this->resultTransformer( $content );
	}

	function resultTransformer( $data, bool $isJson = true ) {
		if ( $isJson ) {
			$data = json_decode( $data, true );
		}

		$data['results'] = collect( $data['results'] );

		return $data;
	}

}