@extends('layouts.default')
@section('content')

<div class="container-fluid p-0">
	<section class="resume-section">
        <div class="resume-section-content row">

        	<h2><a href="{{ route('dota_winrate_chart') }}">Dota 2 Winrate Chart</a></h2>
        	<br><br><br>

        	<!-- Munculkan dulu chartnya secara manual, baru susun dari code nya (Begin) -->

            <canvas id="bar-chart" width="800" ></canvas>
            <div style="height: 80px;">&nbsp;</div>

            <canvas id="bar-chart-1" width="800" ></canvas>
            <div style="height: 80px;">&nbsp;</div>

            <canvas id="bar-chart-2" width="800" ></canvas>

            <!-- Munculkan dulu chartnya secara manual, baru susun dari code nya (End) -->

        </div>
    </section>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<script>
    //Convert dari array php ke array js ======== (Begin)
    let BarChartArrayLabel = @json($BarChartArrayLabel);
    let BarChartArrayDataChart = @json($BarChartArrayDataChart);
    //Convert dari array php ke array js ======== (End)

    // Bar chart
    const mychart = new Chart(document.getElementById("bar-chart"), {
        type: 'bar',
        data: {
          labels: BarChartArrayLabel,
          datasets: [
            {
              label: "Win Percentage",
              backgroundColor: "#3e95cd",
              data: BarChartArrayDataChart
            }
          ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: '{{$HeroName}} Best Against - Top 10'
                }
            },
            scales: {
                y: {
                    ticks: {
                        // Include a dollar sign in the ticks
                        callback: function(value, index, ticks) {
                            return value+' %';
                        }
                    },
                    display: true,
                    title: {
                        display: true,
                        text: 'Percentage'+' %'
                    }
                },
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Heroes'
                    }
                }
            }
        },
    });

    //Convert dari array php ke array js ======== (Begin)
    let BarChart1ArrayLabel = @json($BarChart1ArrayLabel);
    let BarChart1ArrayDataChart = @json($BarChart1ArrayDataChart);
    //Convert dari array php ke array js ======== (End)

    // Bar chart
    const mychart1 = new Chart(document.getElementById("bar-chart-1"), {
        type: 'bar',
        data: {
          labels: BarChart1ArrayLabel,
          datasets: [
            {
              label: "Lose Percentage",
              backgroundColor: "#32a871",
              data: BarChart1ArrayDataChart
            }
          ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: '{{$HeroName}} Worst Against - Top 10'
                }
            },
            scales: {
                y: {
                    ticks: {
                        // Include a dollar sign in the ticks
                        callback: function(value, index, ticks) {
                            return value+' %';
                        }
                    },
                    display: true,
                    title: {
                        display: true,
                        text: 'Percentage'
                    }
                },
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Heroes'
                    }
                }
            }
        },
    });


    //Convert dari array php ke array js ======== (Begin)
    let BarChart2ArrayLabel = @json($BarChart2ArrayLabel);
    let BarChart2ArrayDataChart = @json($BarChart2ArrayDataChart);
    //Convert dari array php ke array js ======== (End)

    // Bar chart
    const mychart2 = new Chart(document.getElementById("bar-chart-2"), {
        type: 'bar',
        data: {
          labels: BarChart2ArrayLabel,
          datasets: [
            {
              label: "Total matches win",
              backgroundColor: "#ffb940",
              data: BarChart2ArrayDataChart
            }
          ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: '{{$HeroName}} Best Pair With - Top 15'
                }
            },
            scales: {
                y: {
                    ticks: {
                        // Include a dollar sign in the ticks
                        callback: function(value, index, ticks) {
                            return value;
                        }
                    },
                    display: true,
                    title: {
                        display: true,
                        text: 'Total Matches'
                    }
                },
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Heroes'
                    }
                }
            }
        },
    });
</script>

@endsection