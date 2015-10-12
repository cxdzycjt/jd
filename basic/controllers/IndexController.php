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
       $session = Yii::$app->session;
       $permissions = $session->get('permissions');
       $arrper = array();
       foreach($permissions as $permission){
          if($permission['level']<4 && $permission['level']>1){
              $arrper[] = $permission;
          }
       }
       $maxArr = array();
       $minArr = array();
       foreach($arrper as $per){
          if($per['level']==2){
              $maxArr[] = $per;
          }else{
              $minArr[] = $per;
          }
       }
       return  $this->renderPartial('menu',['maxArr'=>$maxArr,'minArr'=>$minArr]);
    }
} 