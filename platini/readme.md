# Bookmark 

before: The html page must include ```html <head><meta name="csrf-token" content="{{ csrf_token() }}" /></head>```

If uoy used jqery plaese before Request execute: 
`$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});`


##get/bookmarks/

	Method: GET
		Resource URL : get/bookmarks/{count}
	Parameters:
		count : Specifies the number of Bookmarks to try and retrieve. default 10.

	respond json example:
		[
			{	"uid":1,
				"url":"https:https://gist.github.com/luchaninov/6985193e84f3a4fe4de408e442aeea8b",
				"created_at":"2016-09-14 08:08:37",
				"updated_at":"2016-09-14 08:08:37"
			 },
			 {"uid":2,
			  "url":"https://github.com/Anderson2000/Mytest/tree/master/platini",
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
			"uid":1,
			"url":"https:https://gist.github.com/luchaninov/6985193e84f3a4fe4de408e442aeea8b",
			"created_at":"2016-09-14 08:08:37",
			"updated_at":"2016-09-14 08:08:37",
			"comments":[
				{"uid":1,
				 "bookmark_uid":1,
				 "comment": "thank you",
				 "ip":"2130706433",
				 "created_at":"2016-09-15 13:06:23",
				 "updated_at":"2016-09-14 13:21:29"
				},
				{"uid":2,
				 "bookmark_uid":1,
				 "comment":"you are welcome",
				 "ip":"2130706433",
				 "created_at":"2016-09-14 12:06:23",
				 "updated_at":"2016-09-14 14:06:47"
				}
			]
		}


##create/bookmark

	Method: POST
		Resource URL : create/bookmark
		
		Request json: {url: url}
		Request example: {"url": "https:https://gist.github.com/luchaninov/6985193e84f3a4fe4de408e442aeea8b"} 
	Parameters:
		url : url to add

	respond json example:
		{
			"uid":1,
			"url":"https:https://gist.github.com/luchaninov/6985193e84f3a4fe4de408e442aeea8b",
			"created_at":"2016-09-14 08:08:37",
			"updated_at":"2016-09-14 08:08:37"
		}

##bookmark/{uid?}/create/comment

	Method: POST
		Resource URL : bookmark/{bookmark_uid?}/create/comment
		Resource URL example: bookmark/1/create/comment
		
		Request json: {comment: comment}
		Request example: {"comment":"thank you"} 
	Parameters:
		comment : Comment for the special bookmark

	respond json example:
		{
			"uid":1,
			"coment":"thank you",
			"ip":"2130706433",
			"created_at":"2016-09-14 08:08:37",
			"updated_at":"2016-09-14 08:08:37"
		}

##change/comment/{comment_uid?}

	Method: PUT
		Resource URL : change/comment/{comment_uid?}
		Resource URL example: change/comment/6
		
		Request json: {comment: comment}
		Request example: {"comment": "thank you:)"} 
	Parameters:
		comment : update comment for the special bookmark

	respond json example:
		{
			"uid":1,
			"coment":"thank you:)",
			"ip":"2130706433",
			"created_at":"2016-09-14 08:08:37",
			"updated_at":"2016-09-14 11:12:55"
		}
		/dedline

*you can edit within an hour (after creation) and only from the ip from which it was created*

##destroy/comment/{comment_uid?}

	Method: DELETE
		Resource URL : destroy/comment/{comment_uid?}
		Resource URL example: destroy/comment/6
		
	respond example: true/dedline
		
*you can edit within an hour (after creation) and only from the ip from which it was created*


