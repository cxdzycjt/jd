<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-11
 * Time: 下午2:53
 */

namespace app\controllers;

use app\models\Supplier;
use yii;
use yii\base\Controller;
use yii\data\Pagination;
class SupplierController extends Controller{

    public $layout='admin';

    public function actionIndex(){
        $view = Yii::$app->view;
        $view->params['layoutData']='添加供应商';
        $view->params['controller']='supplier';
        $view->params['action']='edit';
        $supplierList = Supplier::find();
        $total = Supplier::find()->count();
        $pages = new Pagination(['totalCount'=>$total,'defaultPageSize'=>5]);
        $models = $supplierList->offset($pages->offset)->limit($pages->limit)->all();
        $data = ['supplierList'=>$models,'pages'=>$pages];
        return $this->render('index',$data);
    }

    public function actionEdit(){
        $app = Yii::$app->request;
        $supplierModel = new Supplier();
        $info = $app->getBodyParams();
        if($app->isPost){
            $supplierModel->supplier_name    = $info['supplier_name'];
            $supplierModel->supplier_sort    = $info['supplier_sort'];
            $supplierModel->supplier_status  = $info['supplier_status'];
            $supplierModel->supplier_intro   = $info['supplier_intro'];
            if(!empty($info['supplier_id'])){
                if(Supplier::updateAll($info,'supplier_id=:id',array(':id'=>$info['supplier_id']))){
                    echo 1;
                }else{
                    echo 2;
                }
            }else{
                $supplierModel->createTime       = time();
                if($supplierModel->save()){
                    echo 3;
                }else{
                    echo 4;
                }
            }

        }else{
            $id = $app->get('id');
            $supplierRow = Supplier::find()->where(['supplier_id'=>$id])->one();
            $view = Yii::$app->view;
            $view->params['layoutData']='供应商列表';
            $view->params['controller']='supplier';
            $view->params['action']='index';
            return $this->render('edit',['supplierRow'=>$supplierRow]);
        }
    }
    public function actionDel(){
        $app = Yii::$app->request;
        $id = $app->get('id');
        if(Supplier::findOne($id)->delete()){
            echo 1;
        }else{
            echo 2;
        }
    }
}