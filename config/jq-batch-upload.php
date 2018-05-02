<?php
return [
    'uploadPath' => '/uploads/{yyyy}/{mm}/{dd}/{rand:6}/',
    'fileName'   => md5( time() ),
];