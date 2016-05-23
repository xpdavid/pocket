<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Item;
use Carbon\Carbon;

class PublicPocketController extends Controller
{


    public function getIndex(Request $request) {
        if ($request->has('year')) {
            $date1 = Carbon::create($request->get('year'), 1, 1)->format('Y-m-d');
            $date2 = Carbon::create($request->get('year'), 12, 31)->format('Y-m-d');
        } else {
            $date1 = "";
            $date2 = "";
        }


        $items = Item::dateBetween($date1, $date2)->get();

        $candidate_class1 = [
            '',
            'timeline-inverted'
        ];

        $candidate_class2 = [
            'warning',
            'danger',
            'info',
            'success',
            ''
        ];

        $candidate_class3 = [
            'cloud',
            'pencil',
            'star',
            'th',
            'ok',
            'home',
            'list-alt'
        ];

        $filter = Item::all()->groupBy(function($item) {
            return Carbon::parse($item->date)->format('Y'); // grouping by month
        });

        $years = array_keys($filter->all());

        $data = [
            'orientations' => $candidate_class1,
            'color_classes' => $candidate_class2,
            'icons' => $candidate_class3,
            'years' => $years
        ];

        return view('pocket.index', compact('items', 'data'));
    }
}
