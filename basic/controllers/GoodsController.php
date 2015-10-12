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
use app\models\GoodsGallery;
use app\models\GoodsMemberPrice;
use app\models\GoodsType;
use app\models\Particulars;
use app\models\Rank;
use app\models\Supplier;
use yii\base\Exception;
use yii;
use Method;
use yii\data\Pagination;
class GoodsController extends BaseController{

    protected $model_class  = 'app\models\goods';
    protected $location_url = "goods";
    protected $title         = '商品';
   // protected $sql           = 'where gos.status>0 ';
    public function actionIndex(){
        $app     =     Yii::$app->request;
        $name    =    $app->get('name');
        $category_id    =    $app->get('category_id');
        $brand_id    =    $app->get('brand_id');
        $is_on_sale    =    $app->get('is_on_sale');
        $where   =  'where gos.status>0' ;
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

    public function actionEdit(){
        $app           =    Yii::$app->request;
        $GoodsModel =    new Goods();
        $info          =    $app->bodyParams;
        if($app->isPost){
            $result = $this->GoodsSave($info);
            if($result){
                Method::exit_json(1,'操作成功','/'.$this->location_url.'/index');
            }else{
                Method::exit_json(0,'操作失败');
            }
        }else{
            $id          = $app->get('id');
            $commonData  = $GoodsModel::find()->where(['id'=>$id])->one();
            $rankPrice   = GoodsMemberPrice::find()->where(['goods_id'=>$id])->all();
            $galleryImg  = GoodsGallery::find()->where(['goods_id'=>$id])->all();
            //商品属性
            $attributes = array();
            $GoodsAttributes = array();
            if(!empty($id)){
                $attributes   = Goods::getAttrList($id);
                //取出当前货品对应属性
                $GoodsAttributes   = Goods::getGoodsAttrList($id);
            }
            $view        = Yii::$app->view;
            $view->params['layoutData'] =  $this->title.'列表';
            $view->params['controller'] =  $this->location_url;
            $view->params['action']     =  'index';
            $data                         =  $this->edit_view_before();
            return $this->render('edit',
                ['commonData'  => $commonData,
                    'tree'      => $data['tree'],
                    'brand'     => $data['brand'],
                    'supplier'  => $data['supplier'],
                    'rank'       => $data['rank'],
                    'goodsType'  => $data['goodsType'],
                    'rankPrice' => $rankPrice,
                    'galleryImg' => $galleryImg,
                    'attributes' => $attributes,
                    'GoodsAttributes' =>$GoodsAttributes,
                ]
            );
        }
    }

    private function GoodsSave($info){
        $GoodsModel =    new Goods();
        $goodsDate = $info['goods'];

        $numberPrice = $info['numberPrice'];
        $gallery = isset($info['gallery'])?$info['gallery']:'';
        $attribute = isset($info['attribute'])?$info['attribute']:'';
        $transaction   = Yii::$app->db->beginTransaction();
        $goodsDate['goodsType_id'] = !empty($goodsDate['goodsType_id'])?$goodsDate['goodsType_id']:0;
        try {
            if(!empty($goodsDate['id'])){
                $GoodsModel::updateAll($goodsDate,'id=:id',array(':id'=>$goodsDate['id']));
                if(!empty($gallery)){
                    $result = $this->memberPrice($numberPrice,$goodsDate['id']);
                }
                if(!empty($gallery)){
                    $result = $this->gallery($gallery,$goodsDate['id']);
                }
                if(!empty($attribute)){
                    $result = $this->particulars($attribute,$goodsDate['id']);
                }
            }else{
                $goodsDate['createTime'] = time();
                $GoodsModel->setAttributes($goodsDate);
                $GoodsModel->save();
                $result = Goods::updateAll(['sn'=>Method::_setNumberId('S')],'id=:id',array(':id'=>$GoodsModel->id));
                if(!empty($numberPrice)){
                    $result = $this->memberPrice($numberPrice,$GoodsModel->id);
                }
                if(!empty($gallery)){
                    $result = $this->gallery($gallery,$GoodsModel->id);
                }
                if(!empty($attribute)){
                    $result = $this->particulars($attribute,$GoodsModel->id);
                }
            }
            $transaction->commit();
            if($result){
                Method::exit_json(1,'操作成功','/'.$this->location_url.'/index');
            }else{
                Method::exit_json(0,'操作失败');
            }
        } catch (Exception $e) {
            $transaction->rollBack();
        }
    }
    private function memberPrice($numberPrice,$goodsId){
        GoodsMemberPrice::deleteAll(['goods_id'=>$goodsId]);
        $memberPriceArr = array();
        foreach($numberPrice as $k=>$v){
            $memberPriceArr[] = array('goods_id'=>$goodsId,'rank_id'=>$k,'price'=>$v);
        }
        foreach($memberPriceArr as $price){
            //创建这个model对象的时候,不能放在foreach外面,否则入库时,(针对改数据$price会隔行丢失goods_id的数据)
            $memberPriceModel = new GoodsMemberPrice();
            $memberPriceModel->setAttributes($price);
            $result = $memberPriceModel->insert();
        }
        return $result?true:false;
    }
    private function gallery($gallery,$goodsId){
        $galleryArr = array();
        foreach($gallery as $pic){
            $galleryArr[]= array('goods_id'=>$goodsId,'pic'=>$pic);
        }
        foreach($galleryArr as $arr){
            $galleryModel = new GoodsGallery();
            $galleryModel->setAttributes($arr);
            $result = $galleryModel->save();
        }
        return $result?true:false;
    }

    private function particulars($particulars,$goodsId){
       Particulars::deleteAll(['goods_id'=>$goodsId]);
       $attributeRows = array();
       foreach($particulars as $k=>$v){
           if(is_array($v)){
                foreach($v as $val){
                 $attributeRows[] = array('goods_id'=>$goodsId,'attribute_id'=>$k,'value'=>$val);
                }
           }else{
                 $attributeRows[] = array('goods_id'=>$goodsId,'attribute_id'=>$k,'value'=>$v);
           }
       }
        foreach($attributeRows as $row){
            $particularsModel = new Particulars();
            $particularsModel->setAttributes($row);
            $result = $particularsModel->save();
        }
        return $result?true:false;
    }

    public function actionRemoveImg(){
        $app           =    Yii::$app->request;
        $info          =    $app->bodyParams;
        $galleryRow = GoodsGallery::find()->where(['id'=>$info['gallery_id']])->one();
        if($galleryRow->delete()){
            Method::exit_json(1);
        }else{
            Method::exit_json(0);
        }
    }
    //准备页面数据
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
        //商品类型
        $goodsType =  GoodsType::find()->select(array('id','name'))->andWhere(" status > 0 ")->orderBy('sort desc')->all();

        return array(
            'tree'     => $tree,
            'brand'    => $brand,
            'supplier' =>$supplier,
            'rank'    =>$rank,
            'goodsType'=>$goodsType,
        );
    }

} 