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

    public function getOrganizationListStringAttribute() {
        return implode(',', $this->getOrganizationListAttribute());
    }

    public function getLocationListStringAttribute() {
        return implode(',', $this->getLocationListAttribute());
    }

    public function getTagListStringAttribute() {
        return implode(',', $this->getTagListAttribute());
    }

    public function getTypeListStringAttribute() {
        return implode(',', $this->getTypeListAttribute());
    }

    public function getDateOnlyYearMonthAttribute() {
        return Carbon::parse($this->date)->format('Y-m');
    }


    // scope
    public function scopeNamed($query, $value) {
        if ($value == "") {
            return $query;
        } else {
            return $query->where('name', 'LIKE', '%' . $value . '%');
        }
    }

    public function scopeDateBetween($query, $date1, $date2) {
        if ($date1 == "" && $date2 == "") {
            return $query;
        } else if ($date2 == "") {
            return $query->whereBetween('date', [$date1, '9999-12-01']);
        } else if ($date1 == "") {
            return $query->whereBetween('date', ['1840-12-01', $date2]);
        } else {
            return $query->whereBetween('date', [$date1, $date2]);
        }
    }



    public function scopeSearchList($query, $type, $values) {
        if ($values) {
            foreach ($values as $value) {
                $query->WhereHas($type, function($q) use ($value) {
                    return $q->where('name', $value);
                });
            }
        } else {
            return $query;
        }
    }
    

}
