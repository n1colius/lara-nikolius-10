<?php
 use Illuminate\Support\Facades\DB;

if (!function_exists('array_all_hero')) {
    function array_all_hero()
    {
        $arr = array();

        $sql = "SELECT
                    a.`HeroID`
                FROM
                    `dota_heroes` a
                WHERE 1=1";
        $data = DB::select($sql);
        for ($i=0; $i < count($data); $i++) {
            $arr[$data[$i]->HeroID] = 0;
        }

        return $arr;
    }
}