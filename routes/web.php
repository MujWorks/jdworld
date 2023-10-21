<?php
  
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;
use App\Helper;
use Illuminate\Support\Facades\Session;
use App\Http\Middleware\CheckStatus;
use Config as cnf;
/* 
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('config:clear');
    // return what you want
});

Route::middleware([CheckStatus::class])->group(function(){
Route::get('/', [Home::class, 'index']);
Route::post('/download_gif', [Home::class, 'download_gif']);
Route::post('/subs_log', [Home::class, 'subscribe_login']);
Route::post('/login', [Home::class, 'login']);
Route::get('/contents', [Home::class, 'content_page']);
Route::get('/faq', [Home::class, 'faq_page']);
Route::get('/about', [Home::class, 'about_page']);
Route::get('/terms/{v1}', [Home::class, 'terms_page']);
Route::get('/myaccount', [Home::class, 'accout_page']);
Route::get('/direct_myaccount', [Home::class, 'dir_accout_page']);
Route::post('/getContent', [Home::class, 'popular_more_video']);
Route::get('/logout',[Home::class,'logout']);
Route::get('/change_lang',[Home::class,'lang_change']);
Route::post('/unsubscribe',[Home::class,'unsub']);
});
Route::get('/test', function () 
{
	setLanguage();
});
Route::any('/{id}', function ($id) 
{
	
	$x=SetCountry($id);
	//echo print_r($x);
	return (new Home)->index($id);
});