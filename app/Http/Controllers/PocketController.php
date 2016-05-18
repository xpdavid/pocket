<?php

namespace App\Http\Controllers;

use App\Item;
use App\Location;
use App\Organization;
use App\Tag;
use App\Type;
use App\Attachment;
use View;

use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;

class PocketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'organizations' => Organization::lists('name', 'name'),
            'locations' => Location::lists('name', 'name'),
            'tags' => Tag::lists('name', 'name'),
            'types' => Type::lists('name', 'name'),
        ];
        return view('admin.pocket.add', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        $item = Item::create($request->all());

        $this->syncTags($item, $request);

        return redirect(route('admin.pocket.edit', ['id' => $item->id])); // to add page

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'organizations' => Organization::lists('name', 'name'),
            'locations' => Location::lists('name', 'name'),
            'tags' => Tag::lists('name', 'name'),
            'types' => Type::lists('name', 'name'),
        ];
        return view('admin.pocket.search', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $data = [
            'organizations' => Organization::lists('name', 'name'),
            'locations' => Location::lists('name', 'name'),
            'tags' => Tag::lists('name', 'name'),
            'types' => Type::lists('name', 'name'),
        ];

        View::share('item', $item);

        return view('admin.pocket.edit', compact('data', 'item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemRequest $request, $id)
    {
        $item = Item::findOrFail($id);
        $item->update($request->all());

        $this->syncTags($item, $request);

        return redirect(route('admin.pocket.edit', ['id' => $item->id])); // to add page

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
