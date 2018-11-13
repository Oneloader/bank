<?php
namespace app\bank\controller;

use think\Controller;
class Error extends Controller {
    public function index(){
        forbidden();
    }
}