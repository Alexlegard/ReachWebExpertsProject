<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $table = 'followers';

    protected $fillable = ['follower_id', 'leader_id'];

    public function follower()
    {
    	return $this->hasOne(User::class);
    }

    public function leader()
    {
    	return $this->hasOne(User::class);
    }
}
