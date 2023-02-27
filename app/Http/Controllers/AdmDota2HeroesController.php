<?php
/**
 * @authors Nikolius Lau (n1colius.lau@gmail.com)
 * @date    2021-07-14 21:26:33
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Session;

class AdmDota2HeroesController extends Controller
{

    public function index(Request $request)
    {
        //Prep var
        $limit = 10;
        $page = (int) $request->get("page"); if($page == 0) $page = 1;
        $start = ($page - 1) * $limit;
        $search = filter_var($request->get('search'), FILTER_SANITIZE_STRING);

        //SelectData
        $sqlraw = "SELECT
                        a.`HeroID`
                        , a.`HeroName`
                        , a.`Picture`
                        , GROUP_CONCAT(b.`Roles`) AS Roles 
                    FROM
                        dota_heroes a
                        LEFT JOIN dota_heroes_roles b ON a.`HeroID` = b.`HeroID`
                    WHERE 1=1
                        AND a.HeroName LIKE :search
                    GROUP BY a.`HeroID`
                    ORDER BY a.`HeroID` DESC
                    LIMIT :start, :limit ";
        $data = DB::select($sqlraw, ['search' => '%'.$search.'%', 'start' => $start, 'limit' => $limit]);

        $sqlraw = " SELECT COUNT(*) AS total FROM dota_heroes WHERE 1=1 AND HeroName LIKE :search";
        $query = DB::select($sqlraw, ['search' => '%'.$search.'%']);
        $datacount = (int) $query[0]->total;

        $options = array(
            'path' => 'adm_dota2_heroes?search='.$search
        );
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator($data, $datacount, $limit, $page, $options);

        $enddata = $limit*$page;
        $startdata = $start+1;
        return view('admin.dota2_heroes', compact('data','paginator','datacount','startdata','enddata','search'));
    }

    public function form(Request $request) {
        //prep var
        $opsi = $request->route('opsi');
        $dataform = array();

        //jika insert
        if($opsi == "insert") {
            $dataform['HeroID'] = null;
            $dataform['HeroName'] = null;
            $dataform['Picture'] = null;
            $dataform['PrimAttr'] = null;
            $dataform['AttackType'] = null;
            $dataform['HeroRoles'] = array();
            $datanotes = array();
        }

        //jika update
        if($opsi == "update") {
            $HeroID = (int) $request->route('id');

            $sqlraw = "SELECT
                            a.`HeroID`
                            , a.HeroName
                            , a.`Picture`
                            , a.`PrimAttr`
                            , a.`AttackType`
                            , GROUP_CONCAT(b.`Roles`) AS Roles
                        FROM
                            dota_heroes a
                            LEFT JOIN dota_heroes_roles b ON a.`HeroID` = b.`HeroID`
                        WHERE 1=1
                            AND a.`HeroID` = ?
                        GROUP BY a.`HeroID`";
            $data = DB::select($sqlraw, [$HeroID]);
            $HeroRoles = explode(",",$data[0]->Roles);

            $dataform = (array) $data[0];
            $dataform['HeroRoles'] = $HeroRoles;

            //Notes
            $sqlraw = "SELECT
                            a.`NotesID`
                            , a.`Notes`
                        FROM
                            dota_heroes_notes a
                        WHERE 1=1
                            AND a.`HeroID` = ? ";
            $datanotes = DB::select($sqlraw, [$HeroID]);
        }

        return view('admin.dota2_heroes_form', [
            "opsi" => $opsi,
            "dataform" => $dataform,
            'datanotes' => $datanotes
        ]);
    }

    public function form_proc(Request $request) {
        $rules = [
            'HeroID' => 'required',
            'HeroName' => 'required',
            'Picture' => 'required',
            'PrimAttr' => 'required',
            'AttackType' => 'required',
            'HeroRoles' => 'required'
        ];
  
        $messages = [
            'HeroID.required' => 'Hero ID is required',
            'HeroName.required' => 'Hero Name is required',
            'Picture.required' => 'Picture is required',
            'PrimAttr.required' => 'Primary Attribute is required',
            'AttackType.required' => 'Attack Type is required',
            'HeroRoles.required' => 'Roles is required'
        ];
  
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        
        DB::beginTransaction();
        try {
            if($request->input('OpsiForm') === 'insert') {
                //hero
                $sqlraw = "INSERT INTO `dota_heroes` SET
                        `HeroID` = ?,
                        `HeroName` = ?,
                        `NpcHero` = '',
                        `Picture` = ?,
                        `PrimAttr` = ?,
                        `AttackType` = ? ";
                $query = DB::insert($sqlraw, [
                    $request->input('HeroID'),
                    $request->input('HeroName'),
                    $request->input('Picture'),
                    $request->input('PrimAttr'),
                    $request->input('AttackType')
                ]);

                //roles
                $HeroRolesArr = $request->input('HeroRoles');
                foreach($HeroRolesArr as $HeroRoles) {
                    $sqlraw = "INSERT INTO dota_heroes_roles SET
                                HeroID = ?,
                                Roles = ? ";
                    $query = DB::insert($sqlraw, [
                        $request->input('HeroID'),
                        $HeroRoles
                    ]);
                }
            }

            if($request->input('OpsiForm') === 'update') {
                //hero
                $sqlraw = "UPDATE dota_heroes a SET
                                a.`HeroName` = ?
                                , a.`Picture` = ?
                                , a.`PrimAttr` = ?
                                , a.`AttackType` = ?
                            WHERE 1=1
                                AND a.`HeroID` = ?
                            LIMIT 1";
                $query = DB::update($sqlraw, [
                    $request->input('HeroName'),
                    $request->input('Picture'),
                    $request->input('PrimAttr'),
                    $request->input('AttackType'),
                    $request->input('HeroID')
                ]);

                //roles
                $sqlraw = "DELETE FROM dota_heroes_roles WHERE HeroID = ?";
                $query = DB::delete($sqlraw, [$request->input('HeroID')]);

                $HeroRolesArr = $request->input('HeroRoles');
                foreach($HeroRolesArr as $HeroRoles) {
                    $sqlraw = "INSERT INTO dota_heroes_roles SET
                                HeroID = ?,
                                Roles = ? ";
                    $query = DB::insert($sqlraw, [
                        $request->input('HeroID'),
                        $HeroRoles
                    ]);
                }
            }

            DB::commit();
            Session::flash('success', 'Data Saved');
        } catch (\Exception $e) {
            //dd($e);
            DB::rollback();
            Session::flash('error', 'Failed to save data');
        }

        return redirect()->back();
    }

    public function form_notes_proc(Request $request) {
        if($request->input('NotesID') == "") {
            //insert

            $sqlraw = "INSERT INTO `dota_heroes_notes` SET
                        `HeroID` = ?,
                        `Notes` = ?";
            $query = DB::insert($sqlraw, [
                $request->input('HeroID'),
                $request->input('HeroNotes')
            ]);

        } else {
            //update

            $sqlraw = "UPDATE dota_heroes_notes a SET
                            a.`Notes` = ?
                        WHERE 1=1
                            AND a.`NotesID` = ?
                        LIMIT 1";
            $query = DB::update($sqlraw, [
                $request->input('HeroNotes'), 
                $request->input('NotesID') 
            ]);

        }

        //Notes
        $sqlraw = "SELECT
                        a.`NotesID`
                        , a.`Notes`
                    FROM
                        dota_heroes_notes a
                    WHERE 1=1
                        AND a.`HeroID` = ? ";
        $datanotes = DB::select($sqlraw, [$request->input('HeroID')]);

        return response()->json([
            'success' => true,
            'message' => 'Process success',
            'datanotes' => $datanotes
        ]);
    }

    public function form_notes_delete(Request $request) {
        $sqlraw = "DELETE FROM dota_heroes_notes WHERE NotesID = ? LIMIT 1";
        $query = DB::delete($sqlraw, [
            $request->input('NotesID') 
        ]);

        //Notes
        $sqlraw = "SELECT
                        a.`NotesID`
                        , a.`Notes`
                    FROM
                        dota_heroes_notes a
                    WHERE 1=1
                        AND a.`HeroID` = ? ";
        $datanotes = DB::select($sqlraw, [$request->input('HeroID')]);

        return response()->json([
            'success' => true,
            'message' => 'Process success',
            'datanotes' => $datanotes
        ]);    
    }

    public function delete(Request $request) {
        $HeroID = (int) $request->route('id');

        $sqlraw = "DELETE FROM dota_heroes WHERE HeroID = ? LIMIT 1";
        $query = DB::delete($sqlraw, [
            $HeroID
        ]);

        return redirect()->back();
    }

}