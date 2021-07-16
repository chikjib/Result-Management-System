<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbljss1studentFirstTerm extends Model
{
    //

    public $timestamps = false;
    protected $fillable = [
        'passport','admission_no','surname','firstname','othername','sex','date_of_birth','name_of_parents','address','state','phone_no','class','block','session'
    ];

    // public function tbljss1positions()
    // {
    // 	return $this->hasMany(Tbljss1position::class,'admission_no');
    // }
}
