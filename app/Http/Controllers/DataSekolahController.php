<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DataSekolahController extends Controller
{

    public function index(Request $request)
    {
        $combo_propinsi = array();
        $combo_kabupaten = array();
        $data_dashlet = array();
        $data_pie_negeri_swasta = array();
        $data_pie_sd_smp_sma_smk = array();
        $data_pie_sdlb_smplb_smlb_slb = array();
        $group_bar_chart = 'provinsi'; // provinsi || kabupaten || kecamatan
        
        $kode_prop = $request->input('kode_prop'); if($kode_prop == "") $kode_prop = "10000";
        $kode_kab_kota = $request->input('kode_kab_kota'); if($kode_kab_kota == "") $kode_kab_kota = "all";

        $jumlah_sd_label = array();
        $jumlah_sd_data_chart = array();
        $jumlah_smp_label = array();
        $jumlah_smp_data_chart = array();
        $jumlah_sma_label = array();
        $jumlah_sma_data_chart = array();
        $jumlah_smk_label = array();
        $jumlah_smk_data_chart = array();
        $jumlah_sdlb_label = array();
        $jumlah_sdlb_data_chart = array();
        $jumlah_smplb_label = array();
        $jumlah_smplb_data_chart = array();
        $jumlah_smlb_label = array();
        $jumlah_smlb_data_chart = array();
        $jumlah_slb_label = array();
        $jumlah_slb_data_chart = array();

        //=============== Process Data ======================================= (BEGIN) ========================//
        $sql = "SELECT
                    DISTINCT a.`kode_prop` AS id
                    , a.`propinsi` AS label
                FROM
                    `skl_raw` a
                WHERE 1=1
                ORDER BY a.`kode_prop` ASC";
        $combo_propinsi = DB::select($sql, []);

        //query data dashlet
        $sql = 'select
                    sum(if(a.`bentuk`="SD",1,0)) as "dash-jumlah-sd"
                    , sum(if(a.`bentuk`="SMP",1,0)) as "dash-jumlah-smp"
                    , sum(if(a.`bentuk`="SMA",1,0)) as "dash-jumlah-sma"
                    , sum(if(a.`bentuk`="SMK",1,0)) as "dash-jumlah-smk"
                    , sum(if(a.`bentuk`="SDLB",1,0)) as "dash-jumlah-sdlb"
                    , sum(if(a.`bentuk`="SMPLB",1,0)) as "dash-jumlah-smplb"
                    , SUM(if(a.`bentuk`="SMLB",1,0)) as "dash-jumlah-smlb"
                    , SUM(IF(a.`bentuk`="SLB",1,0)) as "dash-jumlah-slb"
                    , SUM(IF(a.`status`="N",1,0)) AS "dash-jumlah-negeri"
                    , SUM(IF(a.`status`="S",1,0)) AS "dash-jumlah-swasta"
                from
                    skl_raw a
                where 1=1
                    and ( (a.`kode_prop` = ?) or ("all" = ?) )
                    AND ( (a.`kode_kab_kota` = ?) OR ("all" = ?) )
                ';
        $query_dash = DB::select($sql, [$kode_prop,$kode_prop,$kode_kab_kota,$kode_kab_kota]);
        $data_dashlet = (array) $query_dash[0];

        //query data koordinat sd
        $sql = 'SELECT
                    a.`sekolah`
                    , a.`npsn`
                    , a.`lintang` AS Latitude
                    , a.`bujur` AS Longitude
                FROM
                    skl_raw a
                WHERE 1=1
                    and ( (a.`kode_prop` = ?) or ("all" = ?) )
                    AND ( (a.`kode_kab_kota` = ?) OR ("all" = ?) )
                    AND a.`bentuk` = "SD"
                    AND a.`lintang` IS NOT NULL
                    AND a.`bujur` IS NOT NULL
                ORDER BY a.`npsn`
                ';
        $data_koor_sd = DB::select($sql, [$kode_prop,$kode_prop,$kode_kab_kota,$kode_kab_kota]);

        //query data koordinat smp
        $sql = 'SELECT
                    a.`sekolah`
                    , a.`npsn`
                    , a.`lintang` AS Latitude
                    , a.`bujur` AS Longitude
                FROM
                    skl_raw a
                WHERE 1=1
                    and ( (a.`kode_prop` = ?) or ("all" = ?) )
                    AND ( (a.`kode_kab_kota` = ?) OR ("all" = ?) )
                    AND a.`bentuk` = "SMP"
                    AND a.`lintang` IS NOT NULL
                    AND a.`bujur` IS NOT NULL
                ORDER BY a.`npsn`
                ';
        $data_koor_smp = DB::select($sql, [$kode_prop,$kode_prop,$kode_kab_kota,$kode_kab_kota]);

        //query data koordinat sma
        $sql = 'SELECT
                    a.`sekolah`
                    , a.`npsn`
                    , a.`lintang` AS Latitude
                    , a.`bujur` AS Longitude
                FROM
                    skl_raw a
                WHERE 1=1
                    and ( (a.`kode_prop` = ?) or ("all" = ?) )
                    AND ( (a.`kode_kab_kota` = ?) OR ("all" = ?) )
                    AND a.`bentuk` = "SMA"
                    AND a.`lintang` IS NOT NULL
                    AND a.`bujur` IS NOT NULL
                ORDER BY a.`npsn`
                ';
        $data_koor_sma = DB::select($sql, [$kode_prop,$kode_prop,$kode_kab_kota,$kode_kab_kota]);

        //query data koordiant smk
        $sql = 'SELECT
                    a.`sekolah`
                    , a.`npsn`
                    , a.`lintang` AS Latitude
                    , a.`bujur` AS Longitude
                FROM
                    skl_raw a
                WHERE 1=1
                    and ( (a.`kode_prop` = ?) or ("all" = ?) )
                    AND ( (a.`kode_kab_kota` = ?) OR ("all" = ?) )
                    AND a.`bentuk` = "SMK"
                    AND a.`lintang` IS NOT NULL
                    AND a.`bujur` IS NOT NULL
                ORDER BY a.`npsn`
                ';
        $data_koor_smk = DB::select($sql, [$kode_prop,$kode_prop,$kode_kab_kota,$kode_kab_kota]);


        //data untuk pie chart
        $data_pie_negeri_swasta = [$data_dashlet['dash-jumlah-negeri'], $data_dashlet['dash-jumlah-swasta']];
        $data_pie_sd_smp_sma_smk = [$data_dashlet['dash-jumlah-sd'],$data_dashlet['dash-jumlah-smp'],$data_dashlet['dash-jumlah-sma'],$data_dashlet['dash-jumlah-smk']];
        $data_pie_sdlb_smplb_smlb_slb = [$data_dashlet['dash-jumlah-sdlb'],$data_dashlet['dash-jumlah-smplb'],$data_dashlet['dash-jumlah-smlb'],$data_dashlet['dash-jumlah-slb']];


        //tentukan group region untuk bar-chart (begin)
        if($kode_prop == "all" && $kode_kab_kota == "all") {
            $group_bar_chart = "Provinsi";
            $sql_sel_bar_chart = "a.`kode_prop` AS id, a.`propinsi` AS label";
            $sql_group_bar_chart = "GROUP BY a.`kode_prop`";
        } else {
            if($kode_prop != "all" && $kode_kab_kota == "all") {
                $group_bar_chart = "Kabupaten";
                $sql_sel_bar_chart = "a.`kode_kab_kota` AS id, a.`kabupaten_kota` AS label";
                $sql_group_bar_chart = "GROUP BY a.`kode_kab_kota`";
            } else {
                $group_bar_chart = "Kecamatan";
                $sql_sel_bar_chart = "a.`kode_kec` AS id, a.`kecamatan` AS label";
                $sql_group_bar_chart = "GROUP BY a.`kode_kec`";
            }
        }
        //tentukan group region untuk bar-chart (end)

        //query for barchart =========================================== (begin)

        //jumlah_sd
        $sql = 'SELECT
                    '.$sql_sel_bar_chart.'
                    , SUM(IF(a.`bentuk`="SD",1,0)) AS jumlah_sd
                FROM
                    skl_raw a
                WHERE 1=1
                    and ( (a.`kode_prop` = ?) or ("all" = ?) )
                    AND ( (a.`kode_kab_kota` = ?) OR ("all" = ?) )
                '.$sql_group_bar_chart.'
                ORDER BY jumlah_sd DESC
                LIMIT 10';
        $data_bar_jumlah_sd = DB::select($sql, [$kode_prop,$kode_prop,$kode_kab_kota,$kode_kab_kota]);
        for ($i=0; $i < count($data_bar_jumlah_sd); $i++) {
            $jumlah_sd_label[$i] = $data_bar_jumlah_sd[$i]->label;
            $jumlah_sd_data_chart[$i] = $data_bar_jumlah_sd[$i]->jumlah_sd;
        }

        //jumlah_smp
        $sql = 'SELECT
                    '.$sql_sel_bar_chart.'
                    , SUM(IF(a.`bentuk`="SMP",1,0)) AS jumlah_smp
                FROM
                    skl_raw a
                WHERE 1=1
                    and ( (a.`kode_prop` = ?) or ("all" = ?) )
                    AND ( (a.`kode_kab_kota` = ?) OR ("all" = ?) )
                '.$sql_group_bar_chart.'
                ORDER BY jumlah_smp DESC
                LIMIT 10';
        $data_bar_jumlah_smp = DB::select($sql, [$kode_prop,$kode_prop,$kode_kab_kota,$kode_kab_kota]);
        for ($i=0; $i < count($data_bar_jumlah_smp); $i++) {
            $jumlah_smp_label[$i] = $data_bar_jumlah_smp[$i]->label;
            $jumlah_smp_data_chart[$i] = $data_bar_jumlah_smp[$i]->jumlah_smp;
        }

        //jumlah_sma
        $sql = 'SELECT
                    '.$sql_sel_bar_chart.'
                    , SUM(IF(a.`bentuk`="SMA",1,0)) AS jumlah_sma
                FROM
                    skl_raw a
                WHERE 1=1
                    and ( (a.`kode_prop` = ?) or ("all" = ?) )
                    AND ( (a.`kode_kab_kota` = ?) OR ("all" = ?) )
                '.$sql_group_bar_chart.'
                ORDER BY jumlah_sma DESC
                LIMIT 10';
        $data_bar_jumlah_sma = DB::select($sql, [$kode_prop,$kode_prop,$kode_kab_kota,$kode_kab_kota]);
        for ($i=0; $i < count($data_bar_jumlah_sma); $i++) {
            $jumlah_sma_label[$i] = $data_bar_jumlah_sma[$i]->label;
            $jumlah_sma_data_chart[$i] = $data_bar_jumlah_sma[$i]->jumlah_sma;
        }

        //jumlah smk
        $sql = 'SELECT
                    '.$sql_sel_bar_chart.'
                    , SUM(IF(a.`bentuk`="SMK",1,0)) AS jumlah_smk
                FROM
                    skl_raw a
                WHERE 1=1
                    and ( (a.`kode_prop` = ?) or ("all" = ?) )
                    AND ( (a.`kode_kab_kota` = ?) OR ("all" = ?) )
                '.$sql_group_bar_chart.'
                ORDER BY jumlah_smk DESC
                LIMIT 10';
        $data_bar_jumlah_smk = DB::select($sql, [$kode_prop,$kode_prop,$kode_kab_kota,$kode_kab_kota]);
        for ($i=0; $i < count($data_bar_jumlah_smk); $i++) {
            $jumlah_smk_label[$i] = $data_bar_jumlah_smk[$i]->label;
            $jumlah_smk_data_chart[$i] = $data_bar_jumlah_smk[$i]->jumlah_smk;
        }

        //jumlah sdlb
        $sql = 'SELECT
                    '.$sql_sel_bar_chart.'
                    , SUM(IF(a.`bentuk`="SDLB",1,0)) AS jumlah_sdlb
                FROM
                    skl_raw a
                WHERE 1=1
                    and ( (a.`kode_prop` = ?) or ("all" = ?) )
                    AND ( (a.`kode_kab_kota` = ?) OR ("all" = ?) )
                '.$sql_group_bar_chart.'
                ORDER BY jumlah_sdlb DESC
                LIMIT 10';
        $data_bar_jumlah_sdlb = DB::select($sql, [$kode_prop,$kode_prop,$kode_kab_kota,$kode_kab_kota]);
        for ($i=0; $i < count($data_bar_jumlah_sdlb); $i++) {
            $jumlah_sdlb_label[$i] = $data_bar_jumlah_sdlb[$i]->label;
            $jumlah_sdlb_data_chart[$i] = $data_bar_jumlah_sdlb[$i]->jumlah_sdlb;
        }

        //jumlah smplb
        $sql = 'SELECT
                    '.$sql_sel_bar_chart.'
                    , SUM(IF(a.`bentuk`="SMPLB",1,0)) AS jumlah_smplb
                FROM
                    skl_raw a
                WHERE 1=1
                    and ( (a.`kode_prop` = ?) or ("all" = ?) )
                    AND ( (a.`kode_kab_kota` = ?) OR ("all" = ?) )
                '.$sql_group_bar_chart.'
                ORDER BY jumlah_smplb DESC
                LIMIT 10';
        $data_bar_jumlah_smplb = DB::select($sql, [$kode_prop,$kode_prop,$kode_kab_kota,$kode_kab_kota]);
        for ($i=0; $i < count($data_bar_jumlah_smplb); $i++) {
            $jumlah_smplb_label[$i] = $data_bar_jumlah_smplb[$i]->label;
            $jumlah_smplb_data_chart[$i] = $data_bar_jumlah_smplb[$i]->jumlah_smplb;
        }

        //jumlah smlb
        $sql = 'SELECT
                    '.$sql_sel_bar_chart.'
                    , SUM(IF(a.`bentuk`="SMLB",1,0)) AS jumlah_smlb
                FROM
                    skl_raw a
                WHERE 1=1
                    and ( (a.`kode_prop` = ?) or ("all" = ?) )
                    AND ( (a.`kode_kab_kota` = ?) OR ("all" = ?) )
                '.$sql_group_bar_chart.'
                ORDER BY jumlah_smlb DESC
                LIMIT 10';
        $data_bar_jumlah_smlb = DB::select($sql, [$kode_prop,$kode_prop,$kode_kab_kota,$kode_kab_kota]);
        for ($i=0; $i < count($data_bar_jumlah_smlb); $i++) {
            $jumlah_smlb_label[$i] = $data_bar_jumlah_smlb[$i]->label;
            $jumlah_smlb_data_chart[$i] = $data_bar_jumlah_smlb[$i]->jumlah_smlb;
        }

        //jumlah slb
        $sql = 'SELECT
                    '.$sql_sel_bar_chart.'
                    , SUM(IF(a.`bentuk`="SLB",1,0)) AS jumlah_slb
                FROM
                    skl_raw a
                WHERE 1=1
                    and ( (a.`kode_prop` = ?) or ("all" = ?) )
                    AND ( (a.`kode_kab_kota` = ?) OR ("all" = ?) )
                '.$sql_group_bar_chart.'
                ORDER BY jumlah_slb DESC
                LIMIT 10';
        $data_bar_jumlah_slb = DB::select($sql, [$kode_prop,$kode_prop,$kode_kab_kota,$kode_kab_kota]);
        for ($i=0; $i < count($data_bar_jumlah_slb); $i++) {
            $jumlah_slb_label[$i] = $data_bar_jumlah_slb[$i]->label;
            $jumlah_slb_data_chart[$i] = $data_bar_jumlah_slb[$i]->jumlah_slb;
        }        

        //query for barchart =========================================== (end)


        //=============== Process Data ======================================= (END)   ========================//

        return view('data_sekolah', compact(
            'combo_propinsi',
            'combo_kabupaten',
            'jumlah_sd_label',
            'jumlah_sd_data_chart',
            'jumlah_smp_label',
            'jumlah_smp_data_chart',
            'jumlah_sma_label',
            'jumlah_sma_data_chart',
            'jumlah_smk_label',
            'jumlah_smk_data_chart',
            'jumlah_sdlb_label',
            'jumlah_sdlb_data_chart',
            'jumlah_smplb_label',
            'jumlah_smplb_data_chart',
            'jumlah_smlb_label',
            'jumlah_smlb_data_chart',
            'jumlah_slb_label',
            'jumlah_slb_data_chart',
            'data_dashlet',
            'data_pie_negeri_swasta',
            'data_pie_sd_smp_sma_smk',
            'data_pie_sdlb_smplb_smlb_slb',
            'group_bar_chart',
            'kode_prop',
            'kode_kab_kota',
            'data_koor_sd',
            'data_koor_smp',
            'data_koor_sma',
            'data_koor_smk'
        ));
    }

    public function change_prov(Request $request) {
        $data = array();
        $kode_prop = $request->input('kode_prop');

        if($kode_prop != "all") {
            $sql = "SELECT
                        DISTINCT a.`kode_kab_kota` AS id
                        , a.`kabupaten_kota` AS label
                    FROM
                        skl_raw a
                    WHERE 1=1
                        AND a.`kode_prop` = ?
                    ORDER BY a.`kode_kab_kota` ASC";
            $data = DB::select($sql, [$kode_prop]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Call Success',
            'data' => $data
        ]);
    }

}
?>