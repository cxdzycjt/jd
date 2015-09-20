<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-10
 * Time: 上午11:01
 */

namespace app\controllers;

use app\models\Brand;
use app\models\Category;
use app\models\Goods;
use app\models\Rank;
use app\models\Supplier;
use yii;
use Method;
use yii\data\Pagination;
class GoodsController extends BaseController{

    protected $model_class  = 'app\models\Goods';
    protected $location_url = "goods";
    protected $title        = '商品';

    public function actionIndex(){
        $app     =     Yii::$app->request;
        $name    =    $app->get('name');
        $category_id    =    $app->get('category_id');
        $brand_id    =    $app->get('brand_id');
        $is_on_sale    =    $app->get('is_on_sale');
        $where   =    'where gos.status>0 ';
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



    protected function edit_view_before(){
        //分类的数据
        $data  = new Category();
        $tree  = $data->getJsonTree($parent_id='true');
        //品牌数据
        $brand = Brand::find()->andWhere(" status > 0 ")->all();
        //供应商
        $supplier = Supplier::find()->andWhere(" status > 0 ")->all();
        //会员数据
        $rank  = Rank::find()->andWhere(" status > 0 ")->all();
        return array(
            'tree'     => $tree,
            'brand'    => $brand,
            'supplier' =>$supplier,
            'rank'    =>$rank,
        );
    }
    protected function _goods_sn($save_sn){
          $sn = Method::_setNumberId('S');
          Goods::updateAll(['sn'=>$sn],'id=:id',array(':id'=>$save_sn));
    }

} 