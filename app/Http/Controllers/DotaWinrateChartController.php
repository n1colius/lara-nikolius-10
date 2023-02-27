<?php
/**
 * @authors Nikolius Lau (n1colius.lau@gmail.com)
 * @date    2021-08-17 22:22:36
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DotaWinrateChartController extends Controller
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

        return view('dota_winrate_chart', compact(
            'cmb_hero'
        ));
    }

    public function display(Request $request)
    {
        $SelHero = (int) $request->get('sel_hero');

        //Get Nama Hero
        $QueryInfoHero = "SELECT
                            a.`HeroName`
                        FROM
                            `dota_heroes` a
                        WHERE 1=1
                            AND a.`HeroID` = ?
                        LIMIT 1";
        $InfoHero = DB::select($QueryInfoHero, [ $SelHero ]);
        $HeroName = $InfoHero[0]->HeroName;

        //bar-chart ======== (Begin)
        $c1QueryHeroWin = "SELECT
                                    a.`HeroIDWin`
                                    , a.`HeroIDLose`
                                    , b.`HeroName` AS HeroNameLose
                                    , COUNT(a.`HeroIDLose`) AS LoseCount
                                FROM
                                    `dota_matches_heroes_winstats` a
                                    LEFT JOIN dota_heroes b ON a.`HeroIDLose` = b.`HeroID`
                                WHERE 1=1
                                    AND a.`HeroIDWin` = ?
                                GROUP BY a.`HeroIDLose`
                                ORDER BY LoseCount DESC";
        $c1DataHeroWin = DB::select($c1QueryHeroWin, [ $SelHero ]);
        
        $c1QueryHeroLose = "SELECT
                                a.`HeroIDLose`
                                , a.`HeroIDWin`
                                , COUNT(a.`HeroIDWin`) AS WinCount
                            FROM
                                dota_matches_heroes_winstats a
                            WHERE 1=1
                                AND a.`HeroIDLose` = ?
                            GROUP BY a.`HeroIDWin`
                            ORDER BY WinCount DESC";
        $c1DataHeroLose = DB::select($c1QueryHeroLose, [ $SelHero ]);
        $c1DataHeroLoseMapping = array();
        for ($i=0; $i < count($c1DataHeroLose); $i++) { 
            $c1DataHeroLoseMapping[$c1DataHeroLose[$i]->HeroIDWin]['WinCount'] = $c1DataHeroLose[$i]->WinCount;
        }
        //echo '<pre>'; print_r($c1DataHeroLoseMapping); exit;
        
            //Susun data array ====== (Begin)
            $BarChartArray = array();
            for ($i=0; $i < count($c1DataHeroWin); $i++) {
                //echo $c1DataHeroWin[$i]->HeroIDLose.'<br>';
                //echo '<pre>'; print_r($c1DataHeroWin);
                if(!empty($c1DataHeroLoseMapping[$c1DataHeroWin[$i]->HeroIDLose])) {
                    $c1DataHeroWin[$i]->LoseAgainstCount = $c1DataHeroLoseMapping[$c1DataHeroWin[$i]->HeroIDLose]['WinCount'];
                } else {
                    $c1DataHeroWin[$i]->LoseAgainstCount = 0;
                }

                $TotalMatchCount = $c1DataHeroWin[$i]->LoseCount + $c1DataHeroWin[$i]->LoseAgainstCount;
                $c1DataHeroWin[$i]->TotalMatchCount = $TotalMatchCount;

                $Percentage = ($c1DataHeroWin[$i]->LoseCount / $c1DataHeroWin[$i]->TotalMatchCount) * 100;
                $c1DataHeroWin[$i]->Percentage = round($Percentage,2);

                //Buat data jadi full array agar gampang di proses sort nantinya, yg proses hanya data yg diatas 6 match
                if($c1DataHeroWin[$i]->TotalMatchCount >= 6) {
                    $BarChartArray[$i]['HeroIDWin'] = $c1DataHeroWin[$i]->HeroIDWin;
                    $BarChartArray[$i]['HeroIDLose'] = $c1DataHeroWin[$i]->HeroIDLose;
                    $BarChartArray[$i]['HeroNameLose'] = $c1DataHeroWin[$i]->HeroNameLose;
                    $BarChartArray[$i]['LoseCount'] = $c1DataHeroWin[$i]->LoseCount;
                    $BarChartArray[$i]['LoseAgainstCount'] = $c1DataHeroWin[$i]->LoseAgainstCount;
                    $BarChartArray[$i]['TotalMatchCount'] = $c1DataHeroWin[$i]->TotalMatchCount;
                    $BarChartArray[$i]['Percentage'] = $c1DataHeroWin[$i]->Percentage;
                }
            }
            //echo '<pre>'; print_r($c1DataHeroWin); exit;
            //echo '<pre>'; print_r($BarChartArray); exit;
            //Susun data array ====== (End)
            
            //sorting array cari Top 10 nya ======= (Begin)
            usort($BarChartArray, function($a, $b) {
                return $a['Percentage'] <=> $b['Percentage'];
            });
            $BarChartArray = array_slice(array_reverse($BarChartArray), 0, 10);
            //echo '<pre>'; print_r($BarChartArray); exit;
            //sorting array cari Top 10 nya ======= (End)

            $BarChartArrayLabel = array();
            $BarChartArrayDataChart = array();

            for ($i=0; $i < count($BarChartArray); $i++) { 
                $BarChartArrayLabel[$i] = $BarChartArray[$i]['HeroNameLose'];
                $BarChartArrayDataChart[$i] = $BarChartArray[$i]['Percentage'];
            }
        //bar-chart ======== (End)

        //bar-chart-1 ======== (Begin)
        $c2QueryHeroWin = "SELECT
                                a.`HeroIDLose`
                                , a.`HeroIDWin`
                                , b.`HeroName` AS HeroNameWin
                                , COUNT(a.`HeroIDWin`) AS WinCount
                            FROM
                                `dota_matches_heroes_winstats` a
                                LEFT JOIN dota_heroes b ON a.`HeroIDWin` = b.`HeroID`
                            WHERE 1=1
                                AND a.`HeroIDLose` = ?
                            GROUP BY a.`HeroIDWin`
                            ORDER BY WinCount DESC";
        $c2DataHeroWin = DB::select($c2QueryHeroWin, [ $SelHero ]);

        $c2QueryHeroLose = "SELECT
                                a.`HeroIDWin`
                                , a.`HeroIDLose`
                                , COUNT(a.`HeroIDLose`) AS LoseCount
                            FROM
                                dota_matches_heroes_winstats a
                            WHERE 1=1
                                AND a.`HeroIDWin` = ?
                            GROUP BY a.`HeroIDLose`
                            ORDER BY LoseCount DESC";
        $c2DataHeroLose = DB::select($c2QueryHeroLose, [ $SelHero ]);
        $c2DataHeroLoseMapping = array();
        for ($i=0; $i < count($c2DataHeroLose); $i++) { 
            $c2DataHeroLoseMapping[$c2DataHeroLose[$i]->HeroIDLose]['LoseCount'] = $c2DataHeroLose[$i]->LoseCount;
        }
        //echo '<pre>'; print_r($c2DataHeroLoseMapping); exit;

            //Susun data array ====== (Begin)
            $BarChart1Array = array();
            for ($i=0; $i < count($c2DataHeroWin); $i++) {
                if(!empty($c2DataHeroLoseMapping[$c2DataHeroWin[$i]->HeroIDWin])) {
                    $c2DataHeroWin[$i]->WinAgainstCount = $c2DataHeroLoseMapping[$c2DataHeroWin[$i]->HeroIDWin]['LoseCount'];
                } else {
                    $c2DataHeroWin[$i]->WinAgainstCount = 0;
                }

                $TotalMatchCount = $c2DataHeroWin[$i]->WinCount + $c2DataHeroWin[$i]->WinAgainstCount;
                $c2DataHeroWin[$i]->TotalMatchCount = $TotalMatchCount;

                $Percentage = ($c2DataHeroWin[$i]->WinCount / $c2DataHeroWin[$i]->TotalMatchCount) * 100;
                $c2DataHeroWin[$i]->Percentage = round($Percentage,2);

                //Buat data jadi full array agar gampang di proses sort nantinya, yg proses hanya data yg diatas 6 match
                if($c2DataHeroWin[$i]->TotalMatchCount >= 6) {
                    $BarChart1Array[$i]['HeroIDWin'] = $c2DataHeroWin[$i]->HeroIDWin;
                    $BarChart1Array[$i]['HeroIDLose'] = $c2DataHeroWin[$i]->HeroIDLose;
                    $BarChart1Array[$i]['HeroNameWin'] = $c2DataHeroWin[$i]->HeroNameWin;
                    $BarChart1Array[$i]['WinCount'] = $c2DataHeroWin[$i]->WinCount;
                    $BarChart1Array[$i]['WinAgainstCount'] = $c2DataHeroWin[$i]->WinAgainstCount;
                    $BarChart1Array[$i]['TotalMatchCount'] = $c2DataHeroWin[$i]->TotalMatchCount;
                    $BarChart1Array[$i]['Percentage'] = $c2DataHeroWin[$i]->Percentage;
                }
            }
            //Susun data array ====== (End)
            //echo '<pre>'; print_r($c2DataHeroWin); exit;

            //sorting array cari Top 10 nya ======= (Begin)
            usort($BarChart1Array, function($a, $b) {
                return $a['Percentage'] <=> $b['Percentage'];
            });
            $BarChart1Array = array_slice(array_reverse($BarChart1Array), 0, 10);
            //echo '<pre>'; print_r($BarChart1Array); exit;
            //sorting array cari Top 10 nya ======= (End)

            $BarChart1ArrayLabel = array();
            $BarChart1ArrayDataChart = array();

            for ($i=0; $i < count($BarChart1Array); $i++) { 
                $BarChart1ArrayLabel[$i] = $BarChart1Array[$i]['HeroNameWin'];
                $BarChart1ArrayDataChart[$i] = $BarChart1Array[$i]['Percentage'];
            }
        //bar-chart-1 ======== (End)

        //bar-chart-2 ======== (Begin)

        //Ambil data match nya
        $c2QueryDataMatch = "SELECT
                            a.`MatchID`
                            , a.`HeroIDWin`
                        FROM
                            dota_matches_heroes_winstats a
                        WHERE 1=1
                            AND a.`HeroIDWin` = ?
                        GROUP BY a.`MatchID`, a.`HeroIDWin`";
        $c2DataMatch = DB::select($c2QueryDataMatch, [ $SelHero ]);

        //Buat Array all hero dengan heroid sebagai keynya
        $c2ArrayAllHero = array_all_hero();

        for ($i=0; $i < count($c2DataMatch); $i++) { 
            //query teman win nya hero selected
            $c2QueryAllyWin = "SELECT
                                    DISTINCT a.`HeroIDWin`
                                FROM
                                    dota_matches_heroes_winstats a
                                WHERE 1=1
                                    AND a.`MatchID` = ?
                                    AND a.`HeroIDWin` != ?";
            $c2DataAllyWin = DB::select($c2QueryAllyWin, [$c2DataMatch[$i]->MatchID, $SelHero]);
            //dd($c2DataAllyWin);

            for ($k=0; $k < count($c2DataAllyWin); $k++) { 
                $c2ArrayAllHero[$c2DataAllyWin[$k]->HeroIDWin]++;
            }
        }
        //dd($c2ArrayAllHero);

        //Sort cari yg terbanyak
        uasort($c2ArrayAllHero, function($a, $b) {
            return $b <=> $a;
        });
        //dd($c2ArrayAllHero);

        //slice first 15 values
        $c2ArrayAllHero = array_slice($c2ArrayAllHero, 0, 15, true);
        //dd($c2ArrayAllHero);

        //proses ke variabel send to view
        $BarChart2ArrayDataChart = array();
        $BarChart2ArrayLabel = array();
        foreach($c2ArrayAllHero as $key => $val) {
            $BarChart2ArrayDataChart[] = $val;

            //cari nama hero
            $sql = "SELECT
                        a.`HeroName`
                    FROM
                        `dota_heroes` a
                    WHERE 1=1
                        AND a.`HeroID` = ?
                    LIMIT 1";
            $c2DataHeroName = DB::select($sql, [ $key ]);
            $BarChart2ArrayLabel[] = $c2DataHeroName[0]->HeroName;
        }
        //bar-chart-2 ======== (End)

        $data = array();
        return view('dota_winrate_chart_display', compact(
            'HeroName',
            'BarChartArrayLabel',
            'BarChartArrayDataChart',
            'BarChart1ArrayLabel',
            'BarChart1ArrayDataChart',
            'BarChart2ArrayLabel',
            'BarChart2ArrayDataChart'
        ));
    }

}