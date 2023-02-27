<?php
/**
 * @authors Nikolius Lau (n1colius.lau@gmail.com)
 * @date    2021-07-27 16:34:39
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Session;

class AdmBlogController extends Controller
{

	public function index(Request $request)
	{
		//prep var
		$limit = 10;
		$page = (int) $request->get("page"); if($page == 0) $page = 1;
		$start = ($page - 1) * $limit;
		$search = filter_var($request->get('search'), FILTER_SANITIZE_STRING);

		//SelectData
		$sqlraw = "SELECT
						a.`BlogId`
						, a.`BlogTitle`
						, DATE_FORMAT(a.`BlogDate`,'%d %M %Y') AS BlogDate
						, GROUP_CONCAT(c.`TagName` SEPARATOR ', ') AS BlogTag
					FROM
						blog a
						LEFT JOIN blog_tags b ON a.`BlogId` = b.`BlogId`
						LEFT JOIN tags c ON b.`TagId` = c.`TagId`
					WHERE 1=1
						AND a.`Status` = 'active'
						AND a.BlogTitle LIKE :search
					GROUP BY a.`BlogId`
		            LIMIT :start, :limit ";
		$data = DB::select($sqlraw, ['search' => '%'.$search.'%', 'start' => $start, 'limit' => $limit]);

		$sqlraw = " SELECT COUNT(*) AS total FROM blog WHERE 1=1 AND `Status` = 'active' AND BlogTitle LIKE :search";
		$query = DB::select($sqlraw, ['search' => '%'.$search.'%']);
		$datacount = (int) $query[0]->total;

		$options = array(
		    'path' => 'adm_dota2_heroes?search='.$search
		);
		$paginator = new \Illuminate\Pagination\LengthAwarePaginator($data, $datacount, $limit, $page, $options);

		$enddata = $limit*$page;
		$startdata = $start+1;
		return view('admin.blog', compact(
			'search',
			'data',
			'paginator',
			'datacount',
			'startdata',
			'enddata'
		));
	}

	public function form(Request $request) {
		//prep var
		$opsi = $request->route('opsi');
		$dataform = array();

		//jika insert
		if($opsi == "insert") {
			$dataform['BlogId'] = null;
			$dataform['BlogTitle'] = null;
			$dataform['BlogHeadlinePic'] = null;
			$dataform['BlogDate'] = null;
			$dataform['BlogTags'] = array();
			$dataform['BlogDesc'] = null;
			$dataform['BlogArticle'] = null;
		}

		//update
		if($opsi == "update") {
			$BlogId = (int) $request->route('id');

			$sqlraw = "SELECT
							a.`BlogId`
							, a.`BlogTitle`
							, a.`BlogDesc`
							, a.`BlogHeadlinePic`
							, a.`BlogArticle`
							, a.`BlogDate`
							, GROUP_CONCAT(b.`TagId`) AS BlogTags
						FROM
							blog a
							LEFT JOIN blog_tags b ON a.`BlogId` = b.`BlogId`
							LEFT JOIN tags c ON b.`TagId` = c.`TagId`
						WHERE 1=1
							AND a.`BlogId` = ?
						GROUP BY a.`BlogId`";
			$data = DB::select($sqlraw, [$BlogId]);
			$BlogTags = explode(",",$data[0]->BlogTags);

			$dataform = (array) $data[0];
			$dataform['BlogTags'] = $BlogTags;
		}

		return view('admin.blog_form', [
		    "opsi" => $opsi,
		    "dataform" => $dataform
		]);
	}

	public function form_proc(Request $request) {
		$rules = [
		    'BlogId' => 'required',
		    'BlogHeadlinePic' => 'required',
		    'BlogTitle' => 'required',
		    'BlogDate' => 'required',
		    'BlogTags' => 'required',
		    'BlogDesc' => 'required',
		    'BlogArticle' => 'required',
		];
		
		$messages = [
		    'BlogId.required' => 'Blog ID is required',
		    'BlogHeadlinePic.required' => 'Headline Picture is required',
		    'BlogTitle.required' => 'Title is required',
		    'BlogDate.required' => 'Date is required',
		    'BlogTags.required' => 'Tags is required',
		    'BlogDesc.required' => 'Description is required',
		    'BlogArticle.required' => 'Article is required',
		];
		
		$validator = Validator::make($request->all(), $rules, $messages);

		if($validator->fails()){
		    return redirect()->back()->withErrors($validator)->withInput();
		}

		//dd($request->input());
		DB::beginTransaction();
		try {

			if($request->input('OpsiForm') === 'insert') {
				$sqlraw = "INSERT INTO `blog` SET
						    `BlogId` = ?,
						    `BlogTitle` = ?,
						    `BlogDesc` = ?,
						    `BlogHeadlinePic` = ?,
						    `BlogArticle` = ?,
						    `BlogDate` = ?,
						    `BlogClickCount` = 0,
						    `Status` = 'active'";
				$query = DB::insert($sqlraw, [
					$request->input('BlogId'),
					$request->input('BlogTitle'),
					$request->input('BlogDesc'),
					$request->input('BlogHeadlinePic'),
					$request->input('BlogArticle'),
					$request->input('BlogDate')
				]);

				//tags
				$BlogTagsArr = $request->input('BlogTags');
				foreach($BlogTagsArr as $Tag) {
					$sqlraw = "INSERT INTO `blog_tags` SET
								BlogId = ?,
								TagId = ? ";
					$query = DB::insert($sqlraw, [
						$request->input('BlogId'),
						$Tag
					]);
				}
			}

			if($request->input('OpsiForm') === 'update') {
				$sqlraw = "UPDATE blog SET
								`BlogTitle` = ?,
								`BlogDesc` = ?,
								`BlogHeadlinePic` = ?,
								`BlogArticle` = ?,
								`BlogDate` = ?
							WHERE 1=1
								AND `BlogId` = ?
							LIMIT 1";
				$query = DB::update($sqlraw, [
					$request->input('BlogTitle'),
					$request->input('BlogDesc'),
					$request->input('BlogHeadlinePic'),
					$request->input('BlogArticle'),
					$request->input('BlogDate'),
					$request->input('BlogId')
				]);

				//tag
				$sqlraw = "DELETE FROM blog_tags WHERE BlogId = ?";
				$query = DB::delete($sqlraw, [$request->input('BlogId')]);

				$BlogTagsArr = $request->input('BlogTags');
				foreach($BlogTagsArr as $Tag) {
					$sqlraw = "INSERT INTO `blog_tags` SET
								BlogId = ?,
								TagId = ? ";
					$query = DB::insert($sqlraw, [
						$request->input('BlogId'),
						$Tag
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

	public function delete(Request $request) {
	    $BlogId = (int) $request->route('id');

	    $sqlraw = "DELETE FROM blog WHERE BlogId = ? LIMIT 1";
	    $query = DB::delete($sqlraw, [
	        $BlogId
	    ]);

	    return redirect()->back();
	}

}