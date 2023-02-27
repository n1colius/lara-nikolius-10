<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;

class SsUuidController extends Controller
{
	public function index()
	{
		return view('pengenalan_uuid');
	}

}