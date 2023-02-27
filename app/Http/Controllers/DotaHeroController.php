<?php
/**
 * @authors Nikolius Lau (n1colius.lau@gmail.com)
 * @date    2021-08-05 23:14:58
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DotaHeroController extends Controller
{
	public function index(Request $request)
	{
		//get param
		$filtersearch = $request->get('search');
		
		if($filtersearch != "") {
			$arrfiltersearch = explode(',',$filtersearch);
			$tmp = array();

			foreach($arrfiltersearch as $value) {
				$tmp[] = (int) $value;
			}

			$SqlWhereValue = " AND a.HeroID IN (".implode(",",$tmp).") ";
		} else {
			$SqlWhereValue = "";
		}

		//combo hero
		$sql = "SELECT
					a.HeroID AS id
					, a.HeroName AS label
				FROM
					dota_heroes a
				WHERE 1=1
				ORDER BY a.`HeroName` ASC";
		$cmb_hero = DB::select($sql, []);


		//hero str
		$sql = "SELECT
					a.`HeroID`
					, a.`HeroName`
					, a.`Picture`
					, a.`AttackType`
					, GROUP_CONCAT(DISTINCT b.`Roles` SEPARATOR ', ') AS HeroRoles
					, GROUP_CONCAT(DISTINCT c.`Notes` SEPARATOR '@@') AS HeroNotes
				FROM
					dota_heroes a
					LEFT JOIN dota_heroes_roles b ON a.`HeroID` = b.`HeroID`
					LEFT JOIN dota_heroes_notes c ON a.`HeroID` = c.`HeroID`
				WHERE 1=1
					AND a.`PrimAttr` = 'str'
					$SqlWhereValue
				GROUP BY a.`HeroID`";
		$data_hero_str = DB::select($sql, []);


		//hero agi
		$sql = "SELECT
					a.`HeroID`
					, a.`HeroName`
					, a.`Picture`
					, a.`AttackType`
					, GROUP_CONCAT(DISTINCT b.`Roles` SEPARATOR ', ') AS HeroRoles
					, GROUP_CONCAT(DISTINCT c.`Notes` SEPARATOR '@@') AS HeroNotes
				FROM
					dota_heroes a
					LEFT JOIN dota_heroes_roles b ON a.`HeroID` = b.`HeroID`
					LEFT JOIN dota_heroes_notes c ON a.`HeroID` = c.`HeroID`
				WHERE 1=1
					AND a.`PrimAttr` = 'agi'
					$SqlWhereValue
				GROUP BY a.`HeroID`";
		$data_hero_agi = DB::select($sql, []);


		//hero int
		$sql = "SELECT
					a.`HeroID`
					, a.`HeroName`
					, a.`Picture`
					, a.`AttackType`
					, GROUP_CONCAT(DISTINCT b.`Roles` SEPARATOR ', ') AS HeroRoles
					, GROUP_CONCAT(DISTINCT c.`Notes` SEPARATOR '@@') AS HeroNotes
				FROM
					dota_heroes a
					LEFT JOIN dota_heroes_roles b ON a.`HeroID` = b.`HeroID`
					LEFT JOIN dota_heroes_notes c ON a.`HeroID` = c.`HeroID`
				WHERE 1=1
					AND a.`PrimAttr` = 'int'
					$SqlWhereValue
				GROUP BY a.`HeroID`";
		$data_hero_int = DB::select($sql, []);


		return view('dotahero', compact(
			'cmb_hero',
			'filtersearch',
			'data_hero_str',
			'data_hero_agi',
			'data_hero_int'
		));
	}

}