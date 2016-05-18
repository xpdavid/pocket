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
        $date = Carbon::createFromFormat('Y-m-d', $date);
        $this->attributes['date'] = $date;
    }

    // has many images
    public function attachments() {
        return $this->hasMany('App\Attachment');
    }

    public function getLocationListAttribute() {
        return $this->locations->lists('name')->all();
    }

    public function getOrganizationListAttribute() {
        return $this->organizations->lists('name')->all();
    }

    public function getTagListAttribute() {
        return $this->tags->lists('name')->all();
    }

    public function getTypeListAttribute() {
        return $this->types->lists('name')->all();
    }
}
