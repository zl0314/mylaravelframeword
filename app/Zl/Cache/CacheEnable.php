<?php
/**
 * Created by Aaron Zhang.
 * 启用缓存
 * Date: 2018/4/20 14:44
 * FileName : CacheEnable.php
 */

namespace App\Zl\Cache;


use App\Repertory\CacheSwitch;
use Closure;

class CacheEnable implements CacheSwitch
{
    public $tag;
    public $cacheTime = 0;

    public function setTag ( $tag )
    {
        $this->tag = $tag;
    }

    public function remember ( $key, Closure $entity, $tag = null )
    {
        $this->cacheTime = config( 'cache.expire' );

        return cache()->tags( $tag == null ? $this->tag : $tag )->remember( $key, $this->cacheTime, $entity );
    }

    public function forget ( $key, $tag = null )
    {
        cache()->tags( $tag == null ? $this->tag : $tag )->forget( $key );
    }

    public function clearCache ( $tag = null )
    {
        cache()->tags( $tag == null ? $this->tag : $tag )->flush();
    }

    public function clearAllCache ()
    {
        cache()->flush();
    }
}