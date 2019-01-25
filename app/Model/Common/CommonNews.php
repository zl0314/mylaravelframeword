<?php

namespace App\Model\Common;

use App\Zl\Model\MyModel;

class CommonNews extends MyModel
{

    //获取时，解转义
    public function getPicsAttribute($val)
    {
        return json_decode($val,1);
    }

    //保存时给内容转义
    public function setPicsAttribute($val)
    {
        $this->attributes['pics'] = json_encode($val);
    }

    //获取新闻类型
    public static function getType()
    {
        return [
            1 => '集团新闻',
            2 => '项目动态',
            3 => '媒体聚焦 ',
            4 => '社会责任',
        ];
    }
}
