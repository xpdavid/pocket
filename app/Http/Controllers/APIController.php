<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Location;
use App\Organization;
use App\Tag;
use App\Type;

use App\Http\Requests;

class APIController extends Controller
{
    public function getOrganizations() {
        return Organization::all();
    }
}
