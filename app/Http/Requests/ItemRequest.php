<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ItemRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'date' => 'required',
            'organizations' => 'required',
            'locations' => 'required',
            'types' => 'required',
            'tags' => 'required'
        ];
    }


    public function messages()
    {
        return [
            'name.required' => '奖状名字要填写.',
            'date.required' => '获奖日期要填写.',
            'organizations.required' => '颁发组织要填写, 如果没有, 用无代替.',
            'locations.required' => '奖状存放地点要填写.',
            'types.required' => '奖状形式要填写.',
            'tags.required' => '添加一个标签吧.',
         ];
    }
}
