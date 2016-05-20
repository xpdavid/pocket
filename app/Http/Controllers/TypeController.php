<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use App\Http\Requests;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.type.index');
    }

    public function postGetAll() {
        $json_response = [];
        $results = Type::all();
        foreach ($results as $type) {
            $json_item = [];
            $operation_edit = sprintf("<a href='%s'>编辑</a>", route('admin.type.edit', ['id' => $type->id]));
            $operation_delete = sprintf(" <button type=\"button\" class=\"btn btn-danger btn-xs\" onclick=\"generic_delete('type', %d)\">删除</button>",
                $type->id
            );
            $operation_delete = ($type->items->count() == 0) ? $operation_delete : "";
            $query_search = sprintf("<a href='%s'>%d 条数据,点击查询</a>",
                action('PocketController@getSearch',
                    [
                        'types' => $type->name
                    ]), $type->items->count());
            array_push($json_item, $type->name, $query_search, $operation_edit . $operation_delete);
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
        $type = Type::findOrFail($id);
        View::share('type', $type);
        return view('admin.type.edit', compact('type'));
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
        $type = Type::findOrFail($id);
        $type->update($request->all());

        return redirect(route('admin.type.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = Type::findOrFail($id);
        if ($type->items->count() > 0) {
            return [
                'status' => 0,
                'info' => '此类型下依然有奖状'
            ];
        } else {
            $type->delete();
            return [
                'status' => 1
            ];
        }
    }
}
