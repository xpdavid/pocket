<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Organization;
use App\Http\Requests;
use View;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.organization.index');
    }

    public function postGetAll() {
        $json_response = [];
        $results = Organization::all();
        foreach ($results as $organization) {
            $json_item = [];
            $operation_edit = sprintf("<a href='%s'>编辑</a>", route('admin.organization.edit', ['id' => $organization->id]));
            $query_search = sprintf("<a href='%s'>%d 条数据,点击查询</a>",
                action('PocketController@getSearch',
                    [
                        'organizations' => $organization->name
                    ]), $organization->items->count());
            array_push($json_item, $organization->name, $query_search, $operation_edit);
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
        $organization = Organization::findOrFail($id);
        View::share('organization', $organization);
        return view('admin.organization.edit', compact('organization'));
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
        $organization = Organization::findOrFail($id);
        $organization->update($request->all());

        return redirect(route('admin.organization.index'));
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
