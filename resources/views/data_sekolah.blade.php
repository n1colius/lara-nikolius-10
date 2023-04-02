@extends('layouts.default')
@section('content')

<div class="container-fluid p-0">
	<section class="resume-section">
        <div class="resume-section-content row">
            <h2><a href="{{ route('data_sekolah') }}">Data Visualization - Data Sekolah di Indonesia</a></h2>
        	
        	<form style="margin-top: 20px;" method="POST" action="{{ route('data_sekolah_post') }}">
            @csrf
			<div class="row mb-3">
    			<label for="inputEmail3" class="col-sm-2 col-form-label">Filter</label>
    			<div class="col-sm-3">
      				<select name="kode_prop" id="combo_propinsi" class="form-select form-select-sm">
					 	<!--<option value="all" selected>Semua Propinsi</option>-->
					 	@if(count($combo_propinsi)>0)
                            @foreach($combo_propinsi as $key=>$item)
                                <option value="{{ $item->id }}">{{ $item->label }}</option>     
                            @endforeach
                        @endif
					</select>
    			</div>
    			<div class="col-sm-3">
      				<select name="kode_kab_kota" id="combo_kabupaten" class="form-select form-select-sm">
					 	<option value="all" selected>Semua Kabupaten</option>
					</select>
    			</div>
    			<div class="col-sm-1">
      				<button type="submit" class="btn btn-primary btn-sm mb-3">Display</button>
    			</div>
  			</div>
			</form>

			<br><br>

			<div class="row">

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Jumlah SD</div>
                                    <div id="dash-jumlah-sd" class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ number_format( $data_dashlet['dash-jumlah-sd'] , 0 , '.' , ',' ) }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <img src="{{url('/')}}/assets/icon-dash/Jumlah-SD.png" class="card-img-top" style="width:50px;height:50px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Jumlah SMP</div>
                                    <div id="dash-jumlah-smp" class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ number_format( $data_dashlet['dash-jumlah-smp'] , 0 , '.' , ',' ) }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <img src="{{url('/')}}/assets/icon-dash/Jumlah-SMP.png" class="card-img-top" style="width:50px;height:50px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Jumlah SMA</div>
                                    <div id="dash-jumlah-sma" class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ number_format( $data_dashlet['dash-jumlah-sma'] , 0 , '.' , ',' ) }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <img src="{{url('/')}}/assets/icon-dash/Jumlah-SMA.png" class="card-img-top" style="width:50px;height:50px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Jumlah SMK</div>
                                    <div id="dash-jumlah-smk" class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ number_format( $data_dashlet['dash-jumlah-smk'] , 0 , '.' , ',' ) }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <img src="{{url('/')}}/assets/icon-dash/Jumlah-SMK.png" class="card-img-top" style="width:50px;height:50px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Jumlah SDLB</div>
                                    <div id="dash-jumlah-sdlb" class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ number_format( $data_dashlet['dash-jumlah-sdlb'] , 0 , '.' , ',' ) }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <img src="{{url('/')}}/assets/icon-dash/Jumlah-SDLB.png" class="card-img-top" style="width:50px;height:50px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Jumlah SMPLB</div>
                                    <div id="dash-jumlah-smplb" class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ number_format( $data_dashlet['dash-jumlah-smplb'] , 0 , '.' , ',' ) }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <img src="{{url('/')}}/assets/icon-dash/Jumlah-SMPLB.png" class="card-img-top" style="width:50px;height:50px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Jumlah SMLB</div>
                                    <div id="dash-jumlah-smlb" class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ number_format( $data_dashlet['dash-jumlah-smlb'] , 0 , '.' , ',' ) }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <img src="{{url('/')}}/assets/icon-dash/Jumlah-SMLB.png" class="card-img-top" style="width:50px;height:50px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Jumlah SLB</div>
                                    <div id="dash-jumlah-slb" class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ number_format( $data_dashlet['dash-jumlah-slb'] , 0 , '.' , ',' ) }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <img src="{{url('/')}}/assets/icon-dash/Jumlah-SLB.png" class="card-img-top" style="width:50px;height:50px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Jumlah Sekolah Negeri</div>
                                    <div id="dash-jumlah-negeri" class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ number_format( $data_dashlet['dash-jumlah-negeri'] , 0 , '.' , ',' ) }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <img src="{{url('/')}}/assets/icon-dash/negeri.png" class="card-img-top" style="width:50px;height:50px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Jumlah Sekolah Swasta</div>
                                    <div id="dash-jumlah-swasta" class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ number_format( $data_dashlet['dash-jumlah-swasta'] , 0 , '.' , ',' ) }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <img src="{{url('/')}}/assets/icon-dash/swasta.png" class="card-img-top" style="width:50px;height:50px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <br><br> <!-- BATAS menuju Dashboard -->
            <div style="height:100px;"></div>

            <div class="row">
                <div class="col-xl-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <canvas id="pie-chart-negeri-swasta" style="height:30vh;"></canvas>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <canvas id="pie-chart-sd-smp-sma-smk" style="height:30vh;"></canvas>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <canvas id="pie-chart-sdlb-smplb-smlb-slb" style="height:30vh;"></canvas>
                    </div>
                </div>
            </div>

            <div style="height:60px;"></div>

            <div class="row">
                <div class="col-xl-6">
                    <div class="card border-left-success shadow h-100 py-2">
                        <canvas id="bar-chart-jumlah-sd"></canvas>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card border-left-success shadow h-100 py-2">
                        <canvas id="bar-chart-jumlah-smp"></canvas>
                    </div>
                </div>
            </div>

            <div style="height:60px;"></div>

            <div class="row">
                <div class="col-xl-6">
                    <div class="card border-left-success shadow h-100 py-2">
                        <canvas id="bar-chart-jumlah-sma"></canvas>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card border-left-success shadow h-100 py-2">
                        <canvas id="bar-chart-jumlah-smk"></canvas>
                    </div>
                </div>
            </div>

            <div style="height:60px;"></div>

            <div class="row">
                <div class="col-xl-6">
                    <div class="card border-left-success shadow h-100 py-2">
                        <canvas id="bar-chart-jumlah-sdlb"></canvas>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card border-left-success shadow h-100 py-2">
                        <canvas id="bar-chart-jumlah-smplb"></canvas>
                    </div>
                </div>
            </div>

            <div style="height:60px;"></div>

            <div class="row">
                <div class="col-xl-6">
                    <div class="card border-left-success shadow h-100 py-2">
                        <canvas id="bar-chart-jumlah-smlb"></canvas>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card border-left-success shadow h-100 py-2">
                        <canvas id="bar-chart-jumlah-slb"></canvas>
                    </div>
                </div>
            </div>

            
            <br><br> <!-- BATAS menuju Dashboard -->
            <div style="height:100px;"></div>

            <form>
            <div class="form-check form-check-inline">
                <input onclick="toggleMarker('sd')" checked="" class="form-check-input" type="checkbox" id="check_sd" value="1">
                <label class="form-check-label" for="check_sd">Sekolah SD</label>
            </div>
            &nbsp;
            <div class="form-check form-check-inline">
                <input onclick="toggleMarker('smp')" checked="" class="form-check-input" type="checkbox" id="check_smp" value="1">
                <label class="form-check-label" for="check_smp">Sekolah SMP</label>
            </div>
            &nbsp;
            <div class="form-check form-check-inline">
                <input onclick="toggleMarker('sma')" checked="" class="form-check-input" type="checkbox" id="check_sma" value="1">
                <label class="form-check-label" for="check_sma">Sekolah SMA</label>
            </div>
            &nbsp;
            <div class="form-check form-check-inline">
                <input onclick="toggleMarker('smk')" checked="" class="form-check-input" type="checkbox" id="check_smk" value="1">
                <label class="form-check-label" for="check_smk">Sekolah SMK</label>
            </div>
            </form>
            <div class="row">
                <div id="map" style="height:700px;"></div>
            </div>

        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

