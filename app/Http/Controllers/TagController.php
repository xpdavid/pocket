<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Http\Requests;
use View;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tag.index');
    }

    public function postGetAll() {
        $json_response = [];
        $results = Tag::all();
        foreach ($results as $tag) {
            $json_item = [];
            $operation_edit = sprintf("<a href='%s'>编辑</a>", route('admin.tag.edit', ['id' => $tag->id]));
            $query_search = sprintf("<a href='%s'>%d 条数据,点击查询</a>",
                action('PocketController@getSearch',
                    [
                        'tags' => $tag->name
                    ]), $tag->items->count());
            array_push($json_item, $tag->name, $query_search, $operation_edit);
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
        $tag = Tag::findOrFail($id);
        View::share('tag', $tag);
        return view('admin.tag.edit', compact('tag'));
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
        $tag = Tag::findOrFail($id);
        $tag->update($request->all());

        return redirect(route('admin.tag.index'));
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
