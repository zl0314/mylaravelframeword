<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BannersRequest;
use App\Model\Admin\Banners;
use App\Zl\Controllers\Admin\BackController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannersController extends BackController
{
    public $model = Banners::class;
    public $here = '轮播图';
    public $formRequest = BannersRequest::class;
}