/* Flow Logic Form ========================================================================= (BEGIN) */
document.getElementById("combo_propinsi").addEventListener("change", function(e) {
    e.preventDefault();
    funcLoadComboKab(this.value,"all");
});

function funcLoadComboKab(kode_prop, kode_kab_kota) {
    let formData = {
        kode_prop: kode_prop
    };

    $.ajax({
        type: 'GET',
        url: '{{ route('data_sekolah_change_prov') }}',
        data: formData,
        dataType: 'json',
        beforeSend: function() {
            $.LoadingOverlay("show");
        },
        success: function (datareturn) {
            $.LoadingOverlay("hide");
            $('#combo_kabupaten').find('option').remove().end().append('<option value="all" selected>Semua Kabupaten</option>');
            $.each(datareturn.data, function (index, val) {
                if(val.id == kode_kab_kota)
                    $('#combo_kabupaten').append('<option selected value="' + val.id + '">' + val.label + '</option>');
                else
                    $('#combo_kabupaten').append('<option value="' + val.id + '">' + val.label + '</option>');
            });
        },
        error: function (data) {
            $.LoadingOverlay("hide");
            Swal.fire(
                'Network Error',
                'Process Failed',
                'error'
            );
        }
    });
}

function funcOnLoad() {
    //insert value combobox search
    document.getElementById("combo_propinsi").value = "{{ $kode_prop }}";
    funcLoadComboKab("{{ $kode_prop }}","{{ $kode_kab_kota }}");
};
window.onload = funcOnLoad;
/* Flow Logic Form ========================================================================= (END) */

    /* PIE CHART ========================================================================= (BEGIN) */

    const pie_chart_negeri_swasta = new Chart(document.getElementById("pie-chart-negeri-swasta"),{
        type: 'pie',
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Perbandingan Sekolah Negeri dan Swasta'
                }
            }
        },
        data: {
          labels: ['Negeri','Swasta'],
          datasets: [{
            data: [{{ $data_pie_negeri_swasta[0] }}, {{ $data_pie_negeri_swasta[1] }}],
            backgroundColor: ['#6209D4','#08C6CD'],
            hoverOffset: 4,
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let label = context.label;
                        let value = context.raw;
                        let valueFormatted = context.formattedValue;

                        if (!label)
                            label = 'Unknown'

                        let sum = 0;
                        let dataArr = context.chart.data.datasets[0].data;
                        dataArr.map(data => {
                            sum += Number(data);
                        });

                        let percentage = (value * 100 / sum).toFixed(2) + '%';
                        return ["  Persentase: "+percentage, "  Total Data: "+valueFormatted];
                    }
                }
            }
          }]
        }
    });

    const pie_chart_sd_smp_sma_smk = new Chart(document.getElementById("pie-chart-sd-smp-sma-smk"),{
        type: 'pie',
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Perbandingan Sekolah SD, SMP, SMA dan SMK'
                }
            }
        },
        data: {
          labels: ['SD','SMP', 'SMA', 'SMK'],
          datasets: [{
            data: [{{ $data_pie_sd_smp_sma_smk[0] }},{{ $data_pie_sd_smp_sma_smk[1] }},{{ $data_pie_sd_smp_sma_smk[2] }},{{ $data_pie_sd_smp_sma_smk[3] }}],
            backgroundColor: ['#6209D4','#08C6CD','#FECD70','#E136A7'],
            hoverOffset: 4,
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let label = context.label;
                        let value = context.raw;
                        let valueFormatted = context.formattedValue;

                        if (!label)
                            label = 'Unknown'

                        let sum = 0;
                        let dataArr = context.chart.data.datasets[0].data;
                        dataArr.map(data => {
                            sum += Number(data);
                        });

                        let percentage = (value * 100 / sum).toFixed(2) + '%';
                        return ["  Persentase: "+percentage, "  Total Data: "+valueFormatted];
                    }
                }
            }
          }]
        }
    });

    const pie_chart_sdlb_smplb_smlb_slb = new Chart(document.getElementById("pie-chart-sdlb-smplb-smlb-slb"),{
        type: 'pie',
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Perbandingan Sekolah SDLB, SMPLB, SMLB dan SLB'
                }
            }
        },
        data: {
          labels: ['SDLB','SMPLB','SMLB','SLB'],
          datasets: [{
            data: [{{ $data_pie_sdlb_smplb_smlb_slb[0] }},{{ $data_pie_sdlb_smplb_smlb_slb[1] }},{{ $data_pie_sdlb_smplb_smlb_slb[2] }},{{ $data_pie_sdlb_smplb_smlb_slb[3] }}],
            backgroundColor: ['#6209D4','#08C6CD','#FECD70','#E136A7'],
            hoverOffset: 4,
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let label = context.label;
                        let value = context.raw;
                        let valueFormatted = context.formattedValue;

                        if (!label)
                            label = 'Unknown'

                        let sum = 0;
                        let dataArr = context.chart.data.datasets[0].data;
                        dataArr.map(data => {
                            sum += Number(data);
                        });

                        let percentage = (value * 100 / sum).toFixed(2) + '%';
                        return ["  Persentase: "+percentage, "  Total Data: "+valueFormatted];
                    }
                }
            }
          }]
        }
    });

    /* PIE CHART ========================================================================= (END) */

    /* BAR CHART ========================================================================= (BEGIN) */

    let jumlah_sd_label = @json($jumlah_sd_label);
    let jumlah_sd_data_chart = @json($jumlah_sd_data_chart);
    const bar_chart_jumlah_sd = new Chart(document.getElementById("bar-chart-jumlah-sd"), {
        type: 'bar',
        data: {
          labels: jumlah_sd_label,
          datasets: [
            {
              label: "Jumlah Sekolah",
              backgroundColor: ["#451A2E","#8F3A09","#D79C27","#2F593E","#1C263B","#BA707E","#102847","#555555","#8B8680","#D1C3A9"],
              data: jumlah_sd_data_chart
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
                    text: 'Jumlah Sekolah SD (Top 10)'
                }
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: '{{ $group_bar_chart }}'
                    }
                }
            }
        },
    });

    let jumlah_smp_label = @json($jumlah_smp_label);
    let jumlah_smp_data_chart = @json($jumlah_smp_data_chart);
    const bar_chart_jumlah_smp = new Chart(document.getElementById("bar-chart-jumlah-smp"), {
        type: 'bar',
        data: {
          labels: jumlah_smp_label,
          datasets: [
            {
              label: "Jumlah Sekolah",
              backgroundColor: ["#451A2E","#8F3A09","#D79C27","#2F593E","#1C263B","#BA707E","#102847","#555555","#8B8680","#D1C3A9"],
              data: jumlah_smp_data_chart
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
                    text: 'Jumlah Sekolah SMP (Top 10)'
                }
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: '{{ $group_bar_chart }}'
                    }
                }
            }
        },
    });

    let jumlah_sma_label = @json($jumlah_sma_label);
    let jumlah_sma_data_chart = @json($jumlah_sma_data_chart);
    const bar_chart_jumlah_sma = new Chart(document.getElementById("bar-chart-jumlah-sma"), {
        type: 'bar',
        data: {
          labels: jumlah_sma_label,
          datasets: [
            {
              label: "Jumlah Sekolah",
              backgroundColor: ["#451A2E","#8F3A09","#D79C27","#2F593E","#1C263B","#BA707E","#102847","#555555","#8B8680","#D1C3A9"],
              data: jumlah_sma_data_chart
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
                    text: 'Jumlah Sekolah SMA (Top 10)'
                }
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: '{{ $group_bar_chart }}'
                    }
                }
            }
        },
    });

    let jumlah_smk_label = @json($jumlah_smk_label);
    let jumlah_smk_data_chart = @json($jumlah_smk_data_chart);
    const bar_chart_jumlah_smk = new Chart(document.getElementById("bar-chart-jumlah-smk"), {
        type: 'bar',
        data: {
          labels: jumlah_smk_label,
          datasets: [
            {
              label: "Jumlah Sekolah",
              backgroundColor: ["#451A2E","#8F3A09","#D79C27","#2F593E","#1C263B","#BA707E","#102847","#555555","#8B8680","#D1C3A9"],
              data: jumlah_smk_data_chart
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
                    text: 'Jumlah Sekolah SMK (Top 10)'
                }
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: '{{ $group_bar_chart }}'
                    }
                }
            }
        },
    });

    let jumlah_sdlb_label = @json($jumlah_sdlb_label);
    let jumlah_sdlb_data_chart = @json($jumlah_sdlb_data_chart);
    const bar_chart_jumlah_sdlb = new Chart(document.getElementById("bar-chart-jumlah-sdlb"), {
        type: 'bar',
        data: {
          labels: jumlah_sdlb_label,
          datasets: [
            {
              label: "Jumlah Sekolah",
              backgroundColor: ["#451A2E","#8F3A09","#D79C27","#2F593E","#1C263B","#BA707E","#102847","#555555","#8B8680","#D1C3A9"],
              data: jumlah_sdlb_data_chart
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
                    text: 'Jumlah Sekolah SDLB (Top 10)'
                }
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: '{{ $group_bar_chart }}'
                    }
                }
            }
        },
    });

    let jumlah_smplb_label = @json($jumlah_smplb_label);
    let jumlah_smplb_data_chart = @json($jumlah_smplb_data_chart);
    const bar_chart_jumlah_smplb = new Chart(document.getElementById("bar-chart-jumlah-smplb"), {
        type: 'bar',
        data: {
          labels: jumlah_smplb_label,
          datasets: [
            {
              label: "Jumlah Sekolah",
              backgroundColor: ["#451A2E","#8F3A09","#D79C27","#2F593E","#1C263B","#BA707E","#102847","#555555","#8B8680","#D1C3A9"],
              data: jumlah_smplb_data_chart
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
                    text: 'Jumlah Sekolah SMPLB (Top 10)'
                }
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: '{{ $group_bar_chart }}'
                    }
                }
            }
        },
    });

    let jumlah_smlb_label = @json($jumlah_smlb_label);
    let jumlah_smlb_data_chart = @json($jumlah_smlb_data_chart);
    const bar_chart_jumlah_smlb = new Chart(document.getElementById("bar-chart-jumlah-smlb"), {
        type: 'bar',
        data: {
          labels: jumlah_smlb_label,
          datasets: [
            {
              label: "Jumlah Sekolah",
              backgroundColor: ["#451A2E","#8F3A09","#D79C27","#2F593E","#1C263B","#BA707E","#102847","#555555","#8B8680","#D1C3A9"],
              data: jumlah_smlb_data_chart
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
                    text: 'Jumlah Sekolah SMLB (Top 10)'
                }
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: '{{ $group_bar_chart }}'
                    }
                }
            }
        },
    });

    let jumlah_slb_label = @json($jumlah_slb_label);
    let jumlah_slb_data_chart = @json($jumlah_slb_data_chart);
    const bar_chart_jumlah_slb = new Chart(document.getElementById("bar-chart-jumlah-slb"), {
        type: 'bar',
        data: {
          labels: jumlah_slb_label,
          datasets: [
            {
              label: "Jumlah Sekolah",
              backgroundColor: ["#451A2E","#8F3A09","#D79C27","#2F593E","#1C263B","#BA707E","#102847","#555555","#8B8680","#D1C3A9"],
              data: jumlah_slb_data_chart
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
                    text: 'Jumlah Sekolah SLB (Top 10)'
                }
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: '{{ $group_bar_chart }}'
                    }
                }
            }
        },
    });    

    /* BAR CHART ========================================================================= (END) */


