<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{	 protected $primaryKey = 'uid';
     protected $fillable = ['url'];
     protected $guarded = ['uid'];

      public function comments()
		  {
		    return $this->hasMany('App\Comment', 'bookmark_uid', 'uid');
		  }
}
