<?php
/**
 * Created by Aaron Zhang.
 * Date: 2018/3/22 18:15
 * FileName : MyModel.php
 */

namespace App\Zl\Model;

use Illuminate\Database\Eloquent\Model;

class MyModel extends Model
{
    
    protected $guarded = [];

    public static function getWhere ( $model )
    {
        return $model;
    }

    //保存时给内容转义
    public function setContentAttribute ( $val )
    {
        $this->attributes['content'] = newhtmlspecialchars( $val );
    }

    //获取时，解转义
    public function getContentAttribute ( $val )
    {
        return htmlspecialchars_decode( $val );
    }

}