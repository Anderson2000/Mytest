<?php

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Bookmark;
use App\Comment;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
//show view welcome laravel 5.3
Route::get('/', function () {
    return view('welcome');
});

//get array last bookmarks (reverse the order)
Route::get('get/bookmarks/{count?}', function ($count=10) {
    $bookmarks = Bookmark::orderBy('uid', 'DESC')->take($count)->get();
    
    return Response::json($bookmarks);
});

//get selected bookmark
Route::get('get/bookmark', function (Request $request) {
	$bookmark = Bookmark::where('url', '=', $request->url)->firstOrFail();
    $comments = Bookmark::find($bookmark->uid)->comments;
    $bookmark->comments->add($comments);
    
    return Response::json($bookmark);
});

//create bookmark
Route::post('create/bookmark', function (Request $request) {
    $bookmark = Bookmark::updateOrCreate(['url' => $request->url], $request->all());

    return Response::json($bookmark);
});

//create comment for bookmark
Route::post('bookmark/{uid?}/create/comment', function (Request $request, $uid) {
	$request->merge(['bookmark_uid'=>$uid]);
    //save ip of client
	$request->merge(['ip'=>ip2long($request->ip())]); 
    
    $comment_uid = Comment::create($request->all());

    return Response::json($comment_uid);
});

//change comment
Route::put('change/comment/{comment_uid?}', function (Request $request, $comment_uid) {
    $comment = Comment::find($comment_uid);
    $comment->comment     = $request->comment;

    $created = new Carbon($comment->created_at);
    $created->addHour();
    $now = Carbon::now();
	
    //you can edit within an hour (after creation) and only from the ip from which it was created
	if($created->gte($now) && $comment->ip == ip2long($request->ip())) {
    	$comment->save();
    	return	Response::json($comment);
    }
    else{
		return	Response::json((object) array('status' => 'deadline'));
	}

    
});

//desstory comment 
Route::delete('destroy/comment/{comment_uid?}', function ($comment_uid) {
	$comment = Comment::find($comment_uid);
    
    $created = new Carbon($comment->created_at);
    $created->addHour();
    $now = Carbon::now();
	
    //you can edit within an hour (after creation) and only from the ip from which it was created
	if($created->gte($now) && $comment->ip == ip2long($request->ip())) {
		$comment = Comment::destroy($comment_uid);
    	return Response::json($comment);
	}
	else{
		return	Response::json((object) array('status' => 'deadline'));
	}
    
});