<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    //
    protected $fillable = ['name', 'surname', 'email'];

    public function case()
    {
        return $this->hasOne(CrimeCase::class);
    }
}
