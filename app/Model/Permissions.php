<?php

namespace App\Model;

use App\Zl\Model\MyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Permissions extends MyModel
{
    public static function getWhere ( $model )
    {
        return $model->where( [ 'fid' => 0 ] );
    }

    /**
     *  获取所有权限菜单， 用在添加菜单的时候， 级别选择,让所有的菜单有一个上下级别
     * @return mixed
     */
    public static function treePermisstionsByLevel ()
    {
        $lists = self::getALLMenus();

        $treeList = [];
        foreach ( $lists as $k => $r ) {
            if ( $r['fid'] != 0 ) {
                continue;
            }
            $r['level'] = 0;
            $treeList[ $r['id'] ] = $r;
            unset( $r[ $k ] );
            $temp = self::getSubmenusByLevel( $r['id'], $lists, 1 );
            if ( is_array( $temp ) ) {
                foreach ( $temp as $v ) {
                    if ( !is_array( $v ) ) {
                        continue;
                    }
                    $treeList[ $v['id'] ] = $v;
                }
            }
        }

        return $treeList;

    }

    /**
     * 得到一级菜单的子菜单
     *
     * @param $id    父级ID
     * @param $lists 所有权限菜单
     * @param $level 默认级别
     *
     * @return array
     */
    protected static function getSubmenusByLevel ( $cur_id, $lists, $level = 0 )
    {
        $return = [];
        foreach ( $lists as $k => $r ) {
            if ( $r['fid'] != $cur_id ) {
                continue;
            }
            $r['level'] = $level;
            $return[] = $r;
            unset( $lists[ $k ] );
            $subMenu = self::getSubmenusByLevel( $r['id'], $lists, $level + 1 );
            if ( is_array( $subMenu ) ) {
                foreach ( $subMenu as $val ) {
                    if ( !is_array( $val ) ) {
                        continue;
                    }
                    $return[] = $val;
                }
            }
        }

        return $return;
    }

    /**
     * 获取所有权限菜单， 分上下级， 只要有下级菜单，就会有submenu属性， 用在后台导航栏循环
     * @return mixed
     */
    public static function treePermisstionsBySubMenus ()
    {
        $lists = self::getALLMenus();
        $treeList = [];
        foreach ( $lists as $k => $r ) {
            if ( $r['fid'] != 0 ) {
                continue;
            }
            $r['level'] = 0;
            $treeList[ $r['id'] ] = $r;
            unset( $r[ $k ] );
            $temp = self::getSubmenusBySubMenus( $r['id'], $lists, $treeList[ $r['id'] ] );
            if ( is_array( $temp ) && !empty( $temp ) ) {
                $treeList[ $r['id'] ]['parent'] = $treeList[ $r['id'] ];
                $treeList[ $r['id'] ]['submenu'] = $temp;
            }
        }

        return $treeList;
    }

    /**
     * 获取一级菜单下所有子菜单
     *
     * @param $cur_id 当前栏目ID
     * @param $lists  所有菜单
     *
     * @return array
     */
    public static function getSubmenusBySubMenus ( $cur_id, $lists, $parent, $sparent = null )
    {
        $temp = [];
        foreach ( $lists as $k => $r ) {
            if ( $r['fid'] == $cur_id ) {
                $temp[ $k ] = $r;
                $temp[ $k ]['parent'] = $parent;
                $temp[ $k ]['second_parent'] = $r['fid'];
                unset( $lists[ $k ] );
                $temp[ $k ]['submenu'] = self::getSubmenusBySubMenus( $r['id'], $lists, $parent );
            }
        }

        return $temp;
    }

    /**
     * 得到所有的权限菜单
     * @return mixed
     */
    protected static function getALLMenus ()
    {
        //查询管理员所在的角色， 获取所拥有角色的所有权限
        $admin = AdminUsers::findOrFail( Auth::guard( 'admin' )->user()->id );
        if ( !$admin->is_super ) {
            return app( 'Zcache' )->remember( 'permisstions_' . $admin->id, function () use ( $admin ) {

                $roles = $admin->roles()->with( [ 'permissions' ] )->get();
                $permissions = [];
                foreach ( $roles as $r ) {
                    foreach ( $r->permissions()->get()->toArray() as $permission ) {
                        $permissions[] = $permission;
                    }
                }

                return $permissions;
            } );
        } else {
            return app( 'Zcache' )->remember( 'permisstions' . $admin->id, function () {
                $lists = Permissions::where( [ 'is_menu' => 1 ] )
                    ->orderBy( 'sort', 'desc' )
                    ->orderBy( 'id', 'desc' )
                    ->get()
                    ->toArray();

                return $lists;
            } );
        }
    }
}
