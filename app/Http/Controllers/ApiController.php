<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
	public function GenSahamData(Request $request) {

		//ambil list saham
		$sql = "SELECT
					a.`EmitCode`
				FROM
					saham_emitmen a
				WHERE 1=1
					AND a.`StatusCode` = 'active'";
        $dsaham = DB::select($sql, []);

        ini_set('display_errors',true); error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        
		return response()->json([
	        "message" => "Proses Selesai Bos"
	    ], 200);
	}
}
?>