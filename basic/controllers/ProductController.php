<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-26
 * Time: 下午8:57
 */

namespace app\controllers;
use Method;
use app\models\Product;
use yii\base\Controller;
use Yii;
class ProductController extends Controller{

    public $layout='admin';
    protected $location_url = "goods";
    protected $title = '品牌';

    public function actionIndex(){
        $app  = Yii::$app->request;
        if($app->isPost){
            $info = $app->bodyParams;
            $result = Product::getListAdd($info);
            if($result){
                Method::exit_json(1,'操作成功','/'.$this->location_url.'/index');
            }else{
                Method::exit_json(0,'操作失败');
            }
        }else{
            $goods_id = $app->get('id');
            $result= Product::getSelectData($goods_id);
            if($result){
                $productList = Product::getProductList($goods_id);
                $view = Yii::$app->view;
                $view->params['layoutData'] = $this->title.'列表';
                $view->params['controller'] = $this->location_url;
                $view->params['action']     = 'index';

                return $this->render('index',['productList'=>$productList,'goods_id'=>$goods_id,'arrProduct'=>$productList['arrProduct']]);
            }else{
                Method::exit_json(0,'该商品没有添加商品属性');
            }
           }
    }
    public function actionAttribute(){
        $app  = Yii::$app->request;
        $goods_id = $app->get('id');
        $result= Product::getSelectData($goods_id);
        if($result){
            Method::exit_json(1,'成功选择商品',"/product/index/$goods_id");
        }else{
            Method::exit_json(0,'该商品没有添加商品属性');
        }
    }
}
