<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/testing', [App\Http\Controllers\TestingController::class, 'index'])->name('testing');

Route::get('/login', [App\Http\Controllers\AuthController::class, 'index'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login_proc'])->name('login_proc');
/*Route::get('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register_proc'])->name('register_proc');*/

Route::get('/blog', [App\Http\Controllers\BlogController::class, 'index'])->name('blog');
Route::get('/blog/{id}', [App\Http\Controllers\BlogController::class, 'detail'])->name('blog_detail');

Route::get('/funproj', [App\Http\Controllers\FunProjController::class, 'index'])->name('funproj');
Route::get('/dotahero', [App\Http\Controllers\DotaHeroController::class, 'index'])->name('dotahero');
Route::get('/dota_analysis', [App\Http\Controllers\DotaAnalysisController::class, 'index'])->name('dota_analysis');
Route::get('/dota_analysis_result', [App\Http\Controllers\DotaAnalysisController::class, 'result'])->name('dota_analysis_result');
Route::get('/dota_winrate_chart', [App\Http\Controllers\DotaWinrateChartController::class, 'index'])->name('dota_winrate_chart');
Route::get('/dota_winrate_chart_display', [App\Http\Controllers\DotaWinrateChartController::class, 'display'])->name('dota_winrate_chart_display');
Route::get('/saham_main', [App\Http\Controllers\SahamMainController::class, 'index'])->name('saham_main');
Route::post('/saham_main_form_proc', [App\Http\Controllers\SahamMainController::class, 'form_proc'])->name('saham_main_form_proc');
Route::get('/ektp_extract', [App\Http\Controllers\EktpExtractController::class, 'index'])->name('ektp_extract');
Route::post('/ektp_extract_form_proc', [App\Http\Controllers\EktpExtractController::class, 'form_proc'])->name('ektp_extract_form_proc');
Route::get('/docker_web', [App\Http\Controllers\DockerWebController::class, 'index'])->name('docker_web');
Route::get('/pengenalan_uuid', [App\Http\Controllers\SsUuidController::class, 'index'])->name('pengenalan_uuid');

Route::get('/diaryprog', [App\Http\Controllers\DiaryProgController::class, 'index'])->name('diaryprog');
Route::get('/diaryprog_switch_to_aws', [App\Http\Controllers\DiaryProgSwitchAwsController::class, 'index'])->name('diaryprog_switch_to_aws');
Route::get('/diaryprog_data_vis', [App\Http\Controllers\DiaryProgDataVis::class, 'index'])->name('diaryprog_data_vis');
Route::get('/diaryprog_aws_serverless', [App\Http\Controllers\DiaryProgAwsServerless::class, 'index'])->name('diaryprog_aws_serverless');

Route::get('/cv', [App\Http\Controllers\CvController::class, 'index'])->name('cv');
Route::get('/cv_eng', [App\Http\Controllers\CvController::class, 'cv_eng'])->name('cv_eng');

Route::get('/jual', [App\Http\Controllers\JualanController::class, 'index'])->name('jual');

//============ Data Sekolah ============================= (Begin)
Route::get('/data_sekolah', [App\Http\Controllers\DataSekolahController::class, 'index'])->name('data_sekolah');
Route::post('/data_sekolah_post', [App\Http\Controllers\DataSekolahController::class, 'index'])->name('data_sekolah_post');
Route::get('/data_sekolah_change_prov', [App\Http\Controllers\DataSekolahController::class, 'change_prov'])->name('data_sekolah_change_prov');
//============ Data Sekolah ============================= (End)

/*=========================================================================================================================================================================*/

Route::group(['middleware' => 'auth'], function () {
 
    Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

    Route::get('/adm_manage_data', [App\Http\Controllers\AdmMngDataController::class, 'index'])->name('adm_manage_data');

    Route::get('/adm_dota2_heroes', [App\Http\Controllers\AdmDota2HeroesController::class, 'index'])->name('adm_dota2_heroes');
    Route::get('/adm_dota2_heroes_form/{opsi}/{id?}', [App\Http\Controllers\AdmDota2HeroesController::class, 'form'])->name('adm_dota2_heroes_form');
    Route::post('/adm_dota2_heroes_form_proc', [App\Http\Controllers\AdmDota2HeroesController::class, 'form_proc'])->name('adm_dota2_heroes_form_proc');
    Route::post('/adm_dota2_heroes_form_notes_proc', [App\Http\Controllers\AdmDota2HeroesController::class, 'form_notes_proc'])->name('adm_dota2_heroes_form_notes_proc');
    Route::post('/adm_dota2_heroes_form_notes_delete/', [App\Http\Controllers\AdmDota2HeroesController::class, 'form_notes_delete'])->name('adm_dota2_heroes_form_notes_delete');
    Route::get('/adm_dota2_heroes_delete/{id}', [App\Http\Controllers\AdmDota2HeroesController::class, 'delete'])->name('adm_dota2_heroes_delete');

    Route::get('/adm_blog', [App\Http\Controllers\AdmBlogController::class, 'index'])->name('adm_blog');
    Route::get('/adm_blog_form/{opsi}/{id?}', [App\Http\Controllers\AdmBlogController::class, 'form'])->name('adm_blog_form');
    Route::post('/adm_blog_form_proc', [App\Http\Controllers\AdmBlogController::class, 'form_proc'])->name('adm_blog_form_proc');
    Route::get('/adm_blog_delete/{id}', [App\Http\Controllers\AdmBlogController::class, 'delete'])->name('adm_blog_delete');

    //update match dota 2
    Route::get('/adm_dotacrawl_matches', [App\Http\Controllers\AdmDotacrawlController::class, 'matches'])->name('adm_dotacrawl_matches');
    Route::get('/adm_dotacrawl_matches_stat/{leagueid}', [App\Http\Controllers\AdmDotacrawlController::class, 'matches_stat'])->name('adm_dotacrawl_matches_stat');
    Route::get('/adm_dotacrawl_matches_genstat/{leagueid}', [App\Http\Controllers\AdmDotacrawlController::class, 'matches_genstat'])->name('adm_dotacrawl_matches_genstat');
});