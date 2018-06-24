<?php

namespace F15DTaboola\Backstage\Reports;

use F15DTaboola\Backstage\Base;
use Illuminate\Support\Facades\Log;

class BaseReports extends Base
{
    protected $mandatoryFilters = [
        'start_date' => null,
        'end_date' => null,
    ];

    protected $dimensions = [];

    public function __construct()
    {
        parent::__construct('reports');
    }

    public function setStartDate($date)
    {
        $this->mandatoryFilters['start_date'] = $date;
        return $this;
    }

    public function setEndDate($date)
    {
        $this->mandatoryFilters['end_date'] = $date;
        return $this;
    }

    /**
     * @param $data
     * @return array
     * @throws \Exception
     */
    protected function checkMandatoryFilters($data)
    {
        if(!$this->mandatoryFilters['start_date']) {
            throw new \Exception('[F15D Taboola] Mandatory filter "start_date" is required in '.get_class($this));
        }

        if(!$this->mandatoryFilters['end_date']) {
            throw new \Exception('[F15D Taboola] Mandatory filter "end_date" is required in '.get_class($this));
        }

        return array_merge($this->mandatoryFilters, $data);
    }

    /**
     * @param $name
     * @param $arguments
     * @return string
     * @throws \Exception
     */
    public function __call($name, $arguments)
    {
        $name = snake_case($name);

        $dimensions = array_keys($this->dimensions);

        if(in_array($name,$dimensions)) {
            return $this->run($name,$arguments);
        }
    }
}