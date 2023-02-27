<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Validator;
use Session;

class AdmDotacrawlController extends Controller
{

	public function __construct()
    {
    	//set php ini
    	ini_set('memory_limit', '-1');
    	ini_set('max_execution_time', 0);
    }

	public function matches(Request $request)
	{
		//read file json
		$contents = file_get_contents(public_path().'/files/data.json');
		$contents_json = json_decode($contents);
		//dd($contents_json);

		//Parameter
		$leagueid = 14388;
		$patchid = 3;
		$total = 0;

		for ($i=0; $i < count($contents_json); $i++) {
			$matchid = $contents_json[$i]->match_id;

			//Cek apakah sudah ada, jika tidak ada baru insert
			$sql = "SELECT
                        a.MatchID
                    FROM
                        dota_matches a
                    WHERE 1=1
                        AND a.MatchID = ?
                    LIMIT 1";
            $datacek = DB::select($sql, [$matchid]);
            if(count($datacek) == 0) {
            	//insert
            	$sql = "INSERT INTO dota_matches SET
                    MatchID = ?,
                    LeagueID = ?,
                    PatchID = ?";
                $insert = DB::insert($sql, [$matchid, $leagueid, $patchid]);
                if($insert == true) $total++;
            }
		}

		return response()->json([
		    'success' => true,
		    'message' => "$total data process"
		]);
	}

	public function matches_stat(Request $request)
	{
		$leagueid = (int) $request->route('leagueid');
		$total = 0;

		//ambil list match_id
		$sql = "SELECT
                a.MatchID
            FROM
                dota_matches a
            WHERE 1=1
                AND a.LeagueID = ?
                AND a.HeroDetail = 'No'
            ORDER BY a.MatchID";
		$datamatch = DB::select($sql, [$leagueid]);

		for ($i=0; $i < count($datamatch); $i++) { 
			$response = Http::get('https://api.opendota.com/api/matches/'.$datamatch[$i]->MatchID);
			$resarr = $response->json();
			//dd($resarr);

			$dataplayers = $resarr['players'];
			for ($j=0; $j < count($dataplayers); $j++) { 
				$sql = "INSERT INTO dota_matches_heroes_info SET
                                MatchID = ?,
                                HeroID = ?,
                                Win = ?,
                                Lose = ?";
                $query = DB::insert($sql, [ $datamatch[$i]->MatchID, $dataplayers[$j]['hero_id'], $dataplayers[$j]['win'], $dataplayers[$j]['lose'] ]);

                $sql = "UPDATE dota_matches SET HeroDetail='Yes' WHERE MatchID=? AND LeagueID=? LIMIT 1";
                $query = DB::update($sql, [ $datamatch[$i]->MatchID, $leagueid ]);
			}

			$total++;
			sleep(3); //biar ada jeda 3 detik
		}
		
		return response()->json([
		    'success' => true,
		    'message' => "$total match process"
		]);
	}

	public function matches_genstat(Request $request)
	{
		$leagueid = (int) $request->route('leagueid');

		$sql = "SELECT
		            a.MatchID
		        FROM
		            dota_matches a
		        WHERE 1=1
		            AND a.LeagueID = ?
		            AND a.HeroWinLoseDetail = 'No'
		        ORDER BY a.MatchID";
		$datamatch = DB::select($sql, [$leagueid]);

		for ($i=0; $i < count($datamatch); $i++) {
			//Hapus dulu data nya
			$sql = "DELETE FROM dota_matches_heroes_winstats WHERE MatchID = ?";
			$query = DB::delete($sql, [ $datamatch[$i]->MatchID ]);

			$sql = "SELECT
			            a.HeroID
			        FROM
			            dota_matches_heroes_info a
			        WHERE 1=1
			            AND a.MatchID = ?
			            AND a.Win = '1' ";
			$DataHeroWin = DB::select($sql, [$datamatch[$i]->MatchID]);

			$sql = "SELECT
			            a.HeroID
			        FROM
			            dota_matches_heroes_info a
			        WHERE 1=1
			            AND a.MatchID = ?
			            AND a.Lose = '1' ";
			$DataHeroLose = DB::select($sql, [$datamatch[$i]->MatchID]);

			for ($j=0; $j < count($DataHeroWin); $j++) { 
				for ($k=0; $k < count($DataHeroLose); $k++) {
					$sql = "INSERT INTO dota_matches_heroes_winstats SET
					            MatchID = ?,
					            HeroIDWin = ?,
					            HeroIDLose = ? ";
					$query = DB::insert($sql, [ $datamatch[$i]->MatchID, $DataHeroWin[$j]->HeroID, $DataHeroLose[$k]->HeroID ]);
				}
			}

			$sql = "UPDATE dota_matches SET HeroWinLoseDetail='Yes' WHERE MatchID=? AND LeagueID=? LIMIT 1";
			$query = DB::update($sql, [ $datamatch[$i]->MatchID, $leagueid ]);

		}

		return response()->json([
		    'success' => true,
		    'message' => "Process finished"
		]);
	}

}