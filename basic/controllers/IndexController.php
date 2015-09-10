<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-9
 * Time: 上午11:24
 */

namespace app\controllers;


use yii\base\Controller;

class IndexController extends Controller{

    public function actionIndex(){
       return  $this->renderPartial('index');
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