<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use FrancescoMalatesta\LaravelReactions\Traits\Reacts;
use FrancescoMalatesta\LaravelReactions\Traits\Reactable;
use FrancescoMalatesta\LaravelReactions\Contracts\ReactableInterface;

class Post extends Model implements ReactableInterface
{
	use Reactable;
    protected $guarded = [];
	
	public function user()
    {
        return $this->belongsTo('App\User')->select(['id', 'name']);
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
