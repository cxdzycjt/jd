<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-10
 * Time: 上午11:01
 */

namespace app\controllers;

use yii;
use yii\base\Controller;

class GoodsController extends Controller{

    public $layout='admin';

    public function actionIndex(){
        $view = Yii::$app->view;
        $view->params['layoutData']='添加商品';
        $view->params['controller']='goods';
        $view->params['action']='edit';
      return $this->render('index');
    }

    public function actionEdit(){
        $app = Yii::$app->request;
        if($app->isPost){

        }else{
            $view = Yii::$app->view;
            $view->params['layoutData']='商品列表';
            $view->params['controller']='goods';
            $view->params['action']='index';
            return $this->render('edit');
        }
    }

    public function actionDel(){

    }
} 