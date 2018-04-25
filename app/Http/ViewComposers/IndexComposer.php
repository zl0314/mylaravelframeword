<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2018/1/9
 * Time: 15:16
 */

namespace App\Http\ViewComposers;
use Illuminate\View\View;

class IndexComposer
{
    /**
     * 将数据绑定到视图。
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        return $view->with('test','我是通过 【视图合成器】注册的变量');
    }
}