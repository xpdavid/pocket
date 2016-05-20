<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Item;
use App\Organization;
use App\Location;
use App\Tag;
use App\Type;

use App\Http\Requests;

class AdminController extends Controller
{
    public function Overall() {
        $current_year = Carbon::now()->year;
        $current_year_begin =  Carbon::create($current_year, 1, 1)->toDateString();
        $current_year_end = Carbon::create($current_year, 12, 31)->toDateString();
        $data = [
            'current_year' => $current_year,
            'pocket_current_year_count' => Item::dateBetween(
                $current_year_begin,
                $current_year_end
                )->count(),
            'current_year_begin' => $current_year_begin,
            'current_year_end' => $current_year_end,
            'pocket_count' => Item::all()->count(),
            'locations_count' => Location::all()->count(),
            'types_count' => Type::all()->count(),
            'tags_count' => Tag::all()->count(),
            'organizations_count' => Organization::all()->count()
        ];
        return view('admin.index', compact('data'));
    }
}
