<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'ShowHomePage')->name('home');
Route::get('article/{slug}', 'ShowArticlePage')->name('article.detail');
Route::get('article-infinite-scroll/{slug}', 'ShowInfiniteScrollArticlePage')->name('article.detail.infinite-scroll');

Auth::routes();

Route::group(['prefix' => 'cms'], function () {
    Route::get('article', 'CMS\ArticleController@index')->name('cms.article.list');
    Route::get('article/create', 'CMS\ArticleController@create')->name('cms.article.create');
    Route::post('article', 'CMS\ArticleController@store')->name('cms.article.store');
    Route::get('article/{id}', 'CMS\ArticleController@edit')->name('cms.article.edit');
    Route::put('article/{id}', 'CMS\ArticleController@update')->name('cms.article.update');
    Route::delete('article/{id}', 'CMS\ArticleController@destroy')->name('cms.article.delete');

    Route::post('upload-editor', 'CMS\UploadImageEditor')->name('cms.upload.editor');
});
