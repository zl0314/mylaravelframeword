<?php

namespace App\Http\Requests;

use App\Zl\Requests\CommonRequest;
use Illuminate\Foundation\Http\FormRequest;

class PermissionsRequest extends CommonRequest
{

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules ()
    {
        return [
            'fid'          => 'required',
            //'name'         => 'required',
            'display_name' => 'required',
            //'description'  => 'required',
            'is_menu'      => 'required',
            'sort'         => 'required',
        ];
    }

    public function messages ()
    {
        return [
            'fid.required'          => '所属菜单不能为空',
            'name.required'         => '名称不能为空',
            'display_name.required' => '显示名不能为空',
            //'description.required'  => '描述不能为空',
            'is_menu.required'      => '是否菜单不能为空',
            'sort.required'         => '排序不能为空',
        ];
    }
}
