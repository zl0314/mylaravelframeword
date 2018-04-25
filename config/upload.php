<?php
/**   上传文件配置
 * Created by Aaron Zhang.
 * Date: 2017/12/14 21:20
 * FileName : upload.php
 */
return [
    'allow_types' => [ 'jpg', 'png', 'gif','jpeg' ],
    'file_size'   => '2', //上传文件大小,  以M为单位
    'upload_path' =>'./uploads/{upload}/' . date( 'Y/m/d/' . rand( 1000, 9999 ) ) . '/', //上传的路径，{upload}为上传的控制器，如： news, admin_headimg, banner
];