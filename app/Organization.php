<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = [
        'name'
    ];

    // has many items
    public function items() {
        return $this->belongsToMany('App\Item');
    }

    public static function findOrCreate($name) {
        if (Organization::all()->where('name', $name)->count() > 0) {
            $organization = Organization::all()->where('name', $name)->first();
        } else {
            $organization = Organization::create(['name' => $name]);
        }
        return $organization;
    }
}
