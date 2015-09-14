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
use Method;
use yii\base\Controller;
use yii\data\Pagination;
class SupplierController extends Controller{

    public $layout='admin';

    public function actionIndex(){
        $app = Yii::$app->request;

        $name = $app->get('name');
        $sql           = "name like '%$name%' and status>0";
        $data          = Supplier::find()->andWhere($sql)->orderBy('createTime desc');

        $total  = $data->count();
        $pages  = new Pagination(['totalCount'=>$total]);
        $models = $data->offset($pages->offset)->limit($pages->limit)->all();

        $view = Yii::$app->view;
        $view->params['layoutData'] = '添加供应商';
        $view->params['controller'] = 'supplier';
        $view->params['action']     = 'edit';

        $data = array(
            'supplierList'=>$models,
            'total'=>$total,
            'pages'=>$pages,
            'name'=>isset($name)?$name:'',
        );

        return $this->render('index',$data);
    }

    public function actionEdit(){
        $app = Yii::$app->request;
        $supplierModel = new Supplier();
        $info = $app->getBodyParams();

        if($app->isPost){
            $supplierModel->name    = $info['name'];
            $supplierModel->sort    = $info['sort'];
            $supplierModel->status  = $info['status'];
            $supplierModel->intro   = $info['intro'];
            if(!empty($info['id'])){
                if(Supplier::updateAll($info,'id=:id',array(':id'=>$info['id']))){
                    Method::exit_json(1,'操作成功','/supplier/index');
                }else{
                    Method::exit_json(0,'操作失败');
                }
            }else{
                $supplierModel->createTime       = time();
                if($supplierModel->save()){
                    Method::exit_json(1,'操作成功','/supplier/index');
                }else{
                    Method::exit_json(0,'操作失败');
                }
            }

        }else{
            $id          = $app->get('id');
            $supplierRow = Supplier::find()->where(['id'=>$id])->one();
            $view        = Yii::$app->view;
            $view->params['layoutData'] = '供应商列表';
            $view->params['controller'] = 'supplier';
            $view->params['action']     = 'index';
            return $this->render('edit',['supplierRow'=>$supplierRow]);
        }
    }
    public function actionDel(){
        $app = Yii::$app->request;
        $id = $app->get('id');
        $info['status'] = 0;
        if(Supplier::updateAll($info,'id=:id',array(':id'=>$id))){
            Method::exit_json(1,'操作成功','/supplier/index');
        }else{
            Method::exit_json(0,'操作失败');
        }
    }
    public function actionStatus(){
        $app    = Yii::$app->request;
        $id     = $app->get('id');
        $status = $app->get('status');
        if($status==1){
            $data['status'] = 2;
        }else{
            $data['status'] = 1;
        }
        if(Supplier::updateAll($data,'id=:id',array(':id'=>$id))){
            Method::exit_json(1,'操作成功','/supplier/index');
        }else{
            Method::exit_json(0,'操作失败');
        }
    }
    public function actionRemove(){
        $app = Yii::$app->request;
        $id  = $app->get('id');
        if(Supplier::findOne($id)->delete()){
            echo 1;
        }else{
            echo 2;
        }
    }
}
