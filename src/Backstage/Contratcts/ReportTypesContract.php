<?php
namespace F15DTaboola\Backstage\Contracts;

interface ReportTypesContract
{
    public function setStartDate(string $date);
    public function setEndDate(string $date);
    function run($name, $args);
    function resultTransformer($data, bool $isJson = true);
}