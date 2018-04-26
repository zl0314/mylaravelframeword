<?php

namespace App\Zl\Controllers\Admin;

use App\Model\Channels;
use App\Zl\Controllers\CommonController;
use Mockery\Exception;
use Illuminate\Http\Request;

class BackController extends CommonController
{
    //当前位置
    public $here = '系统信息';
    //模型
    public $model = null;

    //表单验证模型
    public $formRequest = null;

    //参数， 如：project_id=1
    public $params = null;

    public function __construct ()
    {
        parent::__construct();

        $path = request()->path();
        $pathArr = explode( '/', $path );

        //站点控制器
        $siteClass = !empty( $pathArr[1] ) ? $pathArr[1] : 'index';
        //ID参数
        $id = ( !empty( $pathArr[2] ) && is_numeric( $pathArr[2] ) ) ? $pathArr[1] : '';
        //站点方法
        $siteMethod = !empty( $id ) ? ( !empty( $pathArr[3] ) ? $pathArr[3] : '' )
            : ( !empty( $pathArr[2] ) ? $pathArr[2] : 'index' );

        $this->siteMethod = $siteMethod;
        $this->siteClass = $siteClass;
        $this->id = $id;
        $this->isManager = true;

        $vars = [
            'siteMethod' => $siteMethod,
            'siteClass'  => $siteClass,
            'here'       => $this->here,
        ];
        $this->assign( $vars );
    }

