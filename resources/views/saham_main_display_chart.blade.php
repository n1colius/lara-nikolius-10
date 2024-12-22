@extends('layouts.default')
@section('content')

<div class="container-fluid p-0">
	<section class="resume-section">
        <div class="resume-section-content row">

        	<h2><a href="{{ route('saham_main') }}">Simple Emitmen Chart</a></h2>
        	<div style="margin-top:30px;">&nbsp;</div>

            <h3>Data dalam {{ $JumlahHari }} Hari</h3>

            <div class="container">
              <div class="row align-items-start">

                <div class="col cont-kartu-simpel">
                    <label class="cont-kartu-simpel-judul-satu">Harga Saham Closed Hari Ini</label><br>
                    <label class="cont-kartu-simpel-judul-dua">{{ $HargaClosedHariIni }}</label>
                </div>

                <div class="col cont-kartu-simpel">
                    <label class="cont-kartu-simpel-judul-satu">Average Price Open</label><br>
                    <label class="cont-kartu-simpel-judul-dua">{{ $AvePriceOpen }}</label>
                </div>

                <div class="col cont-kartu-simpel">
                    <label class="cont-kartu-simpel-judul-satu">Average Price Closed</label><br>
                    <label class="cont-kartu-simpel-judul-dua">{{ $AvePriceClosed }}</label>
                </div>

                <div class="col cont-kartu-simpel">
                    <label class="cont-kartu-simpel-judul-satu">Average Price Highest</label><br>
                    <label class="cont-kartu-simpel-judul-dua">{{ $AvePriceHigh }}</label>
                </div>
              </div>

              <div class="row align-items-start">
                <div class="col cont-kartu-simpel">
                    <label class="cont-kartu-simpel-judul-satu">Average Price Lowest</label><br>
                    <label class="cont-kartu-simpel-judul-dua">{{ $AvePriceLow }}</label>
                </div>

                <div class="col cont-kartu-simpel">
                    <label class="cont-kartu-simpel-judul-satu">Average Bid Volume (lot)</label><br>
                    <label class="cont-kartu-simpel-judul-dua">{{ $AveBidVolume }}</label>
                </div>

                <div class="col cont-kartu-simpel">
                    <label class="cont-kartu-simpel-judul-satu">Average Offer Volume (lot)</label><br>
                    <label class="cont-kartu-simpel-judul-dua">{{ $AveOfferVolume }}</label>
                </div>

                <div class="col cont-kartu-simpel">
                    <label class="cont-kartu-simpel-judul-satu">Average Frequency</label><br>
                    <label class="cont-kartu-simpel-judul-dua">{{ $AveFrequency }}</label>
                </div>
              </div>

              <div class="row align-items-start">
                <div class="col cont-kartu-simpel">
                    <label class="cont-kartu-simpel-judul-satu">Average Volume</label><br>
                    <label class="cont-kartu-simpel-judul-dua">{{ $AveVolume }}</label>
                </div>

                <div class="col cont-kartu-simpel">
                    <label class="cont-kartu-simpel-judul-satu">Average Foreign Buy</label><br>
                    <label class="cont-kartu-simpel-judul-dua">{{ $AveForeignSell }}</label>
                </div>

                <div class="col cont-kartu-simpel">
                    <label class="cont-kartu-simpel-judul-satu">Average Foreign Sell</label><br>
                    <label class="cont-kartu-simpel-judul-dua">{{ $AveForeignBuy }}</label>
                </div>
              </div>

            </div>

            <div style="margin-top:30px;">&nbsp;</div>
            
        	<canvas id="chart-price" width="800" ></canvas>
            <div style="height: 90px;">&nbsp;</div>

            <div class="container">
                <div class="row align-items-start">
                    <div class="col cont-kartu-simpel">
                        <canvas id="chart-freq"></canvas>        
                    </div>

                    <div class="col cont-kartu-simpel">
                        <canvas id="chart-volume-solo"></canvas>        
                    </div>
                </div>
            </div>
            <div style="height: 90px;">&nbsp;</div>
        	
            <canvas id="chart-volume" width="800" ></canvas>
            <div style="height: 90px;">&nbsp;</div>

            <canvas id="chart-foreign" width="800" ></canvas>

        </div>
    </section>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<script type="text/javascript">
    let ArrayTanggal = @json($ArrayTanggal);
    let PriceOpen = @json($ArrPriceOpen);
    let PriceClosed = @json($ArrPriceClosed);
    let PriceHigh = @json($ArrPriceHigh);
    let PriceLow = @json($ArrPriceLow);
    let BidVolume = @json($ArrBidVolume);
    let OfferVolume = @json($ArrOfferVolume);
    let Frequency = @json($ArrFrequency);
    let Volume = @json($ArrVolume);
    let ForeignBuy = @json($ArrForeignBuy);
    let ForeignSell = @json($ArrForeignSell);

    const chart_price = new Chart(document.getElementById("chart-price"), {
        type: 'line',
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Saham {{$EmitmenCode}} - (Price)'
                }
            }
        },
        data: {
            labels: ArrayTanggal,
            datasets: [{
                label: 'Price Open',
                data: PriceOpen,
                borderColor: '#293462',
                backgroundColor: '#D61C4E',
                pointStyle: 'circle',
                pointRadius: 10,
                pointHoverRadius: 15
            },{
                label: 'Price Closed',
                data: PriceClosed,
                borderColor: '#FEB139',
                backgroundColor: '#FFF80A',
                pointStyle: 'circle',
                pointRadius: 10,
                pointHoverRadius: 15 
            },{
                label: 'Price Highest',
                data: PriceHigh,
                borderColor: '#4C3F91',
                backgroundColor: '#9145B6',
                pointStyle: 'circle',
                pointRadius: 10,
                pointHoverRadius: 15 
            },{
                label: 'Price Lowest',
                data: PriceLow,
                borderColor: '#B958A5',
                backgroundColor: '#FF5677',
                pointStyle: 'circle',
                pointRadius: 10,
                pointHoverRadius: 15 
            }]
        }
    });

    const chart_freq = new Chart(document.getElementById("chart-freq"), {
        type: 'line',
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Saham {{$EmitmenCode}} (Frequency)'
                }
            }
        },
        data: {
            labels: ArrayTanggal,
            datasets: [{
                label: 'Frequency',
                data: Frequency,
                borderColor: '#293462',
                backgroundColor: '#D61C4E',
                pointStyle: 'circle',
                pointRadius: 10,
                pointHoverRadius: 15
            }]
        }
    });

    const chart_volume_solo = new Chart(document.getElementById("chart-volume-solo"), {
        type: 'line',
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Saham {{$EmitmenCode}} (Volume dalam lembar saham)'
                }
            }
        },
        data: {
            labels: ArrayTanggal,
            datasets: [{
                label: 'Volume',
                data: Volume,
                borderColor: '#FEB139',
                backgroundColor: '#FFF80A',
                pointStyle: 'circle',
                pointRadius: 10,
                pointHoverRadius: 15 
            }]
        }
    });

    const chart_volume = new Chart(document.getElementById("chart-volume"), {
        type: 'bar',
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Saham {{$EmitmenCode}} - (Volume)'
                }
            }
        },
        data: {
            labels: ArrayTanggal,
            datasets: [{
                label: 'Bid Volume',
                data: BidVolume,
                backgroundColor: '#4C3F91'
            },{
                label: 'Offer Volume',
                data: OfferVolume,
                backgroundColor: '#FF5677' 
            }]
        }
    });

    const chart_foreign = new Chart(document.getElementById("chart-foreign"), {
        type: 'line',
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Saham {{$EmitmenCode}} - (Foreign per lembar saham)'
                }
            }
        },
        data: {
            labels: ArrayTanggal,
            datasets: [{
                label: 'Foreign Buy',
                data: ForeignBuy,
                borderColor: '#293462',
                backgroundColor: '#D61C4E',
                pointStyle: 'circle',
                pointRadius: 10,
                pointHoverRadius: 15
            },{
                label: 'Foreign Sell',
                data: ForeignSell,
                borderColor: '#FEB139',
                backgroundColor: '#FFF80A',
                pointStyle: 'circle',
                pointRadius: 10,
                pointHoverRadius: 15 
            }]
        }
    });

</script>

@endsection