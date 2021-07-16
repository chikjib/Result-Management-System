<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tblss3markThirdTerm extends Model
{
    //
    public $timestamps = false;
    protected $fillable = ['surname','firstname','othername', 'admission_no','session','block','marks'];

}
