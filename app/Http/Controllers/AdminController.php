<?php

namespace App\Http\Controllers;

use App\Item;
use App\Location;
use App\Organization;
use App\Tag;
use App\Type;
use App\Attachment;

use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;

class AdminController extends Controller
{
    // here is for UI display
    public function getOverall() {
        return view('admin.index');
    }

    public function getLocation() {
        return view('admin.location');
    }

    public function getOrganization() {
        return view('admin.organization');
    }

    public function getSearch() {
        return view('admin.search');
    }

    public function getTag() {
        return view('admin.tag');
    }

    public function getType() {
        return view('admin.type');
    }


}
