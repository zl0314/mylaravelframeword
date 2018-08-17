<?php
/**
 * Created by Aaron Zhang.
 * Date: 2018/4/23 18:20
 * FileName : Menus.php
 */

namespace App\Services;


use App\Model\Admin\Permissions;
use Illuminate\Support\Facades\Route;

class Menus
{
    //顶级菜单
    public static function getTopMenus ()
    {
        $menus = Permissions::treePermisstionsBySubMenus();
        $html = '<ul class="nav navbar-nav" id="top_nav">';
        $i = 0;
        foreach ( $menus as $k => $r ) {
            $active = '';
            if ( $i == 0 ) {
                $active = 'class="active"';
            }
            $html .= '<li ' . $active . ' id="topMenu_' . $r['id'] . '"><a href="javascript:;">' . $r['display_name'] . '</a></li>';
            $i++;
        }
        $html .= '</ul>';

        return $html;
    }

    //左侧二级菜单
    public static function getLeftMenus ( $siteClass )
    {
        $menus = Permissions::treePermisstionsBySubMenus();
        $html = '';
        $i = 0;
        foreach ( $menus as $k => $r ) {

            $none = $i == 0 ? '' : 'none';
            $html .= '<ul class="menus ' . $none . '" id="leftMenu_' . $r['id'] . '">';
            foreach ( $r['submenu'] as $subk => $submenu ) {
                $html .= ' <li id="SubMenu_' . $submenu['id'] . '"><h3><span class="fa fa-chevron-right"></span> ' . $submenu['display_name'] . '</h3><ul class="sub_menu">';
                foreach ( $submenu['submenu'] as $subk_2 => $submenu_2 ) {
                    $routeClass = !empty( explode( '.', $submenu_2['name'] )['0'] ) ? explode( '.', $submenu_2['name'] )['0'] : $submenu_2['name'];

                    $html .= '<li id="curMenu_' . $routeClass . '" uri="' . $submenu_2['name'] . '" second_parent="' . $submenu_2['fid'] . '" top_parent="' . $submenu_2['parent']['id'] . '"><a href="' . route( $submenu_2['name'] ) . '"><i class="fa fa-caret-right">&nbsp;</i>' . $submenu_2['display_name'] . '</a></li>';
                }
                $html .= '</ul></li>';
            }
            $html .= '</ul>';
            $i++;
        }

        return $html;
    }

    //获取当前路由的菜单信息
    public static function getMenuInfo ( $name )
    {
        $menu = [];
        $menu = Permissions::where( [ 'name' => $name ] )->first();

        return $menu;
    }
}