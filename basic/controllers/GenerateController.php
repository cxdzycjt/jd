<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-13
 * Time: 上午10:31
 */

namespace app\controllers;
use Method;
use yii;
use yii\console\Controller;

class GenerateController extends Controller{

    public $layout='admin';

    public function actionIndex(){
        $app = Yii::$app->request;
        if($app->isPost){
            //>>1.接收表名和模块名称
            $table_name   = $app->post('table_name');
            $module_name  =  $app->post('module_name');
            //>>2.通过表名生成当前功能的名称
            $tableName = $this->table2name($table_name);
            var_dump($tableName);

        }else{
            $view = Yii::$app->view;
            $view->params['layoutData']='代码生成';
            $view->params['controller']='generate';
            $view->params['action']='index';
            return $this->render('index');
        }
    }

    private function table2name($table_name){
        $table = Method::str2arr($table_name,'_');
        $arr = '';
        if($table[0]=='jd'){
            unset($table[0]);
            $arr = array_map('ucfirst',$table);
        }
        return Method::arr2str($arr,'');
    }
} 