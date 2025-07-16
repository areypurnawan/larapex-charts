<?php

namespace ArielMejiaDev\LarapexCharts\Traits;

trait ComplexChartDataAggregator
{
    public function addData(string $name, array $data): self
    {
        $this->dataset = json_decode($this->dataset);

        $this->dataset[] = [
            'name' => $name,
            'data' => $data,
        ];

        $this->dataset = json_encode($this->dataset);

        return $this;
    }

    public function addDataAreaChart(string $name, array $data, array $categories): self
    {
        $this->dataset = json_decode($this->dataset);

        $this->dataset[] = [
            'name' => $name,
            'data' => $data,
            'categories' => $categories
        ];

        $this->dataset = json_encode($this->dataset);

        return $this;
    }

    public function addDataAreaTraffic(string $name, array $data, array $categories, array $interfaces): self
    {
        $this->dataset = json_decode($this->dataset);

        $this->dataset[] = [
            'name' => $name,
            'data' => $data,
            'categories' => $categories,
            'interfaces' => $interfaces
        ];

        $this->dataset = json_encode($this->dataset);

        return $this;
    }
}
