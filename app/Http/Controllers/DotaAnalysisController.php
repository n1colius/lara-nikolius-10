<?php
/**
 * @authors Nikolius Lau (n1colius.lau@gmail.com)
 * @date    2021-08-17 22:22:36
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DotaAnalysisController extends Controller
{

	public function index(Request $request)
	{
		//combo hero
		$sql = "SELECT
					a.HeroID AS id
					, a.HeroName AS label
				FROM
					dota_heroes a
				WHERE 1=1
				ORDER BY a.`HeroName` ASC";
		$cmb_hero = DB::select($sql, []);

		return view('dota_analysis', compact(
			'cmb_hero'
		));
	}

	public function result(Request $request)
	{
		//get param
		$StrRadiantHero = $request->get('radiant_hero');
		$StrDireHero = $request->get('dire_hero');
		$ArrRadiantHero = explode(',', $StrRadiantHero);
		$ArrDireHero = explode(',', $StrDireHero);
		$ReturnRadiant1 = array();
		$ReturnRadiant2 = array();
		$ReturnRadiant3 = array();
		$ReturnRadiant4 = array();
		$ReturnRadiant5 = array();
		$ReturnDire1 = array();
		$ReturnDire2 = array();
		$ReturnDire3 = array();
		$ReturnDire4 = array();
		$ReturnDire5 = array();

		$QueryWinLose = "SELECT
		            COUNT(a.MatchID) AS Jumlah
		        FROM
		            dota_matches_heroes_winstats a
		        WHERE 1=1
		            AND a.HeroIDWin = ?
		            AND a.HeroIDLose = ?";

		$QueryInfoHero = "SELECT
								a.HeroName
								, a.Picture
								, a.`AttackType`
								, GROUP_CONCAT(b.`Roles` SEPARATOR ', ') AS Roles
							FROM
								dota_heroes a
								LEFT JOIN dota_heroes_roles b ON a.`HeroID` = b.`HeroID`
							WHERE 1=1
								AND a.HeroID = ?
							GROUP BY a.HeroID
							LIMIT 1";

		$QueryInfoHeroRolesRadiant = "SELECT
											b.`Roles`
											, CONCAT(COUNT(b.`Roles`),'x') AS CountRoles
										FROM
											`dota_heroes` a
											INNER JOIN dota_heroes_roles b ON a.`HeroID` = b.`HeroID`
										WHERE 1=1
											AND a.`HeroID` IN ({$StrRadiantHero})
										GROUP BY b.`Roles`
										ORDER BY CountRoles DESC, b.`Roles` ASC";
		$InfoHeroRolesRadiant = DB::select($QueryInfoHeroRolesRadiant);
		$QueryInfoHeroRolesDire = "SELECT
											b.`Roles`
											, CONCAT(COUNT(b.`Roles`),'x') AS CountRoles
										FROM
											`dota_heroes` a
											INNER JOIN dota_heroes_roles b ON a.`HeroID` = b.`HeroID`
										WHERE 1=1
											AND a.`HeroID` IN ({$StrDireHero})
										GROUP BY b.`Roles`
										ORDER BY CountRoles DESC, b.`Roles` ASC";
		$InfoHeroRolesDire = DB::select($QueryInfoHeroRolesDire);

		//INFO HERO ========================= (Begin)
		$InfoHeroRadiant1 = DB::select($QueryInfoHero, [ $ArrRadiantHero[0] ]);
		$InfoHeroRadiant2 = DB::select($QueryInfoHero, [ $ArrRadiantHero[1] ]);
		$InfoHeroRadiant3 = DB::select($QueryInfoHero, [ $ArrRadiantHero[2] ]);
		$InfoHeroRadiant4 = DB::select($QueryInfoHero, [ $ArrRadiantHero[3] ]);
		$InfoHeroRadiant5 = DB::select($QueryInfoHero, [ $ArrRadiantHero[4] ]);
		$InfoHeroDire1 = DB::select($QueryInfoHero, [ $ArrDireHero[0] ]);
		$InfoHeroDire2 = DB::select($QueryInfoHero, [ $ArrDireHero[1] ]);
		$InfoHeroDire3 = DB::select($QueryInfoHero, [ $ArrDireHero[2] ]);
		$InfoHeroDire4 = DB::select($QueryInfoHero, [ $ArrDireHero[3] ]);
		$InfoHeroDire5 = DB::select($QueryInfoHero, [ $ArrDireHero[4] ]);
		//INFO HERO ========================= (End)


		//================================================================================= Hero 1 (BEGIN) =======================================================
		$ResWinMatch = DB::select($QueryWinLose, [ $ArrRadiantHero[0],$ArrDireHero[0]  ]);
		$ResLoseMatch = DB::select($QueryWinLose, [ $ArrDireHero[0],$ArrRadiantHero[0]  ]);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResWinMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroRadiant1[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroRadiant1[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroRadiant1[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroRadiant1[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroDire1[0]->HeroName;
		array_push($ReturnRadiant1, $ArrTmp);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResLoseMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroDire1[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroDire1[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroDire1[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroDire1[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroRadiant1[0]->HeroName;
		array_push($ReturnDire1, $ArrTmp);

		$ResWinMatch = DB::select($QueryWinLose, [ $ArrRadiantHero[0],$ArrDireHero[1]  ]);
		$ResLoseMatch = DB::select($QueryWinLose, [ $ArrDireHero[1],$ArrRadiantHero[0]  ]);
		if( ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) == 0 ) $WinRate = 0; else $WinRate = ( $ResWinMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroRadiant1[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroRadiant1[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroRadiant1[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroRadiant1[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroDire2[0]->HeroName;
		array_push($ReturnRadiant1, $ArrTmp);
		if( ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) == 0 ) $WinRate = 0; else $WinRate = ( $ResLoseMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroDire2[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroDire2[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroDire2[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroDire2[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroRadiant1[0]->HeroName;
		array_push($ReturnDire2, $ArrTmp);

		$ResWinMatch = DB::select($QueryWinLose, [ $ArrRadiantHero[0],$ArrDireHero[2]  ]);
		$ResLoseMatch = DB::select($QueryWinLose, [ $ArrDireHero[2],$ArrRadiantHero[0]  ]);
		if( ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) == 0 ) $WinRate = 0; else $WinRate = ( $ResWinMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroRadiant1[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroRadiant1[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroRadiant1[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroRadiant1[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroDire3[0]->HeroName;
		array_push($ReturnRadiant1, $ArrTmp);
		if( ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) == 0 ) $WinRate = 0; else $WinRate = ( $ResLoseMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroDire3[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroDire3[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroDire3[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroDire3[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroRadiant1[0]->HeroName;
		array_push($ReturnDire3, $ArrTmp);

		$ResWinMatch = DB::select($QueryWinLose, [ $ArrRadiantHero[0],$ArrDireHero[3]  ]);
		$ResLoseMatch = DB::select($QueryWinLose, [ $ArrDireHero[3],$ArrRadiantHero[0]  ]);
		if( ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) == 0 ) $WinRate = 0; else $WinRate = ( $ResWinMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroRadiant1[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroRadiant1[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroRadiant1[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroRadiant1[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroDire4[0]->HeroName;
		array_push($ReturnRadiant1, $ArrTmp);
		if( ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) == 0 ) $WinRate = 0; else $WinRate = ( $ResLoseMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroDire4[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroDire4[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroDire4[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroDire4[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroRadiant1[0]->HeroName;
		array_push($ReturnDire4, $ArrTmp);

		$ResWinMatch = DB::select($QueryWinLose, [ $ArrRadiantHero[0],$ArrDireHero[4]  ]);
		$ResLoseMatch = DB::select($QueryWinLose, [ $ArrDireHero[4],$ArrRadiantHero[0]  ]);
		if( ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) == 0 ) $WinRate = 0; else $WinRate = ( $ResWinMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroRadiant1[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroRadiant1[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroRadiant1[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroRadiant1[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroDire5[0]->HeroName;
		array_push($ReturnRadiant1, $ArrTmp);
		if( ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) == 0 ) $WinRate = 0; else $WinRate = ( $ResLoseMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroDire5[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroDire5[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroDire5[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroDire5[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroRadiant1[0]->HeroName;
		array_push($ReturnDire5, $ArrTmp);
		//================================================================================= Hero 1 (END) =======================================================

		//================================================================================= Hero 2 (BEGIN) =======================================================
		$ResWinMatch = DB::select($QueryWinLose, [ $ArrRadiantHero[1],$ArrDireHero[0]  ]);
		$ResLoseMatch = DB::select($QueryWinLose, [ $ArrDireHero[0],$ArrRadiantHero[1]  ]);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResWinMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroRadiant2[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroRadiant2[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroRadiant2[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroRadiant2[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroDire1[0]->HeroName;
		array_push($ReturnRadiant2, $ArrTmp);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResLoseMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroDire1[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroDire1[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroDire1[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroDire1[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroRadiant2[0]->HeroName;
		array_push($ReturnDire1, $ArrTmp);

		$ResWinMatch = DB::select($QueryWinLose, [ $ArrRadiantHero[1],$ArrDireHero[1]  ]);
		$ResLoseMatch = DB::select($QueryWinLose, [ $ArrDireHero[1],$ArrRadiantHero[1]  ]);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResWinMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroRadiant2[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroRadiant2[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroRadiant2[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroRadiant2[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroDire2[0]->HeroName;
		array_push($ReturnRadiant2, $ArrTmp);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResLoseMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroDire2[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroDire2[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroDire2[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroDire2[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroRadiant2[0]->HeroName;
		array_push($ReturnDire2, $ArrTmp);

		$ResWinMatch = DB::select($QueryWinLose, [ $ArrRadiantHero[1],$ArrDireHero[2]  ]);
		$ResLoseMatch = DB::select($QueryWinLose, [ $ArrDireHero[2],$ArrRadiantHero[1]  ]);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResWinMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroRadiant2[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroRadiant2[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroRadiant2[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroRadiant2[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroDire3[0]->HeroName;
		array_push($ReturnRadiant2, $ArrTmp);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResLoseMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroDire3[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroDire3[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroDire3[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroDire3[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroRadiant2[0]->HeroName;
		array_push($ReturnDire3, $ArrTmp);

		$ResWinMatch = DB::select($QueryWinLose, [ $ArrRadiantHero[1],$ArrDireHero[3]  ]);
		$ResLoseMatch = DB::select($QueryWinLose, [ $ArrDireHero[3],$ArrRadiantHero[1]  ]);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResWinMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroRadiant2[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroRadiant2[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroRadiant2[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroRadiant2[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroDire4[0]->HeroName;
		array_push($ReturnRadiant2, $ArrTmp);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResLoseMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroDire4[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroDire4[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroDire4[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroDire4[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroRadiant2[0]->HeroName;
		array_push($ReturnDire4, $ArrTmp);

		$ResWinMatch = DB::select($QueryWinLose, [ $ArrRadiantHero[1],$ArrDireHero[4]  ]);
		$ResLoseMatch = DB::select($QueryWinLose, [ $ArrDireHero[4],$ArrRadiantHero[1]  ]);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResWinMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroRadiant2[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroRadiant2[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroRadiant2[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroRadiant2[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroDire5[0]->HeroName;
		array_push($ReturnRadiant2, $ArrTmp);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResLoseMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroDire5[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroDire5[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroDire5[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroDire5[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroRadiant2[0]->HeroName;
		array_push($ReturnDire5, $ArrTmp);
		//================================================================================= Hero 2 (END) =======================================================

		//================================================================================= Hero 3 (BEGIN) =======================================================
		$ResWinMatch = DB::select($QueryWinLose, [ $ArrRadiantHero[2],$ArrDireHero[0]  ]);
		$ResLoseMatch = DB::select($QueryWinLose, [ $ArrDireHero[0],$ArrRadiantHero[2]  ]);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResWinMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroRadiant3[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroRadiant3[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroRadiant3[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroRadiant3[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroDire1[0]->HeroName;
		array_push($ReturnRadiant3, $ArrTmp);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResLoseMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroDire1[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroDire1[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroDire1[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroDire1[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroRadiant3[0]->HeroName;
		array_push($ReturnDire1, $ArrTmp);

		$ResWinMatch = DB::select($QueryWinLose, [ $ArrRadiantHero[2],$ArrDireHero[1]  ]);
		$ResLoseMatch = DB::select($QueryWinLose, [ $ArrDireHero[1],$ArrRadiantHero[2]  ]);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResWinMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroRadiant3[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroRadiant3[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroRadiant3[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroRadiant3[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroDire2[0]->HeroName;
		array_push($ReturnRadiant3, $ArrTmp);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResLoseMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroDire2[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroDire2[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroDire2[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroDire2[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroRadiant3[0]->HeroName;
		array_push($ReturnDire2, $ArrTmp);

		$ResWinMatch = DB::select($QueryWinLose, [ $ArrRadiantHero[2],$ArrDireHero[2]  ]);
		$ResLoseMatch = DB::select($QueryWinLose, [ $ArrDireHero[2],$ArrRadiantHero[2]  ]);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResWinMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroRadiant3[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroRadiant3[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroRadiant3[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroRadiant3[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroDire3[0]->HeroName;
		array_push($ReturnRadiant3, $ArrTmp);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResLoseMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroDire3[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroDire3[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroDire3[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroDire3[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroRadiant3[0]->HeroName;
		array_push($ReturnDire3, $ArrTmp);

		$ResWinMatch = DB::select($QueryWinLose, [ $ArrRadiantHero[2],$ArrDireHero[3]  ]);
		$ResLoseMatch = DB::select($QueryWinLose, [ $ArrDireHero[3],$ArrRadiantHero[2]  ]);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResWinMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroRadiant3[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroRadiant3[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroRadiant3[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroRadiant3[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroDire4[0]->HeroName;
		array_push($ReturnRadiant3, $ArrTmp);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResLoseMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroDire4[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroDire4[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroDire4[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroDire4[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroRadiant3[0]->HeroName;
		array_push($ReturnDire4, $ArrTmp);

		$ResWinMatch = DB::select($QueryWinLose, [ $ArrRadiantHero[2],$ArrDireHero[4]  ]);
		$ResLoseMatch = DB::select($QueryWinLose, [ $ArrDireHero[4],$ArrRadiantHero[2]  ]);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResWinMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroRadiant3[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroRadiant3[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroRadiant3[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroRadiant3[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroDire5[0]->HeroName;
		array_push($ReturnRadiant3, $ArrTmp);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResLoseMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroDire5[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroDire5[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroDire5[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroDire5[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroRadiant3[0]->HeroName;
		array_push($ReturnDire5, $ArrTmp);
		//================================================================================= Hero 3 (END) =======================================================

		//================================================================================= Hero 4 (BEGIN) =======================================================
		$ResWinMatch = DB::select($QueryWinLose, [ $ArrRadiantHero[3],$ArrDireHero[0]  ]);
		$ResLoseMatch = DB::select($QueryWinLose, [ $ArrDireHero[0],$ArrRadiantHero[3]  ]);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResWinMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroRadiant4[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroRadiant4[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroRadiant4[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroRadiant4[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroDire1[0]->HeroName;
		array_push($ReturnRadiant4, $ArrTmp);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResLoseMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroDire1[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroDire1[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroDire1[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroDire1[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroRadiant4[0]->HeroName;
		array_push($ReturnDire1, $ArrTmp);

		$ResWinMatch = DB::select($QueryWinLose, [ $ArrRadiantHero[3],$ArrDireHero[1]  ]);
		$ResLoseMatch = DB::select($QueryWinLose, [ $ArrDireHero[1],$ArrRadiantHero[3]  ]);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResWinMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroRadiant4[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroRadiant4[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroRadiant4[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroRadiant4[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroDire2[0]->HeroName;
		array_push($ReturnRadiant4, $ArrTmp);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResLoseMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroDire2[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroDire2[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroDire2[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroDire2[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroRadiant4[0]->HeroName;
		array_push($ReturnDire2, $ArrTmp);

		$ResWinMatch = DB::select($QueryWinLose, [ $ArrRadiantHero[3],$ArrDireHero[2]  ]);
		$ResLoseMatch = DB::select($QueryWinLose, [ $ArrDireHero[2],$ArrRadiantHero[3]  ]);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResWinMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroRadiant4[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroRadiant4[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroRadiant4[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroRadiant4[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroDire3[0]->HeroName;
		array_push($ReturnRadiant4, $ArrTmp);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResLoseMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroDire3[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroDire3[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroDire3[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroDire3[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroRadiant4[0]->HeroName;
		array_push($ReturnDire3, $ArrTmp);

		$ResWinMatch = DB::select($QueryWinLose, [ $ArrRadiantHero[3],$ArrDireHero[3]  ]);
		$ResLoseMatch = DB::select($QueryWinLose, [ $ArrDireHero[3],$ArrRadiantHero[3]  ]);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResWinMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroRadiant4[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroRadiant4[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroRadiant4[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroRadiant4[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroDire4[0]->HeroName;
		array_push($ReturnRadiant4, $ArrTmp);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResLoseMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroDire4[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroDire4[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroDire4[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroDire4[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroRadiant4[0]->HeroName;
		array_push($ReturnDire4, $ArrTmp);

		$ResWinMatch = DB::select($QueryWinLose, [ $ArrRadiantHero[3],$ArrDireHero[4]  ]);
		$ResLoseMatch = DB::select($QueryWinLose, [ $ArrDireHero[4],$ArrRadiantHero[3]  ]);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResWinMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroRadiant4[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroRadiant4[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroRadiant4[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroRadiant4[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroDire5[0]->HeroName;
		array_push($ReturnRadiant4, $ArrTmp);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResLoseMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroDire5[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroDire5[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroDire5[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroDire5[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroRadiant4[0]->HeroName;
		array_push($ReturnDire5, $ArrTmp);		
		//================================================================================= Hero 4 (END) =======================================================

		//================================================================================= Hero 5 (BEGIN) =======================================================
		$ResWinMatch = DB::select($QueryWinLose, [ $ArrRadiantHero[4],$ArrDireHero[0]  ]);
		$ResLoseMatch = DB::select($QueryWinLose, [ $ArrDireHero[0],$ArrRadiantHero[4]  ]);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResWinMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroRadiant5[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroRadiant5[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroRadiant5[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroRadiant5[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroDire1[0]->HeroName;
		array_push($ReturnRadiant5, $ArrTmp);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResLoseMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroDire1[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroDire1[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroDire1[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroDire1[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroRadiant5[0]->HeroName;
		array_push($ReturnDire1, $ArrTmp);

		$ResWinMatch = DB::select($QueryWinLose, [ $ArrRadiantHero[4],$ArrDireHero[1]  ]);
		$ResLoseMatch = DB::select($QueryWinLose, [ $ArrDireHero[1],$ArrRadiantHero[4]  ]);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResWinMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroRadiant5[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroRadiant5[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroRadiant5[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroRadiant5[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroDire2[0]->HeroName;
		array_push($ReturnRadiant5, $ArrTmp);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResLoseMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroDire2[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroDire2[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroDire2[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroDire2[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroRadiant5[0]->HeroName;
		array_push($ReturnDire2, $ArrTmp);

		$ResWinMatch = DB::select($QueryWinLose, [ $ArrRadiantHero[4],$ArrDireHero[2]  ]);
		$ResLoseMatch = DB::select($QueryWinLose, [ $ArrDireHero[2],$ArrRadiantHero[4]  ]);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResWinMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroRadiant5[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroRadiant5[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroRadiant5[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroRadiant5[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroDire3[0]->HeroName;
		array_push($ReturnRadiant5, $ArrTmp);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResLoseMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroDire3[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroDire3[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroDire3[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroDire3[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroRadiant5[0]->HeroName;
		array_push($ReturnDire3, $ArrTmp);	

		$ResWinMatch = DB::select($QueryWinLose, [ $ArrRadiantHero[4],$ArrDireHero[3]  ]);
		$ResLoseMatch = DB::select($QueryWinLose, [ $ArrDireHero[3],$ArrRadiantHero[4]  ]);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResWinMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroRadiant5[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroRadiant5[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroRadiant5[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroRadiant5[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroDire4[0]->HeroName;
		array_push($ReturnRadiant5, $ArrTmp);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResLoseMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroDire4[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroDire4[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroDire4[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroDire4[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroRadiant5[0]->HeroName;
		array_push($ReturnDire4, $ArrTmp);

		$ResWinMatch = DB::select($QueryWinLose, [ $ArrRadiantHero[4],$ArrDireHero[4]  ]);
		$ResLoseMatch = DB::select($QueryWinLose, [ $ArrDireHero[4],$ArrRadiantHero[4]  ]);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResWinMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroRadiant5[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroRadiant5[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroRadiant5[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroRadiant5[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroDire5[0]->HeroName;
		array_push($ReturnRadiant5, $ArrTmp);
		if( ($ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah) == 0 ) $WinRate = 0; else $WinRate = ( $ResLoseMatch[0]->Jumlah / ( $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah ) ) * 100;
		$ArrTmp = array();
		$ArrTmp['WinRate'] = round($WinRate,1);
		$ArrTmp['TotalMatch'] = $ResWinMatch[0]->Jumlah + $ResLoseMatch[0]->Jumlah;
		$ArrTmp['Hero'] = $InfoHeroDire5[0]->HeroName;
		$ArrTmp['Picture'] = $InfoHeroDire5[0]->Picture;
		$ArrTmp['AttackType'] = $InfoHeroDire5[0]->AttackType;
		$ArrTmp['Roles'] = $InfoHeroDire5[0]->Roles;
		$ArrTmp['HeroAgainst'] = $InfoHeroRadiant5[0]->HeroName;
		array_push($ReturnDire5, $ArrTmp);		
		//================================================================================= Hero 5 (END) =======================================================


		//dd(array( $ReturnRadiant1, $ReturnDire1, $ReturnDire2 ));
		return view('dota_analysis_result', compact(
			'ReturnRadiant1',
			'ReturnRadiant2',
			'ReturnRadiant3',
			'ReturnRadiant4',
			'ReturnRadiant5',
			'ReturnDire1',
			'ReturnDire2',
			'ReturnDire3',
			'ReturnDire4',
			'ReturnDire5',
			'InfoHeroRolesRadiant',
			'InfoHeroRolesDire'
		));
	}

}