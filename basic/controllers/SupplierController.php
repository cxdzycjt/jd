<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-11
 * Time: 下午2:53
 */

namespace app\controllers;


use yii\base\Controller;

class SupplierController extends Controller{

    public function actionIndex(){
        return $this->render('index');
    }
    public function actionEdit(){
        return $this->render('edit');
    }
} 