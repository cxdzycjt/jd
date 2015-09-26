<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-26
 * Time: 下午8:57
 */

namespace app\controllers;

use yii\base\Controller;
use Yii;
class ProductController extends Controller{

    public function actionIndex(){
        $app  =  Yii::$app->request;
        if($app->isPost){

        }else{
            return $this->render('index');
        }

    }
}
/*
  *
  *   $name          =    $app->get('name');
        $goodsType_id          =    $app->get('goodsType_id');
        $sql           =    'status>0';
        if(!empty($name)){
            $sql       .=    " AND name like '%$name%'";
        }elseif(!empty($goodsType_id)){
            $sql       .=    " AND type = $goodsType_id";
        }
        $data          =    $model_class::find()->andWhere($sql)->orderBy('createTime desc');

        $total         =    $data->count();
        $pages         =     new Pagination(['totalCount'=>$total]);
        $models        =    $data->offset($pages->offset)->limit($pages->limit)->all();

        $view = Yii::$app->view;
        $view->params['layoutData'] = '添加'.$this->title;
        $view->params['controller'] = $this->location_url;
        $view->params['action']     = 'edit';
        $data                       =  $this->edit_view_before();
        $data = array(
            'models'  => $models,
            'total'   => $total,
            'pages'   => $pages,
            'name'    => isset($name)?$name:'',
            'goodsType_id'    => isset($goodsType_id)?$goodsType_id:'',
            'supplier'=> isset($data['supplier'])?$data['supplier']:'',
            'brand'   => isset($data['brand'])?$data['brand']:'',
            'category'=> isset($data['tree'])?$data['tree']:'',
            'goodsType' =>isset($data['goodsType'])?$data['goodsType']:'',
        );
        return $this->render('index',$data);
  */