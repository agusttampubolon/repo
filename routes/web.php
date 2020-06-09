<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/admin', function () {
    return view('admin.index');
})->middleware('auth');
Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/faq', function () {
    return view('faq');
});

Route::get('/change-password', function () {
    return view('user.change_password');
})->middleware('auth');

Route::get('/my-profile', function () {
    return view('user.my_profile');
})->middleware('auth');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/new/user', 'HomeController@new_user')->name('new_user');
Route::get('/admin', 'HomeController@admin')->name('home')->middleware('auth');
Route::get('/registration/success', 'Auth\RegisterController@after_registration')->name('registration');

Route::get('/article', 'ArticleController@index')->name('article');
Route::get('/article/add', 'ArticleController@add')->name('add')->middleware('auth');
Route::post('/article/submit', 'ArticleController@submit')->name('submit');
Route::post('/article/update', 'ArticleController@update')->name('update');

Route::get('/guide-book', 'GuideBookController@index')->name('guide-book');
Route::get('/guide-book/add', 'GuideBookController@add')->name('add')->middleware('auth');

Route::get('/book', 'BookController@index')->name('book');
Route::get('/book/add', 'BookController@add')->name('add')->middleware('auth');

Route::get('/monograph', 'MonographController@index')->name('monograph');
Route::get('/monograph/add', 'MonographController@add')->name('add')->middleware('auth');

Route::get('/student-paper', 'StudentPaperController@index')->name('index');
Route::get('/student-paper/add', 'StudentPaperController@add')->name('add')->middleware('auth');
Route::get('/student-paper/detail', 'StudentPaperController@detail')->name('detail');

Route::get('/archive', 'ArchiveController@index')->name('archive');
Route::get('/archive/add', 'ArchiveController@add')->name('add')->middleware('auth');

Route::get('/others', 'OthersController@index')->name('other');
Route::get('/others/add', 'OthersController@add')->name('other')->middleware('auth');

Route::get('/admin/user/all', 'AdminController@user_all')->name('user_all');
Route::get('/admin/user/rejected', 'AdminController@user_rejected')->name('user_rejected');
Route::get('/admin/user/pending', 'AdminController@user_pending')->name('user_pending');
Route::get('/admin/user/new', 'AdminController@user_new')->name('user_new');
Route::post('/admin/user/submit', 'AdminController@user_submit')->name('user_submit');
Route::post('/admin/user/all/paging', 'AdminController@user_all_paging')->name('user_all_paging');
Route::post('/admin/user/rejected/paging', 'AdminController@user_rejected_paging')->name('user_rejected_paging')->middleware('auth');
Route::post('/admin/user/pending/paging', 'AdminController@user_pending_paging')->name('user_pending_paging')->middleware('auth');
Route::post('/admin/user/update-status', 'AdminController@user_update_status')->name('user_update_status')->middleware('auth');
Route::post('/admin/user/change-password', 'AdminController@user_change_password')->name('user_change_password')->middleware('auth');
Route::post('/admin/user/update-account', 'AdminController@user_update_account')->name('user_update_account')->middleware('auth');

Route::get('/admin/article/all', 'ArticleController@admin_index')->name('admin_index')->middleware('auth');
Route::get('/admin/article/publish', 'ArticleController@admin_publish')->name('admin_publish')->middleware('auth');
Route::get('/admin/article/unpublish', 'ArticleController@admin_unpublish')->name('admin_unpublish')->middleware('auth');
Route::get('/admin/article/rejected', 'ArticleController@admin_rejected')->name('admin_rejected')->middleware('auth');
Route::get('/admin/article/pending', 'ArticleController@admin_pending')->name('admin_pending')->middleware('auth');
Route::get('/admin/article/add', 'ArticleController@admin_add')->name('admin_add')->middleware('auth');
Route::get('/admin/article/edit/{id}', 'ArticleController@admin_edit')->name('admin_edit')->middleware('auth');
Route::post('/admin/article/all/paging', 'ArticleController@paging_all')->name('all_paging')->middleware('auth');
Route::post('/admin/article/pending/paging', 'ArticleController@paging_pending')->name('paging_pending')->middleware('auth');
Route::post('/admin/article/rejected/paging', 'ArticleController@paging_rejected')->name('paging_rejected')->middleware('auth');
Route::post('/admin/article/publish/paging', 'ArticleController@paging_publish')->name('paging_publish')->middleware('auth');
Route::post('/admin/article/unpublish/paging', 'ArticleController@paging_unpublish')->name('paging_unpublish')->middleware('auth');

Route::get('/admin/guide-book/all', 'GuideBookController@admin_index')->name('admin_index')->middleware('auth');
Route::get('/admin/guide-book/add', 'GuideBookController@admin_add')->name('admin_add')->middleware('auth');
Route::get('/admin/guide-book/edit/{id}', 'GuideBookController@admin_edit')->name('admin_edit')->middleware('auth');
Route::post('/admin/guide-book/all/paging', 'GuideBookController@paging_all')->name('paging_all')->middleware('auth');
Route::post('/admin/guide-book/submit', 'GuideBookController@submit')->name('submit')->middleware('auth');
Route::post('/admin/guide-book/update', 'GuideBookController@update')->name('update')->middleware('auth');

Route::get('/admin/book/all', 'BookController@admin_index')->name('admin_index')->middleware('auth');
Route::get('/admin/book/add', 'BookController@admin_add')->name('admin_add')->middleware('auth');
Route::get('/admin/book/edit/{id}', 'BookController@admin_edit')->name('admin_edit')->middleware('auth');
Route::post('/admin/book/all/paging', 'BookController@paging_all')->name('paging_all')->middleware('auth');
Route::post('/admin/book/submit', 'BookController@submit')->name('submit')->middleware('auth');
Route::post('/admin/book/update', 'BookController@update')->name('submit')->middleware('auth');

