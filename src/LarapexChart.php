<?php

namespace ArielMejiaDev\LarapexCharts;

use Illuminate\Support\Facades\View;

class LarapexChart
{
    /*
    |--------------------------------------------------------------------------
    | Chart
    |--------------------------------------------------------------------------
    |
    | This class build the chart by passing setters to the object, it will 
    | use the method container and scripts to generate a JSON  
    | in blade views, it works also with Vue JS components  
    |
    */

    public $id;
    protected $title;
    protected $subtitle;
    protected $subtitlePosition;
    protected $type = 'donut';
    protected $labels;
    protected $fontFamily;
    protected $dataset;
    protected $height = 500;
    protected $width;
    protected $colors;
    protected $horizontal;
    protected $xAxis;
    protected $formatter;
    protected $grid;
    protected $fill;
    protected $markers;
    protected $stroke;
    protected $toolbar;
    protected $zoom;
    protected $dataLabels;
    private $chartLetters = 'abcdefghijklmnopqrstuvwxyz';

    /*
    |--------------------------------------------------------------------------
    | Constructors
    |--------------------------------------------------------------------------
    */

    public function __construct()
    {
        $this->id = substr(str_shuffle(str_repeat($x = $this->chartLetters, ceil(25 / strlen($x)))), 1, 25);
        $this->horizontal = json_encode(['horizontal' => false]);
        $this->colors = json_encode(config('larapex-charts.colors'));
        $this->setXAxis([]);
        $this->grid = json_encode(['show' => false]);
        $this->stroke = json_encode(['show' => true]);
        $this->fill = json_encode(['color' => 'undefined']);
        $this->markers = json_encode(['show' => false]);
        $this->toolbar = json_encode(['show' => false]);
        $this->zoom = json_encode(['enabled' => true]);
        $this->dataLabels = json_encode(['enabled' => false]);
        return $this;
    }

    public function pieChart(): PieChart
    {
        return new PieChart();
    }

    public function donutChart(): DonutChart
    {
        return new DonutChart();
    }

    public function radialChart(): RadialChart
    {
        return new RadialChart();
    }

    public function polarAreaChart(): PolarAreaChart
    {
        return new PolarAreaChart();
    }

    public function lineChart(): LineChart
    {
        return new LineChart();
    }

    public function areaChart(): AreaChart
    {
        return new AreaChart();
    }

    public function barChart(): BarChart
    {
        return new BarChart();
    }

    public function horizontalBarChart(): HorizontalBar
    {
        return new HorizontalBar();
    }

    public function heatMapChart(): HeatMapChart
    {
        return new HeatMapChart();
    }

    public function radarChart(): RadarChart
    {
        return new RadarChart();
    }

    /*
    |--------------------------------------------------------------------------
    | Setters
    |--------------------------------------------------------------------------
    */
    //  public function addData(string $name, array $data)
    //  {
    //      (new AreaChart())->addArea($name, $data);
    //      return $this;
    //  }

    public function addDataAreaTraffic(string $name, array $data, array $categories, array $interfaces)
    {
        (new AreaChart())->addAreaTraffic($name, $data, $categories, $interfaces);
        return $this;
    }
    /**
     *
     * @deprecated deprecated since version 2.0
     * @param null $type
     * @return $this
     */
    public function setType($type = null): LarapexChart
    {
        $this->type = $type;
        return $this;
    }

    public function setFontFamily($fontFamily): LarapexChart
    {
        $this->fontFamily = $fontFamily;
        return $this;
    }

    public function setDataset($dataset): LarapexChart
    {
        $this->dataset = json_encode($dataset);
        return $this;
    }

    public function setHeight(int $height): LarapexChart
    {
        $this->height = $height;
        return $this;
    }

    public function setWidth(int $width): LarapexChart
    {
        $this->width = $width;
        return $this;
    }

    public function setColors(array $colors): LarapexChart
    {
        $this->colors = json_encode($colors);
        return $this;
    }

    public function setHorizontal(bool $horizontal): LarapexChart
    {
        $this->horizontal = json_encode(['horizontal' => $horizontal]);
        return $this;
    }

