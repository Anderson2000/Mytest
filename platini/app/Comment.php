<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{	
	protected $primaryKey = 'uid';
    protected $fillable = ['bookmark_uid', 'comment', 'ip'];
    protected $guarded = ['uid'];


}
