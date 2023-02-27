<?php
/**
 * @authors Nikolius Lau (n1colius.lau@gmail.com)
 * @date    2022-03-22 19:11:14
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;

class CvController extends Controller
{
	public function index()
	{
		$data = array();
		
		return view('cv', compact(
			'data'
		));
	}

	public function cv_eng() {
		$data = array();
		
		return view('cv_eng', compact(
			'data'
		));
	}

}