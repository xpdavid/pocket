<?php

namespace App\Http\Controllers;

use App\Item;
use App\Location;
use App\Organization;
use App\Tag;
use App\Type;

use App\Http\Requests;
use App\Http\Requests\ItemRequest;

class AdminController extends Controller
{
    // here is for UI display
    public function getIndex() {
        return view('admin.index');
    }

    public function getAdd() {
        return view('admin.add');
    }

    public function getEdit() {
        return view('admin.edit');
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

    // handel request
    public function postAdd(ItemRequest $request) {
        $item = Item::create($request->all());

        foreach($request->get('organizations') as $_organizations) {
            $organizations = Organization::findOrCreate($_organizations);
            $item->organizations()->save($organizations);
        }

        foreach($request->get('types') as $_type) {
            $type = Type::findOrCreate($_type);
            $item->types()->save($type);
        }

        foreach($request->get('locations') as $_location) {
            $location = Location::findOrCreate($_location);
            $item->locations()->save($location);
        }

        foreach($request->get('tags') as $_tag) {
            $tag = Tag::findOrCreate($_tag);
            $item->tags()->save($tag);
        }

        return redirect('/admin/add'); // to add page

    }
}
