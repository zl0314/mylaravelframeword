<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NewsRequest;
use App\Model\Admin\News;
use App\Zl\Controllers\Admin\BackController;
use Illuminate\Http\Request;

class NewsController extends BackController
{
    public $here = '新闻';
    public $model = News::class;
    public $formRequest = NewsRequest::class;
}
