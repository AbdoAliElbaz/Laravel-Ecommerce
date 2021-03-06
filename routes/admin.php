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

define('PAGINATION_COUNT' , 10);
Route::group(['namespace'=>'Admin' ,'middleware'=>'auth:admin'], function() {
    Route::get('/', 'DashboardController@index')->name('admin.dashboard');


    ##########################languages##################################
Route::group(['prefix' => 'languages'], function () {
    Route::get('/', 'LanguagesController@index')->name('admin.languages');
    Route::get('create', 'LanguagesController@create')->name('admin.languages.create');
    Route::post('store', 'LanguagesController@store')->name('admin.languages.store');
    Route::get('edit/{id}', 'LanguagesController@edit')->name('admin.languages.edit');
    Route::post('update/{id}', 'LanguagesController@update')->name('admin.languages.update');
    Route::get('delete/{id}', 'LanguagesController@destroy')->name('admin.languages.delete');

});

    ##########################categories##################################

Route::group(['prefix' => 'maincategory'], function () {
    Route::get('/', 'MainCategoriesController@index')->name('admin.mainCategories');
    Route::get('create', 'MainCategoriesController@create')->name('admin.mainCategories.create');
    Route::post('store', 'MainCategoriesController@store')->name('admin.mainCategories.store');
    Route::get('edit/{id}', 'MainCategoriesController@edit')->name('admin.mainCategories.edit');
    Route::post('update/{id}', 'MainCategoriesController@update')->name('admin.mainCategories.update');
    Route::get('delete/{id}', 'MainCategoriesController@destroy')->name('admin.mainCategories.delete');
    Route::get('changeStatus/{id}','MainCategoriesController@changeStatus')-> name('admin.mainCategories.status');



});
   ##########################subCategories##################################

   Route::group(['prefix' => 'subCategory'], function () {
    Route::get('/', 'subCategoriesController@index')->name('admin.subCategories');
    Route::get('create', 'subCategoriesController@create')->name('admin.subCategories.create');
    Route::post('store', 'subCategoriesController@store')->name('admin.subCategories.store');
    Route::get('edit/{id}', 'subCategoriesController@edit')->name('admin.subCategories.edit');
    Route::post('update/{id}', 'subCategoriesController@update')->name('admin.subCategories.update');
    Route::get('delete/{id}', 'subCategoriesController@destroy')->name('admin.subCategories.delete');
    Route::get('changeStatus/{id}','subCategoriesController@changeStatus')-> name('admin.subCategories.status');



});

    ##########################vendors##################################

Route::group(['prefix' => 'vendors'], function () {
    Route::get('/', 'VendorsController@index')->name('admin.Vendors');
    Route::get('create', 'VendorsController@create')->name('admin.Vendors.create');
    Route::post('store', 'VendorsController@store')->name('admin.Vendors.store');
    Route::get('edit/{id}', 'VendorsController@edit')->name('admin.Vendors.edit');
    Route::post('update/{id}', 'VendorsController@update')->name('admin.Vendors.update');
    Route::get('delete/{id}', 'VendorsController@destroy')->name('admin.Vendors.delete');

});
// Route::get('test-helper' , function() {
//    return dd(get_language());
// });
});


Route::group(['namespace'=>'Admin' ,'middleware'=>'guest:admin'] ,  function () {
    Route::get('login','LoginController@getLogin')->name('get.admin.login');
    Route::post('login','LoginController@login')->name('admin.login');
});





// ,'middleware'=> 'auth:admin'


