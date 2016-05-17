<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Item extends Model
{
    protected $fillable = [
        'name',
        'note',
        'date',
    ];

    // a honor is issued by organizations
    public function organizations() {
        return $this->belongsToMany('App\Organization');
    }

    // the type of the honor
    public function types() {
        return $this->belongsToMany('App\Type');
    }

    // where the honor locate at?
    public function locations() {
        return $this->belongsToMany('App\Location');
    }

    // self-defing tags
    public function tags() {
        return $this->belongsToMany('App\Tag');
    }

    public function setDateAttribute($date) {
        $date = Carbon::createFromFormat('Y-m', $date);
        $date->day = 1; // always the first day of month
        $this->attributes['date'] = $date;
    }

    // has many images
    public function images() {
        return $this->hasMany('App\Image');
    }
}
