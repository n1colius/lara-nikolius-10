<?php
/**
 * @authors Nikolius Lau (n1colius.lau@gmail.com)
 * @date    2021-07-29 14:15:48
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{

    public function index()
    {
    	//SelectData
    	$sqlraw = "SELECT
    					a.`BlogId`
    					, a.`BlogTitle`
    					, a.BlogHeadlinePic
    					, GROUP_CONCAT(c.`TagName` SEPARATOR ', ') AS BlogTag
    				FROM
    					blog a
    					LEFT JOIN blog_tags b ON a.`BlogId` = b.`BlogId`
    					LEFT JOIN tags c ON b.`TagId` = c.`TagId`
    				WHERE 1=1
    					AND a.`Status` = 'active'
    				GROUP BY a.`BlogId`
    	            ORDER BY a.BlogDate DESC ";
    	$data = DB::select($sqlraw, []);

        return view('blog', compact(
        	'data'
        ));
    }

    public function detail(Request $request) {
    	$BlogId = (int) $request->route('id');

        $sqlraw = "SELECT
                        a.`BlogId`
                        , a.`BlogTitle`
                        , a.`BlogArticle`
                        , a.`BlogHeadlinePic`
                        , DATE_FORMAT(a.`BlogDate`,'%M %d, %Y') AS BlogDate
                        , GROUP_CONCAT(c.`TagName` SEPARATOR ', ') AS BlogTags
                    FROM
                        blog a
                        LEFT JOIN blog_tags b ON a.`BlogId` = b.`BlogId`
                        LEFT JOIN tags c ON b.`TagId` = c.`TagId`
                    WHERE 1=1
                        AND a.`BlogId` = ?
                    GROUP BY a.`BlogId`";
        $data = DB::select($sqlraw, [$BlogId]);        
        $blog = $data[0];

        $shareButtons = \Share::page(
                    url()->full(),
                    'Nikolius Lau -'.$blog->BlogTitle,
                )
                ->facebook()
                ->twitter()
                ->linkedin()
                ->telegram()
                ->whatsapp();

    	return view('blog_detail', compact(
            'blog',
            'shareButtons'
        ));	
    }

}