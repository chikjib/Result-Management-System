<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    protected $fillable = [
        'category','subject_name'
    ];

    public function students()
    {
    	return $this->hasMany(Student::class,'subject_id');
    }

    public function marks()
    {
    	return $this->hasMany(Mark::class,'subject_id');
    }
}
