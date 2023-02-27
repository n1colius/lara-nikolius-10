<?php
/**
 * @authors Nikolius Lau (n1colius.lau@gmail.com)
 * @date    2021-08-05 22:35:57
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;

class FunProjController extends Controller
{
	public function index()
	{
		return view('funproj');
	}

}