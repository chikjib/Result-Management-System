<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    //
    protected $fillable = ['passport','signature','surname','firstname','sex','address','phone_no','qualification','state','portfolio','class','block','subjects_taught'];  
}