    public function setTitle(string $title): LarapexChart
    {
        $this->title = $title;
        return $this;
    }

    public function setSubtitle(string $subtitle, string $position = 'left'): LarapexChart
    {
        $this->subtitle = $subtitle;
        $this->subtitlePosition = $position;
        return $this;
    }

    public function setLabels(array $labels): LarapexChart
    {
        $this->labels = $labels;
        return $this;
    }

    public function setXAxis(array $categories): LarapexChart
    {
        $this->xAxis = json_encode($categories);
        return $this;
    }
    public function setFormatter(string $formatter): LarapexChart
    {
        $this->formatter = $formatter;
        return $this;
    }

    public function setGrid($transparent = true, $color = '#e5e5e5', $opacity = 0.1): LarapexChart
    {
        if ($transparent) {
            $this->grid = json_encode(['show' => true]);
            return $this;
        }

        $this->grid = json_encode([
            'row' => [
                'colors' => [$color, 'transparent'],
                'opacity' => $opacity ? $opacity : 0.5
            ],
            'column' => [
                'colors' => [$color, 'transparent'],
                'opacity' => '0.5'
            ],
            'xaxis' => [
                'lines' => [
                    'show' => true
                ]
            ],
            'yaxis' => [
                'lines' => [
                    'show' => true
                ]
            ],
        ]);

        return $this;
    }

    public function setMarkers($colors = [], $width = 4, $hoverSize = 7): LarapexChart
    {
        if (empty($colors)) {
            $colors = config('larapex-charts.colors');
        }

        $this->markers = json_encode([
            'size' => $width,
            'colors' => $colors,
            'strokeColors' => "#fff",
            'strokeWidth' => $width / 2,
            'hover' => [
                'size' => $hoverSize,
            ]
        ]);

        return $this;
    }

    public function setFill($fill): LarapexChart
    {


        $this->fill = json_encode([
            'type' => $fill,

            'gradient' => [

                'inverseColors' => false,
                'opacityFrom' => 0.7,
                'opacityTo' => 0,
                'stops' => [5, 90, 100],
            ],

        ]);

        return $this;
    }

    public function setStroke(int $width, array $colors = [], string $curve = 'smooth'): LarapexChart
    {

        if (empty($colors)) {
            $colors = config('larapex-charts.colors');
        }

        $this->stroke = json_encode([
            'show'    =>  true,
            'width'   =>  $width,
            'colors'  =>  $colors,
            'curve' => $curve
        ]);


        return $this;
    }

    public function setToolbar(bool $show, bool $zoom = true): LarapexChart
    {
        $this->toolbar = json_encode(['show' => $show]);
        $this->zoom = json_encode(['enabled' => $zoom ? $zoom : false]);
        return $this;
    }

