<?php

namespace App\Model;

use App\Zl\Model\MyModel;
use Illuminate\Database\Eloquent\Model;

class Setting extends MyModel
{

    public $timestamps = false;

    public static  function getValueType ()
    {
        return [
            '1' => '文本框',
            '2' => '图片',
            '3' => '富文本',
        ];
    }
}
