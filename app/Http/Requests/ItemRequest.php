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
            'organization_list' => 'required',
            'location_list' => 'required',
            'type_list' => 'required',
            'tag_list' => 'required'
        ];
    }


    public function messages()
    {
        return [
            'name.required' => '奖状名字要填写.',
            'date.required' => '获奖日期要填写.',
            'organization_list.required' => '颁发组织要填写, 如果没有, 用无代替.',
            'location_list.required' => '奖状存放地点要填写.',
            'type_list.required' => '奖状形式要填写.',
            'tag_list.required' => '添加一个标签吧.',
         ];
    }
}
