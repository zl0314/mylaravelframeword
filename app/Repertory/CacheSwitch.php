<?php
/**
 * Created by Aaron Zhang.
 * Date: 2018/4/20 14:42
 * FileName : CacheSwitch.php
 */

namespace App\Repertory;

use Closure;

interface CacheSwitch
{
    public function setTag ( $tag );

    public function remember ( $key, Closure $entity, $tag = null );

    public function forget ( $key, $tag = null );

    public function clearCache ( $tag = null );

    public function clearAllCache ();
}