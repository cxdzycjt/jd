<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-11
 * Time: 上午10:52
 */

namespace app\controllers;

use yii;
use yii\base\Controller;

class BrandController extends Controller{

    public $layout='admin';

    public function actionIndex(){
        $view = Yii::$app->view;
        $view->params['layoutData']='添加品牌';
        $view->params['controller']='brand';
        $view->params['action']='edit';
        return $this->render('index');

    }

    public function actionEdit(){
        $app = Yii::$app->request;
        if($app->isPost){
            $info = $app->getBodyParams();

        }else{
            $view = Yii::$app->view;
            $view->params['layoutData']='品牌列表';
            $view->params['controller']='brand';
            $view->params['action']='index';
            return $this->render('edit');
        }
    }
} 