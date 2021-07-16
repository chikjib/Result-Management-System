<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormTeacher extends Model
{
    //
    protected $fillable = ['passport','signature','surname','firstname','sex','address','phone_no','qualification','state','class','subjects_taught'];  
}