    /**
     * 保存或更新成功后， 执行回调函数
     *
     * @param $model
     */
    public function saveCallback ( $model )
    {

    }


    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index ()
    {
        $data = $this->model::getWhere( $this->getModel() )
            ->orderBy( 'id', 'desc' )->paginate( 10 );

        return $this->display( [ 'data' => $data ] );
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create ()
    {
        return $this->display();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store ()
    {
        //手动创建验证规则
        $this->makeMyValidate();

        $data = $this->getData();

        $result = $this->getModel()->create( $data );

        if ( !$result ) {
            flash()->error( '添加失败' );

            return redirect( url( 'admin/' . $this->siteClass . $this->params ) );
        } else {
            //保存成功后， 调取回调函数
            $this->saveCallback( $result );

            //检查是否有缓存  清空 操作
            $this->deleteCache();
            flash()->success( '添加成功' );

            return redirect( url( 'admin/' . $this->siteClass . $this->params ) );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit ( $id )
    {
        $model = $this->getModel()::findOrfail( $id );

        return $this->display( [
            'model' => $model,
        ] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update ( $id )
    {
        $model = $this->getModel()::findOrfail( $id );
        //手动创建验证规则
        $this->makeMyValidate( $model );

        $data = $this->getData();
        $model->update( $data );

        //更新成功后， 调取回调函数
        $this->saveCallback( $model );

        //检查是否有缓存  清空 操作
        $this->deleteCache();
        flash()->success( '修改成功' );

        return redirect( url( '/admin/' . $this->siteClass . $this->params ) );
    }

    /**
     * 插入之前， 可以对数据 进行更改
     * @return array
     */
    public function getData ()
    {
        $data = $this->getRequest()->post();

        return $data;
    }

    /**
     * 删除前的检查
     */
    public function checkDelete ( $id )
    {
        return true;
    }

    public function makeMyValidate ( $model = null )
    {
        return true;
    }

    /**
     * 获取模型实例
     * @return \Illuminate\Foundation\Application|mixed
     */
    protected function getModel ()
    {
        return app( $this->model );
    }

    /**
     * 获取表单验证实例
     * @return \Illuminate\Foundation\Application|mixed
     */
    protected function getRequest ()
    {
        return $this->formRequest ? app( $this->formRequest ) : app( Request::class );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy ( $id )
    {
        //删除前的检查
        $canDelete = $this->checkDelete( $id );
        if ( $canDelete ) {
            $result = $this->getModel()::findOrfail( $id );

            //删除后，执行回调函数
            $this->deleteCallback( $result );

            $this->getModel()->destroy( $id );
            //检查是否有缓存  清空 操作
            $this->deleteCache();

            //return response()->json( [ 'message' => '删除成功' ] );
            return \Ajax::success( '删除成功' );
        } else {
            return \Ajax::success( '您不能这样做' );
        }

    }

    /**
     * 删除后，执行回调函数
     */
    public function deleteCallback ( $model )
    {
    }

    /**
     * 检查是否有缓存插入 清空 操作
     */
    protected function deleteCache ()
    {
        return true;
    }

    /**
     * 获取模板的路径和模板文件
     *
     * @param $template
     *
     * @return array
     */
    protected function getTemplate ( $template )
    {
        $template = $template ? $template : 'admin.' . $this->siteClass . '.' . $this->siteMethod;
        $template_file = resource_path() . '/views/' . str_replace( '.', '/', $template ) . '.blade.php';

        return [
            'template_path' => $template,
            'template_file' => $template_file,
        ];
    }

    protected function getDefaultContent ()
    {
        $content = '';
        if ( $this->siteMethod == 'index' ) {
            $content = $this->getIndexDefaultContent();
        } else if ( $this->siteMethod == 'create' || $this->siteMethod == 'edit' ) {
            $content = $this->getCreateDefaultContent();
        }
        //给内容加上master  section
        $returnContent = '@extends(\'layouts.admin.master\')'
            . "\r\n" . '@section(\'content\')'
            . "\r\n" . $content . "\r\n"
            . '@endsection';

        return $returnContent;
    }

    /**
     * 获取添加/修改页面默认内容
     * @return string 返回添加/修改页面的默认内容
     */
    protected function getCreateDefaultContent ()
    {
        //创建form.blade.php
        $form_blade_file = resource_path() . '/views/admin/' . $this->siteClass . '/form' . '.blade.php';
        if ( !file_exists( $form_blade_file ) ) {

            $form_html = '<div class="panel-body">
                <form action="/admin/{{$siteClass}}{{!empty($model->id)?\'/\'.$model->id:\'\'}}" method="post">
                {{csrf_field()}}' . "\r\n\r\n";
            $form_html .= '@if($siteMethod == \'edit\') {{method_field(\'PUT\')}} @endif' . "\r\n";
            $form_html .= '<div class="form-group">
                    <label for="">标题</label>
                    <input type="text" class="form-control" value="{{$model->title??old(\'title\')}}" name="title">
                </div>';
            $form_html .= '<button type="submit" class="btn btn-primary"><span class="fa fa-save">{{!empty($model->id) ? \'修 改\' :\'保 存\'}} </span></button>';
            $form_html .= "\r\n" . '</form>' . "\r\n";
            $form_html .= '</div></div>';

            file_put_contents( $form_blade_file, $form_html );
        }

        $html = '@include(\'admin.\'.$siteClass.\'.form\')';

        return $html;
    }

    /**
     * 获取列表页面默认的内容
     * @return string 默认内容
     */
    protected function getIndexDefaultContent ()
    {
        $html = '<div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                        <th><input onclick="selallck(this)" type="checkbox" id="selectBtn" style="cursor:pointer;"></th>
                            <th>名称</th>
                            <th>添加时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!$data->isEmpty())
                            @foreach($data as $item)
                                <tr id="item_{{$item->id}}">
                                <td><input type="checkbox" name="id[]" value="{{$item->id}}"></td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-default"
                                               href="{{url(\'/admin/\'.$siteClass.\'/\'.$item->id.\'/edit\')}}"><span class="fa fa-edit"> 编辑</span></a>
                                            <a class="btn btn-default" href="javascript:;"
                                               onclick="del(\'{{$item->id}}\')"><span class="fa fa-remove"> 删除</span> </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="20">暂时没有任何数据。。</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                   
                </div>
            </div>
            <div style="padding:0 5px; height:70px; border-radius: 5px;" class="">
             @if(!$data->isEmpty())
             <div class="btn btn-primary" style="float:left;width:100px;margin-top:15px;" onclick="del_batch()"><span class="fa fa-trash-o "> 批量删除</span></div>
            @endif
        <ul class="pagination" style="float:right; margin-top:0px;">
            {!! $data->links() !!}
        </ul>
    </div>
            ';

        return $html;
    }
}
