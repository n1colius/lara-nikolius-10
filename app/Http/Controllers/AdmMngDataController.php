<?php
/**
 * @authors Nikolius Lau (n1colius.lau@gmail.com)
 * @date    2021-07-13 22:40:56
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdmMngDataController extends Controller
{

    public function index()
    {
        return view('admin.manage_data');
    }

}