<?php
/**
 * Created by Aaron Zhang.
 * Date: 2018/5/2 15:42
 * FileName : UploadController.php
 */

namespace Jq\BatchUpload;


use Illuminate\Http\Request;

class UploadController
{
    public function upload ( Request $request )
    {
        if ( preg_match( '/^(data:\s*image\/(\w+);base64,)/', $request->src, $result ) ) {
            $type = $result[2];

            $t = time();
            $d = explode( '-', date( "Y-y-m-d-H-i-s" ) );
            $format = config( 'jq-batch-upload.uploadPath' );
            $format = str_replace( "{yyyy}", $d[0], $format );
            $format = str_replace( "{yy}", $d[1], $format );
            $format = str_replace( "{mm}", $d[2], $format );
            $format = str_replace( "{dd}", $d[3], $format );
            $format = str_replace( "{hh}", $d[4], $format );
            $format = str_replace( "{ii}", $d[5], $format );
            $format = str_replace( "{ss}", $d[6], $format );
            $format = str_replace( "{time}", $t, $format );
            $format = str_replace( "{date}", date( 'YmdHis' ), $format );

            //替换随机字符串
            $randNum = '';
            if ( preg_match( "/\{rand\:([\d]*)\}/i", $format, $matches ) ) {
                for ( $i = 0; $i < $matches[1]; $i++ ) {
                    $randNum .= rand( 0, 9 );
                }
                $format = preg_replace( "/\{rand\:[\d]*\}/i", $randNum, $format );
            }

            $new_file = $format . config( 'jq-batch-upload.fileName' ) . ".{$type}";
            creat_dir_with_filepath( public_path() . $new_file );
            if ( file_put_contents( public_path() . $new_file, base64_decode( str_replace( $result[1], '', $request->src ) ) ) ) {
                $data = [
                    'success' => 1,
                    'src' => $new_file,
                    'message' => '上传成功'
                ];
                return response()->json($data);
            } else {
                $data = [
                    'success' => 0,
                    'src' => '',
                    'message' => '上传失败'
                ];
                return response()->json($data);
            }
        }
    }

    public function delete ( Request $request )
    {
        if ( $request->src ) {
            $file = public_path() . $request->src;
            @unlink( $file );
        }
    }

}