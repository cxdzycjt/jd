<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-22
 * Time: 下午9:41
 */

namespace app\controllers;
use Method;
use app\models\Attribute;
use yii;
use app\models\GoodsType;

class AttributeController extends BaseController{
//问题:当验证有自定字段的时候,不输入值,则无法添加数据
    protected $model_class  = 'app\models\Attribute';
    protected $location_url = "attribute";
    protected $title = '类型属性';

    protected function edit_view_before(){
        $sql       =    "status>0";
        $goodsType =  GoodsType::find()->select(array('id','name'))->andWhere($sql)->orderBy('sort desc')->all();
        return array(
            'goodsType'=>$goodsType,
        );
    }
   // public function actionAttributeRow(){
    public function actionRows(){
        $app = Yii::$app->request;
        $id = $app->get('id');
        if(!empty($id)){
            $rows = Attribute::getAttributeList($id);
            if(!empty($rows)){
                Method::exit_json(1,$rows);
            }else{
                Method::exit_json(0);
            }
        }else{
            Method::exit_json(0);
        }


    }
} 