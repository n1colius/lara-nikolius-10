<?php
/**
 * @authors Nikolius Lau (n1colius.lau@gmail.com)
 * @date    2021-08-05 22:35:57
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;

class JualanController extends Controller
{
	public function index()
	{
		return view('jual');
	}

	public function detail(Request $request) {
    	$link_product = $request->route('link_product');

    	switch ($link_product) {
    		case 'jolly':
    			$view_render = 'product/jolly';
    		break;
    		default:
    		break;
    	}

    	return view($view_render);
    }

}