<?php

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
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/main', function(){
    header("Access-Control-Allow-Origin: *");
    $items = App\Item::orderBy('created_at','desc')->take(4)->get();
    return $items;
});
Route::get('/lost', function(){
    header("Access-Control-Allow-Origin: *");
    $items = App\Item::where('status','=',0)->get();
    return $items;
});
Route::get('/find', function(){
    header("Access-Control-Allow-Origin: *");
    $items = App\Item::where('status','=',1)->get();
    return $items;
});
Route::get('/search', function(Request $req){
    header("Access-Control-Allow-Origin: *");
    $search = App\Item::where('title','like','%'.$req->value.'%')->orWhere('description','like','%'.$req->value.'%')->get();
    return $search;
});
Route::get('add', function(Request $req){
    header("Access-Control-Allow-Origin: *");
    App\Item::create([
        'status'=>$req->status,
        'done'=>0,
        'title'=>$req->title,
        'description'=>$req->desc,
        'contact'=>$req->contact
    ]);
});