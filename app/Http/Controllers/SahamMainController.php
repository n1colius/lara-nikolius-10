<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class SahamMainController extends Controller
{

	public function index(Request $request)
	{
        //return view('saham_main_display_chart');
        return view('saham_main_pilihan');
    }

    public function form_proc(Request $request) {
    	//parameters
    	$EmitmenCode = $request->input('EmitmenCode');
    	$JumlahHari = (int) $request->input('JumlahHari');
    	$path = $request->FileJson->path();
    	$JsonData = json_decode(file_get_contents($path),true);
    	//dd($JsonData);
    	
    	$HargaClosedHariIni = 0;
    	$incre = 1;

    	//\DB::enableQueryLog(); // Enable query log
    	DB::beginTransaction();
		try {
			foreach($JsonData['replies'] as $x => $val) {
				$varproc = explode("T",$val['Date']);
				$Date = $varproc[0];

				if($incre == 1) $HargaClosedHariIni = $val['Close'];

				$PriceOpen = $val['Previous'];
				$PriceClosed = $val['Close'];
				$PriceHigh = $val['High'];
				$PriceLow = $val['Low'];
				$ListedShares = $val['ListedShares'];
				$BidVolume = $val['BidVolume'];
				$OfferVolume = $val['OfferVolume'];

				$Change = $val['Change'];
				$Volume = $val['Volume'];
				$Value = $val['Value'];
				$Frequency = $val['Frequency'];
				$IndexIndividual = $val['IndexIndividual'];
				$Offer = $val['Offer'];
				$Bid = $val['Bid'];
				$ForeignSell = $val['ForeignSell'];
				$ForeignBuy = $val['ForeignBuy'];
				$NonRegularVolume = $val['NonRegularVolume'];
				$NonRegularValue = $val['NonRegularValue'];
				$NonRegularFrequency = $val['NonRegularFrequency'];

				//lakukan insert on duplicate key update disini
				$sqlraw = "INSERT IGNORE INTO `saham_historical` (EmitCode,`Date`,PriceOpen,PriceClosed,PriceHigh,PriceLow,ListedShares,BidVolume,OfferVolume,`Change`,Volume,`Value`,Frequency,IndexIndividual,Offer,Bid,ForeignSell,ForeignBuy,NonRegularVolume,NonRegularValue,NonRegularFrequency,DateGenerated) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())";
				$query = DB::insert($sqlraw, [
					$EmitmenCode,
					$Date,
					$PriceOpen,
					$PriceClosed,
					$PriceHigh,
					$PriceLow,
					$ListedShares,
					$BidVolume,
					$OfferVolume,
					$Change,
					$Volume,
					$Value,
					$Frequency,
					$IndexIndividual,
					$Offer,
					$Bid,
					$ForeignSell,
					$ForeignBuy,
					$NonRegularVolume,
					$NonRegularValue,
					$NonRegularFrequency
				]);
				//dd(\DB::getQueryLog());

				$incre++;
			}

			DB::commit();
		} catch (\Exception $e) {
			dd($e);
		    DB::rollback();
		}

		//ambil data untuk display chart
		$sql = "SELECT
					DATE_FORMAT(a.`Date`,'%d %M %Y') AS Tanggal
					, a.`PriceOpen`
					, a.`PriceClosed`
					, a.`PriceHigh`
					, a.`PriceLow`
					, a.`BidVolume`
					, a.`OfferVolume`
					, a.Frequency
					, a.Volume
					, a.ForeignSell
					, a.ForeignBuy
				FROM
					`saham_historical` a
				WHERE 1=1
					AND a.`EmitCode` = ?
				ORDER BY a.`Date` DESC
				LIMIT $JumlahHari ";
		$DataSaham = DB::select($sql, [ $EmitmenCode ]);
		//echo '<pre>'; print_r($DataSaham); exit;

		$ArrayTanggal = array();
		$ArrPriceOpen = array();
		$ArrPriceClosed = array();
		$ArrPriceHigh = array();
		$ArrPriceLow = array();
		$ArrBidVolume = array();
		$ArrOfferVolume = array();
		$ArrFrequency = array();
		$ArrVolume = array();
		$ArrForeignSell = array();
		$ArrForeignBuy = array();

		for ($i=count($DataSaham); $i > 0; $i--) {
			$ArrayTanggal[] = $DataSaham[$i-1]->Tanggal;
			$ArrPriceOpen[] = $DataSaham[$i-1]->PriceOpen;
			$ArrPriceClosed[] = $DataSaham[$i-1]->PriceClosed;
			$ArrPriceHigh[] = $DataSaham[$i-1]->PriceHigh;
			$ArrPriceLow[] = $DataSaham[$i-1]->PriceLow;
			$ArrBidVolume[] = $DataSaham[$i-1]->BidVolume;
			$ArrOfferVolume[] = $DataSaham[$i-1]->OfferVolume;
			$ArrFrequency[] = $DataSaham[$i-1]->Frequency;
			$ArrVolume[] = $DataSaham[$i-1]->Volume;
			$ArrForeignSell[] = $DataSaham[$i-1]->ForeignSell;
			$ArrForeignBuy[] = $DataSaham[$i-1]->ForeignBuy;
		}


		//Proses data untuk dashlet-dashlet ================== (Begin)
		$AvePriceOpen = array_sum($ArrPriceOpen) / $JumlahHari;
		$AvePriceClosed = array_sum($ArrPriceClosed) / $JumlahHari;
		$AvePriceHigh = array_sum($ArrPriceHigh) / $JumlahHari;
		$AvePriceLow = array_sum($ArrPriceLow) / $JumlahHari;
		$AveBidVolume = array_sum($ArrBidVolume) / $JumlahHari;
		$AveOfferVolume = array_sum($ArrOfferVolume) / $JumlahHari;
		$AveFrequency = array_sum($ArrFrequency) / $JumlahHari;
		$AveVolume = array_sum($ArrVolume) / $JumlahHari;
		$AveForeignSell = array_sum($ArrForeignSell) / $JumlahHari;
		$AveForeignBuy = array_sum($ArrForeignBuy) / $JumlahHari;
		//Proses data untuk dashlet-dashlet ================== (End)


		$AvePriceOpen = number_format((float) $AvePriceOpen, 2, '.', ',');
		$AvePriceClosed = number_format((float) $AvePriceClosed, 2, '.', ',');
		$AvePriceHigh = number_format((float) $AvePriceHigh, 2, '.', ',');
		$AvePriceLow = number_format((float) $AvePriceLow, 2, '.', ',');
		$AveBidVolume = number_format((float) $AveBidVolume, 2, '.', ',');
		$AveOfferVolume = number_format((float) $AveOfferVolume, 2, '.', ',');
		$AveFrequency = number_format((float) $AveFrequency, 2, '.', ',');
		$AveVolume = number_format((float) $AveVolume, 2, '.', ',');
		$AveForeignSell = number_format((float) $AveForeignSell, 2, '.', ',');
		$AveForeignBuy = number_format((float) $AveForeignBuy, 2, '.', ',');
		return view('saham_main_display_chart', compact( 
			'EmitmenCode', 'ArrayTanggal', 'ArrPriceOpen', 'ArrPriceClosed', 'ArrPriceHigh', 'ArrPriceLow', 'ArrBidVolume', 'ArrOfferVolume', 'JumlahHari', 'HargaClosedHariIni','AvePriceOpen','AvePriceClosed','AvePriceHigh','AvePriceLow','AveBidVolume','AveOfferVolume','AveFrequency','AveVolume','AveForeignSell','AveForeignBuy','ArrFrequency','ArrVolume','ArrForeignSell','ArrForeignBuy'
		));
    }

    public function pilihan_form_proc(Request $request) {
    	//parameters
    	$EmitmenCode = $request->input('EmitmenCode');
    	$JumlahHari = (int) $request->input('JumlahHari');

    	//ambil data untuk display chart
		$sql = "SELECT
					DATE_FORMAT(a.`Date`,'%d %M %Y') AS Tanggal
					, a.`PriceOpen`
					, a.`PriceClosed`
					, a.`PriceHigh`
					, a.`PriceLow`
					, a.`BidVolume`
					, a.`OfferVolume`
					, a.Frequency
					, a.Volume
					, a.ForeignSell
					, a.ForeignBuy
				FROM
					`saham_historical` a
				WHERE 1=1
					AND a.`EmitCode` = ?
				ORDER BY a.`Date` DESC
				LIMIT $JumlahHari ";
		$DataSaham = DB::select($sql, [ $EmitmenCode ]);
		$CountDataSaham = count($DataSaham);

		if($CountDataSaham != $JumlahHari) {
			$errBack = array();
	    	$errBack['error_msg'] = "Sorry, Data tidak tersedia";
	    	return redirect()->back()->with($errBack)->withInput();
		}

		$HargaClosedHariIni = $DataSaham[0]->PriceClosed;
		$ArrayTanggal = array();
		$ArrPriceOpen = array();
		$ArrPriceClosed = array();
		$ArrPriceHigh = array();
		$ArrPriceLow = array();
		$ArrBidVolume = array();
		$ArrOfferVolume = array();
		$ArrFrequency = array();
		$ArrVolume = array();
		$ArrForeignSell = array();
		$ArrForeignBuy = array();

		for ($i=count($DataSaham); $i > 0; $i--) {
			$ArrayTanggal[] = $DataSaham[$i-1]->Tanggal;
			$ArrPriceOpen[] = $DataSaham[$i-1]->PriceOpen;
			$ArrPriceClosed[] = $DataSaham[$i-1]->PriceClosed;
			$ArrPriceHigh[] = $DataSaham[$i-1]->PriceHigh;
			$ArrPriceLow[] = $DataSaham[$i-1]->PriceLow;
			$ArrBidVolume[] = $DataSaham[$i-1]->BidVolume;
			$ArrOfferVolume[] = $DataSaham[$i-1]->OfferVolume;
			$ArrFrequency[] = $DataSaham[$i-1]->Frequency;
			$ArrVolume[] = $DataSaham[$i-1]->Volume;
			$ArrForeignSell[] = $DataSaham[$i-1]->ForeignSell;
			$ArrForeignBuy[] = $DataSaham[$i-1]->ForeignBuy;
		}

		//Proses data untuk dashlet-dashlet ================== (Begin)
		$AvePriceOpen = array_sum($ArrPriceOpen) / $JumlahHari;
		$AvePriceClosed = array_sum($ArrPriceClosed) / $JumlahHari;
		$AvePriceHigh = array_sum($ArrPriceHigh) / $JumlahHari;
		$AvePriceLow = array_sum($ArrPriceLow) / $JumlahHari;
		$AveBidVolume = array_sum($ArrBidVolume) / $JumlahHari;
		$AveOfferVolume = array_sum($ArrOfferVolume) / $JumlahHari;
		$AveFrequency = array_sum($ArrFrequency) / $JumlahHari;
		$AveVolume = array_sum($ArrVolume) / $JumlahHari;
		$AveForeignSell = array_sum($ArrForeignSell) / $JumlahHari;
		$AveForeignBuy = array_sum($ArrForeignBuy) / $JumlahHari;
		//Proses data untuk dashlet-dashlet ================== (End)


		$AvePriceOpen = number_format((float) $AvePriceOpen, 2, '.', ',');
		$AvePriceClosed = number_format((float) $AvePriceClosed, 2, '.', ',');
		$AvePriceHigh = number_format((float) $AvePriceHigh, 2, '.', ',');
		$AvePriceLow = number_format((float) $AvePriceLow, 2, '.', ',');
		$AveBidVolume = number_format((float) $AveBidVolume, 2, '.', ',');
		$AveOfferVolume = number_format((float) $AveOfferVolume, 2, '.', ',');
		$AveFrequency = number_format((float) $AveFrequency, 2, '.', ',');
		$AveVolume = number_format((float) $AveVolume, 2, '.', ',');
		$AveForeignSell = number_format((float) $AveForeignSell, 2, '.', ',');
		$AveForeignBuy = number_format((float) $AveForeignBuy, 2, '.', ',');

		return view('saham_main_display_chart', compact( 
			'EmitmenCode', 'ArrayTanggal', 'ArrPriceOpen', 'ArrPriceClosed', 'ArrPriceHigh', 'ArrPriceLow', 'ArrBidVolume', 'ArrOfferVolume', 'JumlahHari', 'HargaClosedHariIni','AvePriceOpen','AvePriceClosed','AvePriceHigh','AvePriceLow','AveBidVolume','AveOfferVolume','AveFrequency','AveVolume','AveForeignSell','AveForeignBuy','ArrFrequency','ArrVolume','ArrForeignSell','ArrForeignBuy'
		));
    }

}
?>