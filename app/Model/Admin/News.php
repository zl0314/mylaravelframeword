<?php

namespace App\Model\Admin;

use App\Model\Common\CommonNews;

class News extends CommonNews
{
    public static function getWhere($model)
    {
        $where = [];
        $whereRaw = ' 1 ';
        if (request()->get('title')) {
            $whereRaw .= " and title like '%" . request()->get('title') . "%'";
        }
        if (request()->get('type')) {
            $where['type'] = request()->get('type');
        }
        return $model->whereRaw($whereRaw)->where($where);
    }

    //是否推荐到首页轮播
    public static function getType()
    {
        return [
            1 => '公司动态',
            2 => '行业动态',
        ];
    }

}
