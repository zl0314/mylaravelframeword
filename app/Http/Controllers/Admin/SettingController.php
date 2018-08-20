<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SettingRequest;
use App\Model\Admin\Setting;
use App\Zl\Controllers\Admin\BackController;
use Illuminate\Http\Request;

class SettingController extends BackController
{
    public $model = Setting::class;
    public $here = '设置';
    public $formRequest = SettingRequest::class;
}
