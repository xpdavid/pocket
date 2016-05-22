<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name',
    ];

    // has many items
    public function items() {
        return $this->belongsToMany('App\Item');
    }

    public static function findOrCreate($name) {
       if (Location::all()->where('name', $name)->count() > 0) {
           $location = Location::all()->where('name', $name)->first();
       } else {
           $location = Location::create(['name' => $name]);
       }
        return $location;
    }

    public static function findNameOrFail($name) {
        return Location::where('name', $name)->firstOrFail();
    }

    
}
