<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Middleware\ValidateSignature;


Auth::routes();

Route::match(['get', 'post'], '/', 'App\Http\Controllers\Auth\LoginController@contentstop'); //あまり使わない方法

Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');

Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout');

Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register');

Route::get('/admin_register/{timestamp}/{hash}', 'App\Http\Controllers\AdminController@adminregister');

Route::get('/loginid_reset', 'App\Http\Controllers\Auth\ForgetController@forgetloginid');

Route::post('/loginid_reset/complete', 'App\Http\Controllers\Auth\ForgetController@forgetloginidcomplete');

Route::get('/passwd_reset', 'App\Http\Controllers\Auth\ForgetController@forgetpass');

Route::post('/passwd_reset/complete', 'App\Http\Controllers\Auth\ForgetController@forgetpasscomplete');

Route::get('/passwd_reset/{timestamp}/{hash}','App\Http\Controllers\Auth\ForgetController@passwordreset');

Route::get('/attribute', 'App\Http\Controllers\MypageController@attribute');

Route::get('/work_search', 'App\Http\Controllers\WorkController@worksearch');

Route::post('/work_search/gojuonsearch', 'App\Http\Controllers\WorkController@worksearchAjax');

Route::get('/work_history', 'App\Http\Controllers\WorkController@workhistory');

Route::get('/work_indetail/{url}/{url2}', 'App\Http\Controllers\WorkController@workindetail');

Route::get('/mypage', 'App\Http\Controllers\MypageController@mypage');

Route::get('/stat', 'App\Http\Controllers\MypageController@statistics');

Route::get('/nickname_change', 'App\Http\Controllers\MypageController@nicknamechange');

Route::post('/nickname_change/complete', 'App\Http\Controllers\MypageController@nicknamechangecomplete');

Route::get('/passwd_change', 'App\Http\Controllers\MypageController@passwordchange');

Route::post('/passwd_change/complete', 'App\Http\Controllers\MypageController@passwordchangecomplete');

Route::get('/info', 'App\Http\Controllers\MypageController@information');

Route::get('/opinion', 'App\Http\Controllers\OpinionController@opinion');

Route::post('/opinion/conf', 'App\Http\Controllers\OpinionController@opinionconf');

Route::post('/opinion/complete', 'App\Http\Controllers\OpinionController@opinioncomplete');

Route::get('/genrepost', 'App\Http\Controllers\WorkController@workgenrepost');

Route::get('/setting', 'App\Http\Controllers\MypageController@setting');

Route::get('/nowemotion', 'App\Http\Controllers\NowemotionController@nowemotion');

Route::get('/post', 'App\Http\Controllers\PostController@post');

Route::post('/post/conf', 'App\Http\Controllers\PostController@postconf');

Route::post('/post/complete', 'App\Http\Controllers\PostController@postcomplete');

Route::get('/post_work_title', 'App\Http\Controllers\PostController@postworktitle');

Route::get('/rankingconfig', 'App\Http\Controllers\PortaltopController@rankingconfig');

Route::get('/user_search', 'App\Http\Controllers\AdminController@usersearch');

Route::get('/adminpage', 'App\Http\Controllers\AdminController@adminpage');

Route::get('/adminlink', 'App\Http\Controllers\AdminController@adminlink');

Route::post('/adminlink/complete', 'App\Http\Controllers\AdminController@adminlinkcomplete');

Route::post('/user_search/usersearch', 'App\Http\Controllers\AdminController@usersearchAjax');

Route::get('/csv', 'App\Http\Controllers\AdminController@getcsv');

Route::get('/adminaccount', 'App\Http\Controllers\AdminController@adminaccount');

Route::post('/adminaccount/setting', 'App\Http\Controllers\AdminController@adminaccountsetting');

Route::post('/mypage/setting', 'App\Http\Controllers\MypageController@mypagesetting');

Route::post('/modal/complete', 'App\Http\Controllers\ModalController@modalcomplete');

Route::post('/workindetail/favorite/add', 'App\Http\Controllers\WorkController@workindetailfavoriteadd');

Route::post('/workindetail/favorite/delete', 'App\Http\Controllers\WorkController@workindetailfavoritedelete');

