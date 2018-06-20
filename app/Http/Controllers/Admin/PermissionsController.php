<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PermissionsRequest;
use App\Model\Permissions;
use App\Zl\Controllers\Admin\BackController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionsController extends BackController
{
    public $here = '权限';
    public $model = Permissions::class;
    public $formRequest = PermissionsRequest::class;

    public function getData ()
    {
        $post = $this->getRequest()->post();
        if ( empty( $post['name'] ) ) {
            $post['name'] = '#' . time() . rand( 100, 999 );
        }
        if ( empty( $post['sort'] ) ) {
            $post['sort'] = 1;
        }

        return $post;
    }

    public function saveCallback ( $model )
    {
        if ( !empty( $model->init_curd ) && $model->is_menu == 1 ) {
            $permission_arr = explode( '.', $model->name );
            $classs = !empty( $permission_arr[0] ) ? $permission_arr[0] : '';
            if ( !empty( $classs ) ) {
                $arr = [
                    $classs . '.create'        => '新增表单页面',
                    $classs . '.store'         => '设置保存',
                    $classs . '.edit'          => '编辑页面',
                    $classs . '.update'        => '编辑保存',
                    $classs . '.destroy'       => '删除',
                    $classs . '.batch_destroy' => '批量删除',
                ];
            }
            foreach ( $arr as $k => $r ) {
                $saveData = [
                    'name'         => $k,
                    'display_name' => $r,
                    'fid'          => $model->id,
                    'is_menu'      => 0,
                    'sort'         => 0,
                    'init_curd'    => 0,
                ];
                Permissions::updateOrcreate( [ 'name' => $k, 'fid' => $model->id ], $saveData );
            }
        }
    }

    public function getSubMenus ()
    {
        $id = request()->get( 'id' );
        $id = intval( $id );
        $level = request()->get( 'level' ) ? request()->get( 'level' ) + 1 : 1;

        $subMenus = Permissions::where( [ 'fid' => $id ] )->get()->toArray();

        $html = '';
        if ( !empty( $subMenus ) ) {
            foreach ( $subMenus as $k => $r ) {

                $hasSubMenus = $r['is_menu'] == 1 ? '<span class="fa fa-chevron-right" style="cursor: pointer;" title="查看子菜单"
                                  onclick="getSubmenus(\'' . $r['id'] . '\')">&nbsp;</span>' : '';
                $isMenuTag = $r['is_menu'] == 1 ? '<span class="label label-danger">是</span>' : '<span class="label label-default">否</span>';

                $html .= '<tr class="submenu_' . $id . '" id="item_' . $r['id'] . '" loaded="0" level="' . $level . '">';
                $html .= '<td><input type="checkbox" name="id[]" value="' . $r['id'] . '"></td>';
                $html .= '<td>' . $hasSubMenus . '</td>';
                $html .= '<td>' . str_repeat( '&nbsp;&nbsp;', $level * 2 ) . '|--&nbsp;' . $r['display_name'] . '</td>';
                $html .= '<td>' . $r['description'] . '</td>';
                $html .= '<td>' . $isMenuTag . '</td>';
                $html .= '<td>' . $r['created_at'] . '</td>';
                $html .= '<td>
                            <div class="btn-group">
                                <a class="btn btn-default"
                                   href="' . url( '/admin/' . $this->siteClass . '/' . $r['id'] . '/edit' ) . '"><span class="fa fa-edit"> 编辑</span></a>
                                <a class="btn btn-default" href="javascript:;"
                                   onclick="del(\'' . $r['id'] . '\')"><span class="fa fa-remove"> 删除</span> </a>
                            </div>
                        </td>';
                $html .= '</tr>';
            }
        }

        return $html;
    }
}
