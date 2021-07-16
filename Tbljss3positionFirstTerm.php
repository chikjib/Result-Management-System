<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbljss3positionFirstTerm extends Model
{
    //
    public $timestamps = false;
    
    protected $fillable = ['admission_no','session','block','grandtotal','position'];
}
