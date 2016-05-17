<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'name',
    ];
    // has many items
    public function items() {
        return $this->belongsToMany('App\Item');
    }

    public static function findOrCreate($name) {
        if (Type::all()->where('name', $name)->count() > 0) {
            $type = Type::all()->where('name', $name)->first();
        } else {
            $type = Type::create(['name' => $name]);
        }
        return $type;
    }
}