    public function setDataLabels(bool $enabled = true): LarapexChart
    {
        $this->dataLabels = json_encode(['enabled' => $enabled]);
        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    | Getters
    |--------------------------------------------------------------------------
    */

    /**
     * @param array $array
     * @return array|false|string
     */
    public function transformLabels(array $array)
    {
        $stringArray = array_filter($array, function ($string) {
            return "{$string}";
        });
        return json_encode(['"' . implode('","', $stringArray) . '"']);
    }

    /**
     * @return mixed
     */
    public function container()
    {
        return View::make('larapex-charts::chart.container', ['id' => $this->id()]);
    }

    /**
     * @return mixed
     */
    public function script()
    {
        return View::make('larapex-charts::chart.script', ['chart' => $this]);
    }

    public function scriptTraffic()
    {
        return View::make('larapex-charts::chart.script-traffic', ['chart' => $this]);
    }

    public static function cdn(): string
    {
        return 'https://cdn.jsdelivr.net/npm/apexcharts';
    }

    /**
     * @return false|string
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function title()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function subtitle()
    {
        return $this->subtitle;
    }

    /**
     * @return mixed
     */
    public function subtitlePosition()
    {
        return $this->subtitlePosition;
    }

    /**
     * @return string
     */
    public function type()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function fontFamily()
    {
        return $this->fontFamily;
    }

    /**
     * @return mixed
     */
    public function labels()
    {
        return $this->labels;
    }

    public function formatter()
    {
        return $this->formatter;
    }

    /**
     * @return mixed
     */
    public function dataset()
    {
        return $this->dataset;
    }

    /**
     * @return int
     */
    public function height(): int
    {
        return $this->height;
    }

    public function width(): string
    {
        return $this->width ? $this->width : '100%';
    }

    /**
     * @return false|string
     */
    public function colors()
    {
        return $this->colors;
    }

    /**
     * @return false|string
     */
    public function horizontal()
    {
        return $this->horizontal;
    }

    /**
     * @return mixed
     */
    public function xAxis()
    {
        return $this->xAxis;
    }

    /**
     * @return false|string
     */
    public function grid()
    {
        return $this->grid;
    }

    /**
     * @return false|string
     */
    public function markers()
    {
        return $this->markers;
    }

    public function fill()
    {
        return $this->fill;
    }


    /**
     * @return mixed
     */
    public function stroke()
    {
        return $this->stroke;
    }

    /**
     * @return true|boolean
     */
    public function toolbar()
    {
        return $this->toolbar;
    }

    /**
     * @return true|boolean
     */
    public function zoom()
    {
        return $this->zoom;
    }

    /**
     * @return true|boolean
     */
    public function dataLabels()
    {
        return $this->dataLabels;
    }

    /*
    |--------------------------------------------------------------------------
    | JSON Helper
    |--------------------------------------------------------------------------
    */

    public function toJson()
    {
        $options = [
            'chart' => [
                'type' => $this->type(),
                'height' => $this->height(),
                'width' => $this->width(),
                'fontFamily' => $this->fontFamily(),
                'toolbar' => json_decode($this->toolbar()),
                'zoom' => json_decode($this->zoom()),
            ],
            'plotOptions' => [
                'bar' => json_decode($this->horizontal()),
            ],
            'colors' => json_decode($this->colors()),
            'series' => json_decode($this->dataset()),
            'dataLabels' => json_decode($this->dataLabels()),
            'title' => [
                'text' => $this->title()
            ],
            'subtitle' => [
                'text' => $this->subtitle() ? $this->subtitle() : '',
                'align' => $this->subtitlePosition() ? $this->subtitlePosition() : '',
            ],
            'xaxis' => [
                'categories' => json_decode($this->xAxis()),
            ],
            'yaxis' => [
                'labels' => [],
            ],
            'grid' => json_decode($this->grid()),
            'markers' => json_decode($this->markers()),
        ];


        if ($this->labels()) {
            $options['labels'] = $this->labels();
        }

        if ($this->stroke()) {
            $options['stroke'] = json_decode($this->stroke());
        }

        return (response()->json([
            'id' => $this->id(),
            'options' => $options,
        ]));
    }

    public function toVue(): array
    {
        $options = [
            'chart' => [
                'height' => $this->height(),
                'toolbar' => json_decode($this->toolbar()),
                'fontFamily' => $this->fontFamily(),
                'zoom' => json_decode($this->zoom()),
            ],
            'plotOptions' => [
                'bar' => json_decode($this->horizontal()),
            ],
            'colors' => json_decode($this->colors()),
            'dataLabels' => json_decode($this->dataLabels()),
            'title' => [
                'text' => $this->title()
            ],
            'subtitle' => [
                'text' => $this->subtitle() ? $this->subtitle() : '',
                'align' => $this->subtitlePosition() ? $this->subtitlePosition() : '',
            ],
            'xaxis' => [
                'categories' => json_decode($this->xAxis()),
            ],
            'grid' => json_decode($this->grid()),
            'markers' => json_decode($this->markers()),
        ];

        if ($this->labels()) {
            $options['labels'] = $this->labels();
        }

        if ($this->stroke()) {
            $options['stroke'] = json_decode($this->stroke());
        }

        return [
            'height' => $this->height(),
            'width' => $this->width(),
            'type' => $this->type(),
            'options' => $options,
            'series' => json_decode($this->dataset()),
        ];
    }
}
