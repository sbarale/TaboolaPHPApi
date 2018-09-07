<?php

namespace F15DTaboola\Backstage;

use Carbon\Carbon;

/**
 * @method campaignSummary
 * @method topCampaignContent
 * @method revenueSummary
 * @method visitValue
 *
 * Class Campaigns
 *
 * @package F15DTaboola\Backstage
 */
class Campaigns extends Base {
	protected $types = [
		'campaigns',
	];

	public function __construct() {
		parent::__construct( '' );
	}

	/**
	 * @param $type
	 * @param $argments
	 *
	 * @return string
	 * @throws \Exception
	 */
	protected function run( $type, $argments ) {
		$uri = $type;

		$dimension = $argments[0];

		$uri .= '/' . $dimension;

		if ( ! isset( $argments[1] ) ) {
			throw new \Exception( '' );
		}

		$args = $argments[1];

		$content = $this->http->get( $uri, [ 'query' => $args ] )->getBody()->getContents();

		return $this->resultTransformer( $content );
	}

	private function resultTransformer( $data, bool $isJson = true ) {
		if ( $isJson ) {
			$data = json_decode( $data, true );
		}

		$data['results'] = collect( $data['results'] );

		return $data;
	}

	public function __call( $name, $arguments ) {
		$name = kebab_case( $name );

		$dimensions = $this->types;

		if ( in_array( $name, $dimensions ) ) {
			return $this->run( $name, $arguments );
		}
	}
}