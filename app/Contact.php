<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];
    protected $dates = ['birthday'];

    /**
     * Simple API Extension for DateTime format.
     * save string dates as timestamps - correct
     */
    public function setBirthdayAttribute($birthday)
    {
        $this->attributes['birthday'] = Carbon::parse($birthday);
    }
}