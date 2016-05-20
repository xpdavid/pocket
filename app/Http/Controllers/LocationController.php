<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use App\Http\Requests;
use View;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.location.index');
    }

    public function postGetAll() {
        $json_response = [];
        $results = Location::all();
        foreach ($results as $location) {
            $json_item = [];
            $operation_edit = sprintf("<a href='%s'>编辑</a>", route('admin.location.edit', ['id' => $location->id]));
            $query_search = sprintf("<a href='%s'>%d 条数据,点击查询</a>",
                action('PocketController@getSearch',
                    [
                        'locations' => $location->name
                    ]), $location->items->count());

            array_push($json_item, $location->name, $query_search, $operation_edit);
            array_push($json_response, $json_item);
        }
        return ['data' => $json_response,
            'recordsTotal' => $results->count(),
            'recordsFiltered' => $results->count()
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $location = Location::findOrFail($id);
        View::share('location', $location);
        return view('admin.location.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ], [
            'name.required' => '请填写名称!'
        ]);
        $location = Location::findOrFail($id);
        $location->update($request->all());

        return redirect(route('admin.location.index'));
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
}
