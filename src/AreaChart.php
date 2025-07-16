<?php

namespace ArielMejiaDev\LarapexCharts;

use ArielMejiaDev\LarapexCharts\Contracts\MustAddComplexData;
use ArielMejiaDev\LarapexCharts\Traits\ComplexChartDataAggregator;

class AreaChart extends LarapexChart implements MustAddComplexData
{
    use ComplexChartDataAggregator;

    public function __construct()
    {
        parent::__construct();
        $this->type = 'area';
    }

    public function addArea(string $name, array $data): AreaChart
    {
        return $this->addData($name, $data);
    }

    public function addAreaTraffic(string $name, array $data, array $categories, array $interfaces): AreaChart
    {
        return $this->addDataAreaTraffic($name, $data, $categories, $interfaces);
    }
}
