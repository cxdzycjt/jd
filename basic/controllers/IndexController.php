<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-9
 * Time: 上午11:24
 */

namespace app\controllers;

use yii;
use yii\base\Controller;

class IndexController extends Controller{

    public function actionIndex(){
        $cookies  = Yii::$app->request->cookies;//注意此处是request
        $username = $cookies->get('username');//设置默认值
        $user_id  = $cookies->get('user_id');//设置默认值
        $username = isset($username->value)?$username->value:'';
        $user_id  = isset($user_id->value)?$user_id->value:'';
       return  $this->renderPartial('index',['username'=>$username]);
    }

    public function actionTop(){
       return  $this->renderPartial('top');
    }

    public function actionMain(){
       return  $this->renderPartial('main');
    }

    public function actionMenu(){
       return  $this->renderPartial('menu');
    }
} 