/* GOGGLE MAPS ========================================================= (BEGIN) */
var markerTampung = {
    "sd": [],
    "smp": [],
    "sma": [],
    "smk": []
};

function initMap() {
    //code acuan ct-indo C:\WebDev\Apache24\htdocs\cocoatrace\api\application\views\cetak_beneficiary_profiles_v2.php (line 854)

    var imageMarkerSD = '{{url('/')}}/assets/map-marker/merah.png';
    var imageMarkerSMP = '{{url('/')}}/assets/map-marker/biru.png';
    var imageMarkerSMA = '{{url('/')}}/assets/map-marker/abu.png';
    var imageMarkerSMK = '{{url('/')}}/assets/map-marker/orange.png';
    var bounds = new google.maps.LatLngBounds();
    var infowindow = new google.maps.InfoWindow();
    var maxZoomService = new google.maps.MaxZoomService();

    //Data Lokasi SD
    var DataKoordinatSd = [
    @php
        for ($i=0; $i < count($data_koor_sd); $i++) {
            echo '["'.$data_koor_sd[$i]->sekolah.'",'.$data_koor_sd[$i]->Latitude.','.$data_koor_sd[$i]->Longitude.']';

            if($i != (count($data_koor_sd) -1)){
                echo ',';
            }
        }
    @endphp
    ];

    //Data Lokasi SMP
    var DataKoordinatSmp = [
    @php
        for ($i=0; $i < count($data_koor_smp); $i++) {
            echo '["'.$data_koor_smp[$i]->sekolah.'",'.$data_koor_smp[$i]->Latitude.','.$data_koor_smp[$i]->Longitude.']';

            if($i != (count($data_koor_smp) -1)){
                echo ',';
            }
        }
    @endphp
    ];

    //Data Lokasi SMA
    var DataKoordinatSma = [
    @php
        for ($i=0; $i < count($data_koor_sma); $i++) {
            echo '["'.$data_koor_sma[$i]->sekolah.'",'.$data_koor_sma[$i]->Latitude.','.$data_koor_sma[$i]->Longitude.']';

            if($i != (count($data_koor_sma) -1)){
                echo ',';
            }
        }
    @endphp
    ];

    //Data Lokasi SMK
    var DataKoordinatSmk = [
    @php
        for ($i=0; $i < count($data_koor_smk); $i++) {
            echo '["'.$data_koor_smk[$i]->sekolah.'",'.$data_koor_smk[$i]->Latitude.','.$data_koor_smk[$i]->Longitude.']';

            if($i != (count($data_koor_smk) -1)){
                echo ',';
            }
        }
    @endphp
    ];

    
    var map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: -0.789275, lng: 113.921327 },
        zoom: 5
    });


    //display koordinat sd
    for (i = 0; i < DataKoordinatSd.length; i++) {
        var markerSD = new google.maps.Marker({
            position: new google.maps.LatLng(DataKoordinatSd[i][1], DataKoordinatSd[i][2]),
            map: map,
            icon: imageMarkerSD
        });
        markerTampung['sd'].push(markerSD);

        //extend the bounds to include each marker's position
        bounds.extend(markerSD.position);

        google.maps.event.addListener(markerSD, 'click', (function(markerSD, i) {
            return function() {
              infowindow.setContent(DataKoordinatSd[i][0]);
              infowindow.open(map, markerSD);
            }
        })(markerSD, i));

        //now fit the map to the newly inclusive bounds
        map.fitBounds(bounds);
        map.panToBounds(bounds);
    }

    //display koordinat smp
    for (i = 0; i < DataKoordinatSmp.length; i++) {
        var markerSMP = new google.maps.Marker({
            position: new google.maps.LatLng(DataKoordinatSmp[i][1], DataKoordinatSmp[i][2]),
            map: map,
            icon: imageMarkerSMP
        });
        markerTampung['smp'].push(markerSMP);

        //extend the bounds to include each marker's position
        bounds.extend(markerSMP.position);

        google.maps.event.addListener(markerSMP, 'click', (function(markerSMP, i) {
            return function() {
              infowindow.setContent(DataKoordinatSmp[i][0]);
              infowindow.open(map, markerSMP);
            }
        })(markerSMP, i));

        //now fit the map to the newly inclusive bounds
        map.fitBounds(bounds);
        map.panToBounds(bounds);

        //default hidden dulu
        //markerSMP.setVisible(false);
    }

    //display koordinat sma
    for (i = 0; i < DataKoordinatSma.length; i++) {
        var markerSMA = new google.maps.Marker({
            position: new google.maps.LatLng(DataKoordinatSma[i][1], DataKoordinatSma[i][2]),
            map: map,
            icon: imageMarkerSMA
        });
        markerTampung['sma'].push(markerSMA);

        //extend the bounds to include each marker's position
        bounds.extend(markerSMA.position);

        google.maps.event.addListener(markerSMA, 'click', (function(markerSMA, i) {
            return function() {
              infowindow.setContent(DataKoordinatSma[i][0]);
              infowindow.open(map, markerSMA);
            }
        })(markerSMA, i));

        //now fit the map to the newly inclusive bounds
        map.fitBounds(bounds);
        map.panToBounds(bounds);

        //default hidden dulu
        //markerSMA.setVisible(false);
    }

    //display koordinat smk
    for (i = 0; i < DataKoordinatSmk.length; i++) {
        var markerSMK = new google.maps.Marker({
            position: new google.maps.LatLng(DataKoordinatSmk[i][1], DataKoordinatSmk[i][2]),
            map: map,
            icon: imageMarkerSMK
        });
        markerTampung['smk'].push(markerSMK);

        //extend the bounds to include each marker's position
        bounds.extend(markerSMK.position);

        google.maps.event.addListener(markerSMK, 'click', (function(markerSMK, i) {
            return function() {
              infowindow.setContent(DataKoordinatSmk[i][0]);
              infowindow.open(map, markerSMK);
            }
        })(markerSMK, i));

        //now fit the map to the newly inclusive bounds
        map.fitBounds(bounds);
        map.panToBounds(bounds);

        //default hidden dulu
        //markerSMK.setVisible(false);
    }


    //(optional) restore the zoom level after the map is done scaling
    var listener = google.maps.event.addListener(map, "idle", function () {
        map.fitBounds(bounds);
        map.panToBounds(bounds);

        //set Zoom Level, cek Sorry, no imagery here
        maxZoomService.getMaxZoomAtLatLng(map.getCenter(), function(response) {
          if (response.status !== 'OK') {
            infoWindow.setContent('Error in MaxZoomService');
          } else {
            if(map.getZoom() > response.zoom){
                map.setZoom(response.zoom);
            }
          }
        });

        google.maps.event.removeListener(listener);
    });
    
}
window.initMap = initMap;

function toggleMarker(type) {
    for (var i = 0; i < markerTampung[type].length; i++) {
        if (!markerTampung[type][i].getVisible()) {
            markerTampung[type][i].setVisible(true);
        } else {
            markerTampung[type][i].setVisible(false);
        }
    }
}
/* GOGGLE MAPS ========================================================= (END) */

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCba8N9LjVuA4bq4hsgh-DK_T8WGxh1bms&callback=initMap"></script>
@php
//echo '<pre>'; print_r($data_koor_sd); exit;
@endphp
@endsection