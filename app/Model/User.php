<?php

namespace App;

use App\Model\Users;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name', 'mobile', 'password', 'type', 'target_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 创建users表里的用户
     */
    public static function createUser ( $target, $type )
    {
        $model = new User;
        //手机号不能重复
        $result = self::where( [ 'mobile' => $target->mobile ] )->first();
        $user_id = 0;
        if ( !empty( $result->id ) ) {
            $user_id = $result->id;
            if ( $target->password != $result->password ) {
                $result->password = $target->password;
                $result->update();
            }
        } else {
            $user_id = $target->id;
            $model->id = $target->id;
            //$model->target_id = $target->id;
            $model->mobile = $target->mobile;
            $model->sex = $target->sex;
            $model->password = $target->password;
            $model->type = $type;
            $model->name = $target->name;
            $model->save();
        }

        return $user_id;
    }

    //得到登录用户的真实身份  1渠道  2经纪人
    public static function getUserTuleRole ()
    {
        $user = Users::findOrFail( Auth::id() );

        return $user;
    }

    //得到搜索条件， 渠道和经纪人在获取客户列表的时候
    public static function getSearchWhere ()
    {
        $where = [];
        if ( Auth::user()->type == 1 ) {
            $where['channels_id'] = Auth::id();
        }
        if ( Auth::user()->type == 2 ) {
            $where['agents_id'] = Auth::id();
        }

        return $where;
    }

}
