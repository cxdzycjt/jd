<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-11
 * Time: 上午10:52
 */

namespace app\controllers;

use app\models\Brand;
use Method;
use yii;
use yii\base\Controller;
use yii\data\Pagination;
class BrandController extends Controller{

    public $layout='admin';

    public function actionIndex(){
        $app = Yii::$app->request;

        $name = $app->get('name');
        $sql           = "name like '%$name%' and status>0";
        $data          = Brand::find()->andWhere($sql)->orderBy('createTime desc');

        $total  = $data->count();
        $pages  = new Pagination(['totalCount'=>$total]);
        $models = $data->offset($pages->offset)->limit($pages->limit)->all();

        $view = Yii::$app->view;
        $view->params['layoutData']='添加品牌';
        $view->params['controller']='brand';
        $view->params['action']='edit';

        $data = array(
            'brandList'=>$models,
            'total'=>$total,
            'pages'=>$pages,
            'name'=>isset($name)?$name:'',
        );

        return $this->render('index',$data);

    }
    public function actionEdit(){
        $app = Yii::$app->request;
        $BrandModel = new Brand();
        $info = $app->getBodyParams();

        if($app->isPost){
            $BrandModel->name    = $info['name'];
            $BrandModel->sort    = $info['sort'];
            $BrandModel->status  = $info['status'];
            $BrandModel->logo  = $info['logo'];
            $BrandModel->intro   = $info['intro'];
            if(!empty($info['id'])){
                if(Brand::updateAll($info,'id=:id',array(':id'=>$info['id']))){
                    Method::exit_json(1,'操作成功','/brand/index');
                }else{
                    Method::exit_json(0,'操作失败');
                }
            }else{
                $BrandModel->createTime       = time();
                if($BrandModel->save()){
                    Method::exit_json(1,'操作成功','/brand/index');
                }else{
                    Method::exit_json(0,'操作失败');
                }
            }

        }else{
            $id          = $app->get('id');
            $BrandRow = Brand::find()->where(['id'=>$id])->one();
            $view        = Yii::$app->view;
            $view->params['layoutData'] = '供应商列表';
            $view->params['controller'] = 'brand';
            $view->params['action']     = 'index';
            return $this->render('edit',['BrandRow'=>$BrandRow]);
        }
    }
    public function actionDel(){
        $app = Yii::$app->request;
        $id = $app->get('id');
        $info['status'] = 0;
        if(Brand::updateAll($info,'id=:id',array(':id'=>$id))){
            Method::exit_json(1,'操作成功','/brand/index');
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
        if(Brand::updateAll($data,'id=:id',array(':id'=>$id))){
            Method::exit_json(1,'操作成功','/brand/index');
        }else{
            Method::exit_json(0,'操作失败');
        }
    }
    public function actionRemove(){
        $app = Yii::$app->request;
        $id  = $app->get('id');
        if(Brand::findOne($id)->delete()){
            echo 1;
        }else{
            echo 2;
        }
    }

} 