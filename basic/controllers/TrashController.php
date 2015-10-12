<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-23
 * Time: 上午10:47
 */

namespace app\controllers;
use app\models\Goods;
use Yii;
use Method;
use yii\data\Pagination;

class TrashController extends GoodsController{
    protected $model_class  = 'app\models\Trash';
    protected $location_url = "trash";
    protected $title        = '商品';

    public function actionIndex(){
        $app     =     Yii::$app->request;
        $name    =    $app->get('name');
        $category_id    =    $app->get('category_id');
        $brand_id    =    $app->get('brand_id');
        $is_on_sale    =    $app->get('is_on_sale');
        $where   =  'where gos.status<1' ;
        if(!empty($name)){
            $where .= " AND gos.name like '%$name%' ";
        }
        if(!empty($category_id)){
            $where .= " AND gos.category_id = $category_id ";
        }
        if(!empty($brand_id)){
            $where .= " AND gos.brand_id = $brand_id ";
        }

        if(!empty($is_on_sale) || is_numeric($is_on_sale)){
            $where .= " AND gos.is_on_sale = $is_on_sale ";
        }
        $data    =    Goods::find();
        $total   =    $data->count();
        $pages   =    new Pagination(['totalCount'=>$total]);
        $models  =    Goods::getGoodsList($pages->offset,$pages->limit,$where);
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
            'category_id' =>isset($category_id)?$category_id:'',
            'brand_id'  =>isset($brand_id)?$brand_id:'',
            'is_on_sale' =>isset($is_on_sale)?$is_on_sale:'',
            'supplier'=> $data['supplier'],
            'brand'   => $data['brand'],
            'category'=> $data['tree'],
        );
        return $this->render('index',$data);
    }

    public function actionRestore(){
        $app = Yii::$app->request;
        $id = $app->get('id');
        if(Goods::updateAll(['status'=>1],'id=:id',array(':id'=>$id))){
            Method::exit_json(1,'操作成功','/'.$this->location_url.'/index');
        }else{
            Method::exit_json(0,'操作失败');
        }
    }
} 