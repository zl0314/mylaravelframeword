<?php

namespace App\Http\Requests;

use App\Zl\Requests\CommonRequest;
use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends CommonRequest
{

    public function rules()
    {
        return array_merge(self::getBaseRequestRule(), [
            'thumb'       => 'required_unless:type,4',
            'description' => 'required',
            'type'        => 'required',
            'content'     => 'required',
        ]);
    }

    public function messages()
    {
        return array_merge(self::getBaseRequestRuleMsg(), [
            'thumb.required_unless'       => '缩略图不能为空',
            'description.required' => '描述',
            'type.required'        => '类别不能为空',
            'content.required'     => '内容不能为空',
        ]);
    }
}
