<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload ( Request $request )
    {
        $config = config( 'upload' );
        $fileObj = $request->get( 'act' );
        $data = [
            'code' => 0,
            'msg'  => '上传成功',
        ];

        if ( !empty( $_FILES ) ) {
            //上传路径
            $path = $config['upload_path'];
            $path = str_replace( '{upload}', $fileObj, $path );

            //得到上传的临时文件流
            $tempFile = $_FILES[ $fileObj ]['tmp_name'];

            //得到扩展名
            $extension = pathinfo( $_FILES[ $fileObj ]['name'], PATHINFO_EXTENSION );

            //允许的文件后缀
            $fileTypes = $config['allow_types'];
            if ( !in_array( $extension, $fileTypes ) ) {
                $data = [
                    'code' => 1,
                    'msg'  => '不允许的文件扩展名',
                ];
            }
            //上传文件大小判断
            $size = filesize( $tempFile );
            $allow_size = $config['file_size'];
            if ( $size > ( 1024 * 1024 * $allow_size ) ) {
                $data = [
                    'code' => 2,
                    'msg'  => '文件大小超过限制， 不能超2M',
                ];
            }

            //新的文件名
            $fileName = md5( time() );
            $fileParts = pathinfo( $_FILES[ $fileObj ]['name'] );

            //最后保存服务器地址
            if ( !is_dir( $path ) ) {
                creat_dir_with_filepath( $path . $fileName . '.' . $extension );
            }

            $targetFile = $path . $fileName . '.' . $extension;
            if ( move_uploaded_file( $tempFile, $targetFile ) ) {
                $data['file'] = str_replace( './', '/', $targetFile );
            } else {
                $data = [
                    'code' => 3,
                    'msg'  => '文件上传失败',
                ];
            }

            return json_encode( $data );
        }
    }
}