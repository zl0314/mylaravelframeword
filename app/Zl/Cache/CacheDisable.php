<?php
/**
 * Created by Aaron Zhang.
 * 禁用缓存
 * Date: 2018/4/20 14:44
 * FileName : CacheDisable.php
 */

namespace App\Zl\Cache;


use App\Repertory\CacheSwitch;
use Closure;

class CacheDisable implements CacheSwitch
{
    public function setTag ( $tag )
    {
        // Do Nothing
    }

    public function remember ( $key, Closure $entity, $tag = null )
    {
        return $entity();
    }

    public function forget ( $key, $tag = null )
    {
        // Do Nothing
    }

    public function clearCache ( $tag = null )
    {
        // Do Nothing
    }

    public function clearAllCache ()
    {
        // Do Nothing
    }

}