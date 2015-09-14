<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-14
 * Time: 上午10:44
 */

namespace app\controllers;


use Method;
use yii;
use yii\base\Controller;
use yii\data\Pagination;
class BaseController extends Controller{

    public $layout='admin';


    public function actionIndex(){
        $model_class   =    $this->model_class;

        $app           =     Yii::$app->request;

        $name          =    $app->get('name');
        $sql           =    "name like '%$name%' and status>0";
        $data          =    $model_class::find()->andWhere($sql)->orderBy('createTime desc');

        $total         =    $data->count();
        $pages         =     new Pagination(['totalCount'=>$total]);
        $models        =    $data->offset($pages->offset)->limit($pages->limit)->all();

        $view = Yii::$app->view;
        $view->params['layoutData'] = '添加供应商';
        $view->params['controller'] = $this->location_url;
        $view->params['action']      = 'edit';

        $data = array(
            'models' => $models,
            'total'         => $total,
            'pages'         => $pages,
            'name'          => isset($name)?$name:'',
        );

        return $this->render('index',$data);
    }

    public function actionEdit(){
        $model_class   =    $this->model_class;
        $app           =    Yii::$app->request;
        $supplierModel =    new $model_class();
        $info          =    $app->bodyParams;
        if($app->isPost){
            $info['createTime']   = time();
            $supplierModel->setAttributes($info);
            if(!empty($info['id'])){
                if($model_class::updateAll($info,'id=:id',array(':id'=>$info['id']))){
                    Method::exit_json(1,'操作成功','/'.$this->location_url.'/index');
                }else{
                    Method::exit_json(0,'操作失败');
                }
            }else{
                if($supplierModel->save()){
                    Method::exit_json(1,'操作成功','/'.$this->location_url.'/index');
                }else{
                    Method::exit_json(0,'操作失败');
                }
            }

        }else{
            $id          = $app->get('id');
            $commonData  = $model_class::find()->where(['id'=>$id])->one();
            $view        = Yii::$app->view;
            $view->params['layoutData'] = '供应商列表';
            $view->params['controller'] = $this->location_url;
            $view->params['action']     = 'index';
            return $this->render('edit',['commonData'=>$commonData]);
        }
    }
    public function actionDel(){
        $model_class   =    $this->model_class;
        $app           =    Yii::$app->request;
        if($app->isPost){
            $id = $app->post('id');
        }else{
            $id = $app->get('id');
        }
        $info['status'] = 0;
        if(is_array($id)){
            foreach($id as $k=>$v){
                $result = $model_class::updateAll($info,'id=:id',array(':id'=>$v));
            }
        }else{
            $result = $model_class::updateAll($info,'id=:id',array(':id'=>$id));
        }
        if($result){
            Method::exit_json(1,'操作成功','/'.$this->location_url.'/index');
        }else{
            Method::exit_json(0,'操作失败');
        }
    }
    public function actionStatus(){
        $model_class   =    $this->model_class;
        $app           =     Yii::$app->request;
        $id            =    $app->get('id');
        $status        =    $app->get('status');
        if($status==1){
            $data['status'] = 2;
        }else{
            $data['status'] = 1;
        }
        if($model_class::updateAll($data,'id=:id',array(':id'=>$id))){
            Method::exit_json(1,'操作成功','/'.$this->location_url.'/index');
        }else{
            Method::exit_json(0,'操作失败');
        }
    }
    public function actionRemove(){
        $model_class   =    $this->model_class;
        $app           =     Yii::$app->request;
        $id            =    $app->get('id');
        if($model_class::findOne($id)->delete()){
            echo 1;
        }else{
            echo 2;
        }
    }

} 