Route::get('/admin/monograph/all', 'MonographController@admin_index')->name('admin_index')->middleware('auth');
Route::get('/admin/monograph/add', 'MonographController@admin_add')->name('admin_add')->middleware('auth');
Route::get('/admin/monograph/edit/{id}', 'MonographController@admin_edit')->name('admin_edit')->middleware('auth');
Route::post('/admin/monograph/all/paging', 'MonographController@paging_all')->name('paging_all')->middleware('auth');
Route::post('/admin/monograph/submit', 'MonographController@submit')->name('submit')->middleware('auth');
Route::post('/admin/monograph/update', 'MonographController@update')->name('update')->middleware('auth');

Route::get('/admin/student-paper/all', 'StudentPaperController@admin_index')->name('admin_index')->middleware('auth');
Route::get('/admin/student-paper/rejected', 'StudentPaperController@admin_rejected')->name('admin_rejected')->middleware('auth');
Route::get('/admin/student-paper/pending', 'StudentPaperController@admin_pending')->name('admin_pending')->middleware('auth');
Route::get('/admin/student-paper/add', 'StudentPaperController@admin_add')->name('admin_add')->middleware('auth');
Route::get('/admin/student-paper/edit/{id}', 'StudentPaperController@admin_edit')->name('admin_edit')->middleware('auth');
Route::post('/admin/student-paper/all/paging', 'StudentPaperController@paging_all')->name('paging_all')->middleware('auth');
Route::post('/admin/student-paper/pending/paging', 'StudentPaperController@paging_pending')->name('paging_pending')->middleware('auth');
Route::post('/admin/student-paper/rejected/paging', 'StudentPaperController@paging_rejected')->name('paging_rejected')->middleware('auth');
Route::post('/admin/student-paper/submit', 'StudentPaperController@submit')->name('submit')->middleware('auth');
Route::post('/student-paper/submit', 'StudentPaperController@submit')->name('submit')->middleware('auth');
Route::post('/student-paper/update', 'StudentPaperController@update')->name('update')->middleware('auth');

Route::get('/admin/archive/all', 'ArchiveController@admin_index')->name('admin_index')->middleware('auth');
Route::get('/admin/archive/publish', 'ArchiveController@admin_publish')->name('admin_publish')->middleware('auth');
Route::get('/admin/archive/unpublish', 'ArchiveController@admin_unpublish')->name('admin_unpublish')->middleware('auth');
Route::post('/admin/archive/all/paging', 'ArchiveController@paging_all')->name('all_paging')->middleware('auth');
Route::post('/admin/archive/publish/paging', 'ArchiveController@paging_publish')->name('paging_publish')->middleware('auth');
Route::post('/admin/archive/unpublish/paging', 'ArchiveController@paging_unpublish')->name('paging_unpublish')->middleware('auth');
Route::get('/admin/archive/add', 'ArchiveController@admin_add')->name('admin_add')->middleware('auth');
Route::get('/admin/archive/edit/{id}', 'ArchiveController@admin_edit')->name('admin_edit')->middleware('auth');
Route::post('/admin/archive/submit', 'ArchiveController@submit')->name('submit')->middleware('auth');
Route::post('/admin/archive/update', 'ArchiveController@update')->name('update')->middleware('auth');

Route::get('/admin/others/all', 'OthersController@admin_index')->name('admin_index')->middleware('auth');
Route::get('/admin/others/publish', 'OthersController@admin_publish')->name('admin_publish')->middleware('auth');
Route::get('/admin/others/unpublish', 'OthersController@admin_unpublish')->name('admin_unpublish')->middleware('auth');
Route::post('/admin/others/all/paging', 'OthersController@paging_all')->name('all_paging')->middleware('auth');
Route::post('/admin/others/publish/paging', 'OthersController@paging_publish')->name('paging_publish')->middleware('auth');
Route::post('/admin/others/unpublish/paging', 'OthersController@paging_unpublish')->name('paging_unpublish')->middleware('auth');
Route::get('/admin/others/add', 'OthersController@admin_add')->name('admin_add')->middleware('auth');
Route::get('/admin/others/edit/{id}', 'OthersController@admin_edit')->name('admin_edit')->middleware('auth');
Route::post('/admin/others/submit', 'OthersController@submit')->name('submit')->middleware('auth');
Route::post('/admin/others/update', 'OthersController@update')->name('update')->middleware('auth');

Route::post('/admin/approve', 'AdminController@approve')->name('approve')->middleware('auth');
Route::post('/admin/reject', 'AdminController@reject')->name('reject')->middleware('auth');
Route::post('/admin/delete', 'AdminController@delete')->name('delete')->middleware('auth');

Route::get('/all', 'FilterController@all')->name('all');
Route::get('/search-author/{author?}', 'FilterController@author')->name('author');
Route::get('/search-subject/{subject?}', 'FilterController@subject')->name('subject');
Route::get('/detail/{code}', 'CommunitiesController@detail')->name('detail');

Route::get('/search', 'FilterController@search')->name('search');
Route::get('/search/issued-date', 'FilterController@filter_by_issued')->name('issued-date');
Route::get('/search/title', 'FilterController@filter_by_title')->name('title');
Route::get('/search/authors', 'FilterController@filter_by_author')->name('authors');
Route::get('/search/subjects', 'FilterController@filter_by_subject')->name('subject');
Route::get('/search/type', 'FilterController@filter_by_type')->name('types');
Route::get('/search/submitted-date', 'FilterController@filter_by_submitted_date')->name('submitted-date');

Route::post('/change-password/submit', 'UsersController@change_password')->name('change_password')->middleware('auth');