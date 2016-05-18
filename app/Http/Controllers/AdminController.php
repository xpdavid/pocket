<?php

namespace App\Http\Controllers;

use App\Item;
use App\Location;
use App\Organization;
use App\Tag;
use App\Type;

use App\Http\Requests\Request;
use App\Http\Requests\ItemRequest;

class AdminController extends Controller
{
    // here is for UI display
    public function getIndex() {
        return view('admin.index');
    }

    public function getAdd() {
        $data = [
            'organizations' => Organization::lists('name', 'id'),
            'locations' => Location::lists('name', 'id'),
            'tags' => Tag::lists('name', 'id'),
            'types' => Type::lists('name', 'id'),
        ];
        return view('admin.add', compact('data'));
    }

    public function getEdit($id) {
        $item = Item::findOrFail($id);
        $data = [
            'organizations' => Organization::lists('name', 'name'),
            'locations' => Location::lists('name', 'name'),
            'tags' => Tag::lists('name', 'name'),
            'types' => Type::lists('name', 'name'),
        ];
        return view('admin.edit', compact('data', 'item'));
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

        $this->syncTags($item, $request);

        return redirect(action('AdminController@getEdit', ['id' => $item->id])); // to add page

    }


    public function postEdit($id, ItemRequest $request) {
        $item = Item::findOrFail($id);
        $item->update($request->all());

        $this->syncTags($item, $request);

        return redirect(action('AdminController@getEdit', ['id' => $id]));

    }

    public function postUpload($id, Request $request) {
        $this->validate($request, [
            'file' => 'required|mimes:jpeg,bmp,png'
        ], [
            'file' => '图片格式为 jpeg,bmp,png, 大小无限制'
        ]);
        if (!$id) {
            abort(500);
        }
        $image = Image::createImage($request->file('file'));
        $item = Item::findOrFail($id);
        $item->images()->save($image);
    }

    /**
     * sync tags data. the tags can be created or updated, thus, we need to update
     *
     * @param Item $item
     * @param ItemRequest $request
     */
    public function syncTags(Item $item, ItemRequest $request) {
        // clear all relationship first
        $item->organizations()->detach();
        $item->tags()->detach();
        $item->types()->detach();
        $item->locations()->detach();

        foreach($request->get('organization_list') as $_organizations) {
            $organizations = Organization::findOrCreate($_organizations);
            $item->organizations()->save($organizations);
        }

        foreach($request->get('type_list') as $_type) {
            $type = Type::findOrCreate($_type);
            $item->types()->save($type);
        }

        foreach($request->get('location_list') as $_location) {
            $location = Location::findOrCreate($_location);
            $item->locations()->save($location);
        }

        foreach($request->get('tag_list') as $_tag) {
            $tag = Tag::findOrCreate($_tag);
            $item->tags()->save($tag);
        }
    }
}
