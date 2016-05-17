<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $fillable = [
        'name',
    ];

    // has many items
    public function items() {
        return $this->belongsToMany('App\Item');
    }

    public static function findOrCreate($name) {
        if (Tag::all()->where('name', $name)->count() > 0) {
            $tag = Tag::all()->where('name', $name)->first();
        } else {
            $tag = Tag::create(['name' => $name]);
        }
        return $tag;
    }
}
