<?php
namespace F15DTaboola\Backstage\Contracts;

interface ReportTypesContract
{
    public function setStartDate($date);
    public function setEndDate($date);
    function run($name, $args);
    function resultTransformer($data, bool $isJson);
}