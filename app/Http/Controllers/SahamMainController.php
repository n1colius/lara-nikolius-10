<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SahamMainController extends Controller
{

	public function index(Request $request)
	{
        //return view('saham_main_display_chart');
        return view('saham_main');
    }

    public function form_proc(Request $request) {
    	//parameters
    	$EmitmenCode = $request->input('EmitmenCode');
    	$JumlahHari = (int) $request->input('JumlahHari');
    	$path = $request->FileJson->path();
    	$JsonData = json_decode(file_get_contents($path),true);

    	$ArrayTanggal = array();
    	$ArrPriceOpen = array();
    	$ArrPriceClosed = array();
    	$ArrPriceHigh = array();
    	$ArrPriceLow = array();
    	$ArrBidVolume = array();
    	$ArrOfferVolume = array();
    	//dd($JsonData);

    	DB::beginTransaction();
		try {
			foreach($JsonData['replies'] as $x => $val) {
				$varproc = explode("T",$val['Date']);
				$Date = $varproc[0];
				$PriceOpen = $val['Previous'];
				$PriceClosed = $val['Close'];
				$PriceHigh = $val['High'];
				$PriceLow = $val['Low'];
				$ListedShares = $val['ListedShares'];
				$BidVolume = $val['BidVolume'];
				$OfferVolume = $val['OfferVolume'];

				//lakukan insert on duplicate key update disini
				$sqlraw = "INSERT IGNORE INTO `saham_historical` (EmitCode,`Date`,PriceOpen,PriceClosed,PriceHigh,PriceLow,ListedShares,BidVolume,OfferVolume,DateGenerated) VALUES (?,?,?,?,?,?,?,?,?,NOW())";
				$query = DB::insert($sqlraw, [
					$EmitmenCode,
					$Date,
					$PriceOpen,
					$PriceClosed,
					$PriceHigh,
					$PriceLow,
					$ListedShares,
					$BidVolume,
					$OfferVolume
				]);
			}

			DB::commit();
		} catch (\Exception $e) {
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
				FROM
					`saham_historical` a
				WHERE 1=1
					AND a.`EmitCode` = ?
				ORDER BY a.`Date` DESC
				LIMIT $JumlahHari ";
		$DataSaham = DB::select($sql, [ $EmitmenCode ]);
		//echo '<pre>'; print_r($DataSaham); exit;

		for ($i=count($DataSaham); $i > 0; $i--) {
			$ArrayTanggal[] = $DataSaham[$i-1]->Tanggal;
			$ArrPriceOpen[] = $DataSaham[$i-1]->PriceOpen;
			$ArrPriceClosed[] = $DataSaham[$i-1]->PriceClosed;
			$ArrPriceHigh[] = $DataSaham[$i-1]->PriceHigh;
			$ArrPriceLow[] = $DataSaham[$i-1]->PriceLow;
			$ArrBidVolume[] = $DataSaham[$i-1]->BidVolume;
			$ArrOfferVolume[] = $DataSaham[$i-1]->OfferVolume;
		}

		return view('saham_main_display_chart', compact(
			'EmitmenCode',
    		'ArrayTanggal',
    		'ArrPriceOpen',
    		'ArrPriceClosed',
    		'ArrPriceHigh',
    		'ArrPriceLow',
    		'ArrBidVolume',
    		'ArrOfferVolume'
    	));
    }

}
?>