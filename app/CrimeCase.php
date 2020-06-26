<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CrimeCase extends Model
{
    use SoftDeletes;
    //
    protected $table = 'cases';

    public function officer()
    {
        return $this->belongsTo(Officer::class);
    }
}
