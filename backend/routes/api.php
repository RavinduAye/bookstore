<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getbooks',function (Request $request) {
     // return "I m game";
      return BooksController::getBooks();
});

Route::get('/getborrowbooks',function (Request $request) {
     return BooksController::getBorrowBooks();
});

Route::get('/add',[BooksController::class,'addBooks']);

 Route::delete('/borrow/{id}',[BooksController::class,'borrowBooks']);

 Route::delete('/remove/{id}',[BooksController::class,'removeBooks']);

// Route::get('/getbooks',BooksController@getBooks);


Route::get('/searcht',[BooksController::class,'search_title']);
Route::get('/searchd',[BooksController::class,'search_description']);
Route::get('/searchg',[BooksController::class,'search_genre']);