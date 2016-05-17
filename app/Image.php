<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    // belong to some item
    public function item() {
        return $this->belongsTo('App\Item');
    }
}
