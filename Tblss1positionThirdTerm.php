<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tblss1positionThirdTerm extends Model
{
    //
    public $timestamps = false;
    
    protected $fillable = ['admission_no','session','block','grandtotal','position'];
}
