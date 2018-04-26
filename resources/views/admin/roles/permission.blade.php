@extends('layouts.admin.master')
@section('content')

    <form action="/admin/roles/permission/{{$role->id}}" method="post">
        {{csrf_field()}}
        @foreach(\App\Model\Permissions::treePermisstionsBySubMenus() as $k=>$r)
            <div class="panel panel-primary" id="top_menu{{$r['id']}}">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <div class="checkbox">
                            <label for="menu{{$r['id']}}">
                                <input
                                        @if(!empty($role->id) && in_array($r['id'], array_column($role->permissions()->get()->toArray(), 'id') )  ) checked
                                        @endif
                                        onclick="checkPermission(this)" type="checkbox" id="menu{{$r['id']}}"
                                       name="permission[{{$r['id']}}]" value="{{$r['id']}}"
                                       style="width:20px;height:20px;margin-top:0px;">
                                【{{$r['display_name']}}】权限
                            </label>
                        </div>
                    </h3>
                </div>
                <div class="panel-body" id="top_menu{{$r['id']}}_child">
                    @if(!empty($r['submenu'] ))
                        @foreach($r['submenu'] as $submenu)
                            <div class="panel panel-default" id="top_menu{{$submenu['id']}}">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <div class="checkbox">
                                            <label for="menu{{$submenu['id']}}">
                                                <input parent="{{$submenu['parent']['id']}}"
                                                       @if(!empty($role->id) && in_array($submenu['id'], array_column($role->permissions()->get()->toArray(), 'id') )  ) checked
                                                       @endif
                                                       onclick="checkPermission(this)"
                                                       type="checkbox"
                                                       id="menu{{$submenu['id']}}"
                                                       name="permission[{{$submenu['id']}}]" value="{{$submenu['id']}}"
                                                       style="width:20px;height:20px;margin-top:0px;">
                                                【{{$submenu['display_name']}}】权限
                                            </label>
                                        </div>
                                    </h3>
                                </div>
                                <div class="panel-body" id="top_menu{{$submenu['id']}}_child">
                                    <table class="table">
                                        @if(!empty($submenu['submenu'] ))
                                            @foreach($submenu['submenu'] as $submenu_2)
                                                <tr id="top_menu{{$submenu_2['id']}}">
                                                    <td style="width:190px;">
                                                        <div class="checkbox">
                                                            <label for="menu{{$submenu_2['id']}}">

                                                                <input parent="{{$submenu_2['second_parent'] or ''}}"
                                                                       onclick="checkPermission(this)" type="checkbox"
                                                                       @if(!empty($role->id) && in_array($submenu_2['id'], array_column($role->permissions()->get()->toArray(), 'id') )  ) checked
                                                                       @endif
                                                                       name="permission[{{$submenu_2['id']}}]"
                                                                       id="menu{{$submenu_2['id']}}"
                                                                       value="{{$submenu_2['id']}}">

                                                                {{$submenu_2['display_name']}}
                                                            </label>
                                                        </div>

                                                    </td>

                                                    <td>
                                                        <div class="checkbox">
                                                            @foreach(\App\Model\Permissions::where(['fid' => $submenu_2['id']])->get() as $submenu_3)
                                                                <label for="menu{{$submenu_3->id}}">
                                                                    <input parent="{{$submenu_3->fid}}"
                                                                           @if(!empty($role->id) && in_array($submenu_3->id, array_column($role->permissions()->get()->toArray(), 'id') )  ) checked
                                                                           @endif
                                                                           onclick="selectParent(this)" type="checkbox"
                                                                           id="menu{{$submenu_3->id}}"
                                                                           name="permission[{{$submenu_3->id}}]"
                                                                           value="{{$submenu_3->id}}"> {{$submenu_3->display_name}}
                                                                </label>
                                                            @endforeach
                                                        </div>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

        @endforeach
        <input type="submit" value="保 存" class="btn btn-primary btn-lg">
    </form>
    <script>
        function checkPermission(o) {
            var parent = $(o).attr('parent');
            var cl = 0;


            if ($(o).prop('checked')) {
                $('#top_menu' + $(o).val()).find('input[type="checkbox"]').prop('checked', true);
            } else {
                $('#top_menu' + $(o).val()).find('input[type="checkbox"]').prop('checked', false);
            }

            $('#top_menu' + parent + '_child').find('input[type="checkbox"]').each(function () {
                if ($(this).prop('checked')) {
                    cl++
                }
            });
            console.log(cl);
            if (cl >= 1) {
                selecttop(true, parent);
            } else {
                selecttop(false, parent);
            }
        }

        function selectParent(o) {
            var cl = 0;
            $(o).parent().parent().find('input[type="checkbox"]').each(function () {
                if ($(this).prop('checked')) {
                    cl++
                }
            });
            var parent = $(o).attr('parent');
            if (cl >= 1) {
                selecttop(true, parent);
            } else {
                selecttop(false, parent);
            }
        }

        function selecttop(isc, parent) {
            $('#menu' + parent).prop('checked', isc);

            //父级的上级选中
            var p_2 = $('#menu' + parent).attr('parent');
            $('#menu' + p_2).prop('checked', isc);
            //父级的上级 的上级选中
            var p_1 = $('#menu' + p_2).attr('parent');
            $('#menu' + p_1).prop('checked', isc);
        }
    </script>
@endsection
