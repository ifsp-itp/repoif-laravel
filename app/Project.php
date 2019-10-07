<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    
    protected $guarded = []; //preciso disso para poder adicionar

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
      return $this->hasMany('App\Comment');
    }

    public function likes()
    {
      return $this->hasMany('App\Likes');
    }

    public function getProjectAtributes($project)
    {
    	return ($project ? asset('storage/' . $project) : asset('public/teste.jpg'));
    }

    public static function search($search)
    {
    	return static::where('title', 'LIKE', '%' . $search . '%')->get();
    }
}
