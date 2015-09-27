<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-11
 * Time: 下午3:28
 */

namespace app\controllers;


use yii\base\Controller;

class LoginController extends Controller{

    public function actionLogin(){
        return $this->renderPartial('login');
    }

}