<?php
/**
 * Created by Aaron Zhang.
 * Date: 2018/4/19 15:50
 * FileName : IndexController.php
 */

namespace App\Http\Controllers;


use App\Model\AdminUsers;
use App\Zl\Controllers\FrontController;

class IndexController extends FrontController
{

    public function index ()
    {


        return $this->display();
    }
}