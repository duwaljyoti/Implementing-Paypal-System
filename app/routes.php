<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


// Route::get('/','MainController@index');
// Route::post('/store','MainController@store');

 Route::get('/logout','MainController@LogOut');
 // Route::get('/home','MainController@home');
 Route::get('/register','MainController@Register');
 Route::get('/login','MainController@Login');
 Route::post('/store','MainController@store');
Route::get('/','MainController@home');
Route::get('/admin','MainController@admin');
Route::get('/edit/category/{cat_id}',function($cat_id){
	$bookscategories_details= Bookscategories::where('id','=',$cat_id)->get();
	// dd(count($bookscategories_details));
	// dd($bookscategories_details);
	// return $bookscategories_details;
	$bookscategories_details_array=$bookscategories_details->toArray();
	return View::make('edit')->with('bookcategories_detail',$bookscategories_details_array);
});
Route::get('/edit_book/book/{book_id}',function($book_id){
	$books_details= Books::where('id','=',$book_id)->get();
	// dd(count($bookscategories_details));
	// dd($bookscategories_details);
	// return $bookscategories_details;
	$books_details_array=$books_details->toArray();
	return View::make('edit_book')->with('books_detail',$books_details_array);
});
Route::get('/delete/category/{cat_id}',function($cat_id){
	$books_categories_to_be_deleted=Bookscategories::find($cat_id);
	$books_categories_to_be_deleted->delete();
	return Redirect::back();
});
Route::get('/add_new/{field} ',function($field){
	if($field=="Category"){
		return View::make('add',['field'=>$field]);
	}
});
// Route::get('/milk', array('as' => 'milk', function(){
//     return App::make('ProductsController')->index(1);
// }));
Route::get('/single_book/{single_book_id}',function($single_book_id){

	// $check_book_issued=Book_isssued::where()
	return App::make('MainController')->disp_single_book($single_book_id);
});
Route::post('/change','MainController@change');
Route::post('/add','MainController@add');
Route::post('/login','MainController@store');
Route::post('/issue_book','MainController@issue_book');
// Route::resource('users','MainController');
Route::post('/search ','MainController@search');
Route::get('/category/{cat_name} ',function($cat_name){
	return App::make('MainController')->browse_with_cat($cat_name);
});
Route::get('/all_books','MainController@all_books');
Route::get('/add_books_admin','MainController@admin_add_books');
Route::get('/sign_up','MainController@sign_up');
Route::post('/sign_up_user','MainController@sign_up_validator');
Route::post('/edit_book_details','MainController@edit_book_details');
// Route::get('/delete/category/{cat_id}',function($cat_id){
// 	$books_categories_to_be_deleted=Bookscategories::find($cat_id);
// 	$books_categories_to_be_deleted->delete();
// 	return Redirect::back();
// });
Route::post('/add_books','MainController@add_books');