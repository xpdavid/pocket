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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pocket.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->selectData();
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
        $item = Item::findOrFail($id);
        $data = $this->selectData();
        View::share('item', $item);
        return view('admin.pocket.show', compact('item', 'data'));
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
        $data = $this->selectData();

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
        $data = $request->all();
        $data['published'] = $request->input('published', false);
        $item = Item::findOrFail($id);
        $item->update($data);

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
        $item = Item::findOrFail($id);
        // first delete the attachements
        foreach ($item->attachments as $attachment) {
            $attachment->delete();
        }

        // clear all relationship, not delete because there are other pocket share with the tag etc.
        $item->organizations()->detach();
        $item->tags()->detach();
        $item->types()->detach();
        $item->locations()->detach();

        // delete itself
        $item->delete();

        return [
            'status' => 1
        ];

    }

    /**
     * Return the search view
     *
     * @return View
     */
    public function getSearch(Request $request) {
        $data = $this->selectData();
        $param = [
            'locations' => explode(',', $request->get('locations')),
            'organizations' => explode(',', $request->get('organizations')),
            'tags' => explode(',', $request->get('tags')),
            'types' => explode(',', $request->get('types')),
            'date1' => $request->get('date1'),
            'date2' => $request->get('date2')
        ];
        return view('admin.pocket.search', compact('data', 'param'));
    }

    /**
     * Provide Search API
     *
     * @param array $request
     * @return mixed
     */
    public function APISearch($request) {
        $name = array_key_exists('name', $request) ? $request['name'] : '';
        $date1 = array_key_exists('date1', $request) ? $request['date1'] : '';
        $date2 = array_key_exists('date2', $request) ? $request['date2'] : '';
        $organizations = array_key_exists('organization_list', $request) ? $request['organization_list'] : '';
        $locations = array_key_exists('location_list', $request) ? $request['location_list'] : '';
        $types = array_key_exists('type_list', $request) ? $request['type_list'] : '';
        $tags = array_key_exists('tag_list', $request) ? $request['tag_list'] : '';
        return Item::Named($name)
            ->dateBetween($date1, $date2)
            ->searchList('organizations', $organizations)
            ->searchList('locations', $locations)
            ->searchList('types', $types)
            ->searchList('tags', $tags);

    }

    /**
     * Handle search request
     *
     * @param Request $request
     * @return array
     */
    public function postSearch(Request $request) {
        $results = $this->APISearch($request->all())->get();
        $json_response = [];
        foreach ($results as $item) {
            $json_item = [];
            $operation_show = sprintf("<a href='%s'>查看</a>", route('admin.pocket.show', ['id' => $item->id]));
            $operation_edit = sprintf(" <a href='%s'>编辑</a>", route('admin.pocket.edit', ['id' => $item->id]));
            $operation_delete = sprintf(" <button type=\"button\" class=\"btn btn-danger btn-xs\" onclick=\"generic_delete('pocket', %d)\">删除</button>",
                $item->id
            );
            $operations = $operation_show . $operation_edit . $operation_delete;
            if($item->published) {
                $name = "<span style='color:#5bc0de'>" . $item->name . "</span>";
            } else {
                $name = $item->name;
            }
            array_push($json_item, null, $name, $item->organization_list_string, $item->date, $operations);
            array_push($json_response, $json_item);
        }
        return ['data' => $json_response,
                'recordsTotal' => $results->count(),
                'recordsFiltered' => $results->count()
            ];
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

    /**
     * Generate the select data
     * like all the organization list etc..
     *
     * @return array
     */
    public function selectData() {
        return [
            'organizations' => Organization::lists('name', 'name'),
            'locations' => Location::lists('name', 'name'),
            'tags' => Tag::lists('name', 'name'),
            'types' => Type::lists('name', 'name'),
        ];
    }
}
