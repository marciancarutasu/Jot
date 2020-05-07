<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Contact extends Model
{
    use Searchable;

    protected $guarded = [];
    protected $dates = ['birthday'];

    //axios single contact path.
    public function path()
    {
        return '/contacts/{$this->id}';
    }

    /**
     * set birthday property of contact as proper timestamp instance.
     */
    public function setBirthdayAttribute($birthday)
    {
        $this->attributes['birthday'] = Carbon::parse($birthday);
    }

    /**
     * check whose contact is
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}