# Bookmark 

before: the html page must include ```html <head><meta name="csrf-token" content="{{ csrf_token() }}" /></head>```
if uoy used jqery plaese before Request execute: $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});


##get/bookmarks/

	Method: GET
		Resource URL : get/bookmarks/{count}
	Parameters:
		count : Specifies the number of Bookmarks to try and retrieve. default 10.

	respond json example:
		[
			{	"uid":2,
				"url":"https:\/\/gist.github.com\/luchaninov\/6985193e84f3a4fe4de408e442aeea8b",
				"remember_token":null,
				"created_at":"2016-09-14 08:08:37",
				"updated_at":"2016-09-14 08:08:37"
			 },
			 {"uid":1,
			  "url":"http:\/\/www.tutorials.kode-blog.com\/laravel-5-ajax-tutorial",
			  "remember_token":null,
			  "created_at":"2016-09-14 08:08:15",
			  "updated_at":"2016-09-14 08:08:15"
			 }
		 ]

##get/bookmark

	Method: GET
		Resource URL : get/bookmark
		?url={url}
	Parameters:
		url : the url of Bookmark to try and retrieve.

	respond json example:
		{
			"uid":2,
			"url":"https:\/\/gist.github.com\/luchaninov\/6985193e84f3a4fe4de408e442aeea8b",
			"remember_token":null,
			"created_at":"2016-09-14 08:08:37",
			"updated_at":"2016-09-14 08:08:37",
			"comments":[
				{"uid":4,
				 "bookmark_uid":2,
				 "comment":
				 "I am frodo",
				 "remember_token":null,
				 "created_at":"2016-09-15 13:06:23",
				 "updated_at":"2016-09-14 13:21:29"
				},
				{"uid":5,
				 "bookmark_uid":2,
				 "comment":"Hellow World",
				 "remember_token":null,
				 "created_at":"2016-09-14 12:06:23",
				 "updated_at":"2016-09-14 14:06:47"
				},
				{"uid":6,
				 "bookmark_uid":2,
				 "comment":"thank you",
				 "remember_token":null,
				 "created_at":"2016-09-14 13:40:37",
				 "updated_at":"2016-09-14 13:40:37"
				}
			]
		}


##create/bookmark

	Method: POST
		Resource URL : create/bookmark
		
		Request json: {url: url}
		Request example: {"url": "https:\/\/gist.github.com\/luchaninov\/6985193e84f3a4fe4de408e442aeea8b"} 
	Parameters:
		url : url to add

	respond json example:
		{
			"uid":2,
			"url":"https:\/\/gist.github.com\/luchaninov\/6985193e84f3a4fe4de408e442aeea8b",
			"remember_token":null,
			"created_at":"2016-09-14 08:08:37",
			"updated_at":"2016-09-14 08:08:37"
		}

##bookmark/{uid?}/create/comment

	Method: POST
		Resource URL : bookmark/{bookmark_uid?}/create/comment
		Resource URL example: bookmark/1/create/comment
		
		Request json: {comment: comment}
		Request example: {"comment": "hellow World"} 
	Parameters:
		comment : Comment for the special bookmark

	respond json example:
		{
			"uid":1,
			"coment":"hellow World",
			"remember_token":null,
			"created_at":"2016-09-14 08:08:37",
			"updated_at":"2016-09-14 08:08:37"
		}

##change/comment/{comment_uid?}

	Method: PUT
		Resource URL : change/comment/{comment_uid?}
		Resource URL example: change/comment/6
		
		Request json: {comment: comment}
		Request example: {"comment": "thank you"} 
	Parameters:
		comment : Comment for the special bookmark

	respond json example:
		{
			"uid":1,
			"coment":"thank you",
			"remember_token":null,
			"created_at":"2016-09-14 08:08:37",
			"updated_at":"2016-09-14 11:12:55"
		}
		/dedline

//----------------------------------------------------
if since the establishment in less than a hour then allowed 
another deadline

##destroy/comment/{comment_uid?}

	Method: DELETE
		Resource URL : destroy/comment/{comment_uid?}
		Resource URL example: destroy/comment/6
		
	respond example: true/dedline
		
//----------------------------------------------------
if since the establishment in less than a hour then allowed 
another deadline


