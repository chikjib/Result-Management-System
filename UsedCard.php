<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsedCard extends Model
{
    //
    protected $fillable = ['admin_no','used_count','pin_no','serial_no'];
    
}
