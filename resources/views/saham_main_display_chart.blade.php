@extends('layouts.default')
@section('content')

<div class="container-fluid p-0">
	<section class="resume-section">
        <div class="resume-section-content row">

        	<h2><a href="{{ route('saham_main') }}">Simple Emitmen Chart</a></h2>
        	<br><br><br>

        	<canvas id="chart-price" width="800" ></canvas>
            <div style="height: 90px;">&nbsp;</div>
        	
            <canvas id="chart-volume" width="800" ></canvas>

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
</script>

@endsection