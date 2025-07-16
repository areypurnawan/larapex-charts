<script data-navigated>
    console.log('navigated1');
    var options = {
        chart: {
            type: '{!! $chart->type() !!}',
            height: {!! $chart->height() !!},
            width: '{!! $chart->width() !!}',
            toolbar: {!! $chart->toolbar() !!},
            zoom: {!! $chart->zoom() !!}
        },
        plotOptions: {
            bar: {!! $chart->horizontal() !!}
        },
        colors: {!! $chart->colors() !!},
        series: {!! $chart->dataset() !!},
        dataLabels: {!! $chart->dataLabels() !!},
        @if ($chart->labels())
            labels: {!! json_encode($chart->labels(), true) !!},
        @endif
        {!! $chart->formatter() !!}
        title: {
            text: "{!! $chart->title() !!}"
        },
        subtitle: {
            text: '{!! $chart->subtitle() !!}',
            align: '{!! $chart->subtitlePosition() !!}'
        },
        xaxis: {

            categories: {!! $chart->xAxis() !!}
        },



        yaxis: {
            labels: {
                {!! $chart->formatter() !!}
            },
        },

        grid: {
            show: true,
            borderColor: '#e5e5e5',
            strokeDashArray: 0,
            position: 'back',
            xaxis: {
                lines: {
                    show: true
                }
            },
            yaxis: {
                lines: {
                    show: true
                }
            },
            row: {
                colors: undefined,
                opacity: 0.5
            },
            column: {
                colors: undefined,
                opacity: 0.5
            },

        },

        markers: {!! $chart->markers() !!},

        stroke: {!! $chart->stroke() !!},

        tooltip: {
            shared: true,
            intersect: false,
            y: [{
                formatter: function(value) {
                    const sizes = ['bps', 'kbps', 'Mbps', 'Gbps', 'Tbps'];
                    if (value === 0) return '0 bps';
                    const i = parseInt(Math.floor(Math.log(value) / Math.log(1024)));
                    return parseFloat((value / Math.pow(1024, i)).toFixed(2)) + ' ' + sizes[
                        i];
                },
            }, {
                formatter: function(value) {
                    const sizes = ['bps', 'kbps', 'Mbps', 'Gbps', 'Tbps'];
                    if (value === 0) return '0 bps';
                    const i = parseInt(Math.floor(Math.log(value) / Math.log(1024)));
                    return parseFloat((value / Math.pow(1024, i)).toFixed(2)) + ' ' + sizes[
                        i];
                },
            }],

            custom: function({
                series,
                seriesIndex,
                dataPointIndex,
                w
            }) {
                return (
                    '<div class="">' +
                    '<div >' +
                    '<div class="bg-gray-400 px-4 py-1"><span>' + w.config.series[0].categories[
                        dataPointIndex] + '</span> <br />' +
                    "</div>" +
                    '<div class="px-4 py-1">' +
                    '<div>Interface: ' +
                    w.config.series[0].interfaces[dataPointIndex] +
                    "</div>" +
                    '<div class="group1"><span class="inline-flex size-2 rounded-full bg-red-500"></span> Rx: ' +
                    formater_network(series[1][dataPointIndex]) +
                    "</div>" +
                    '<div><span class="inline-flex size-2 rounded-full bg-blue-500"></span> Tx: ' +
                    formater_network(series[0][dataPointIndex]) +

                    "</div>" +
                    '</div>' +

                    "</div>"
                );
            }

        },

        fill: {!! $chart->fill() !!},
    }

    function formater_network(value) {
        const sizes = ['bps', 'kbps', 'Mbps', 'Gbps', 'Tbps'];
        if (value === 0) return '0 bps';
        const i = parseInt(Math.floor(Math.log(value) /
            Math.log(1024)));
        return parseFloat((value / Math.pow(1024, i))
            .toFixed(2)) + ' ' + sizes[
            i];

    };
    var chart{!! $chart->id !!} = new ApexCharts(document.querySelector("#{!! $chart->id() !!}"),
        options);
    chart{!! $chart->id !!}.render();
</script>
