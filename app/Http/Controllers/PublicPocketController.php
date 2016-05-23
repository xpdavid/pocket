<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Item;

class PublicPocketController extends Controller
{


    public function getIndex() {
        $items = Item::all();

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

        $data = [
            'orientations' => $candidate_class1,
            'color_classes' => $candidate_class2,
            'icons' => $candidate_class3,
        ];

        return view('pocket.index', compact('items', 'data'));
    }
}
