<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-11
 * Time: 上午11:09
 */

namespace app\controllers;

use Yii;
use yii\base\Controller;

class CategoryController extends Controller{

    public $layout='admin';

    public function actionIndex(){
        $view = Yii::$app->view;
        $view->params['layoutData']='添加分类';
        $view->params['controller']='category';
        $view->params['action']='edit';
        return $this->render('index');
    }

    public function actionEdit(){
        $app = Yii::$app->request;
        if($app->isPost){

        }else{
            $view = Yii::$app->view;
            $view->params['layoutData']='商品分类';
            $view->params['controller']='category';
            $view->params['action']='index';
            return $this->render('edit');
        }
    }
} 