<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = []; //preciso disso para poder adicionar

    public function user() {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function getProjectAtributes($project) {
    	return ($project ? asset('storage/' . $project) : asset('public/teste.jpg'));
    }

}
