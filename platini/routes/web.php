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

Route::get('/', function () {
    return view('welcome');
});


Route::get('get/bookmarks/{count?}', function ($count=10) {
    $bookmarks = Bookmark::orderBy('uid', 'DESC')->take($count)->get();
    
    return Response::json($bookmarks);
});


Route::get('get/bookmark', function (Request $request) {
	$bookmark = Bookmark::where('url', '=', $request->url)->firstOrFail();
    $comments = Bookmark::find($bookmark->uid)->comments;
    $bookmark->comments->add($comments);
    
    return Response::json($bookmark);
});


Route::post('create/bookmark', function (Request $request) {
    $bookmark = Bookmark::updateOrCreate(['url' => $request->url], $request->all());

    return Response::json($bookmark);
});


Route::post('bookmark/{uid?}/create/comment', function (Request $request, $uid) {
	$request->merge(['bookmark_uid'=>$uid]);
	$comment_uid = Comment::create($request->all());

    return Response::json($comment_uid);
});


Route::put('change/comment/{comment_uid?}', function (Request $request, $comment_uid) {
    $comment = Comment::find($comment_uid);
    $comment->comment     = $request->comment;

    $created = new Carbon($comment->created_at);
    $created->addHour();
    $now = Carbon::now();
	
	if($created->gte($now)){
    	$comment->save();
    	return	Response::json($comment);
    }
    else{
		return	Response::json((object) array('status' => 'deadline'));
	}

    
});


Route::delete('destroy/comment/{comment_uid?}', function ($comment_uid) {
	$comment = Comment::find($comment_uid);
    
    $created = new Carbon($comment->created_at);
    $created->addHour();
    $now = Carbon::now();
	
	if($created->gte($now)){
		$comment = Comment::destroy($comment_uid);
    	return Response::json($comment);
	}
	else{
		return	Response::json((object) array('status' => 'deadline'));
	}
    
});