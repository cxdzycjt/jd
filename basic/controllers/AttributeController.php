<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-22
 * Time: 下午9:41
 */

namespace app\controllers;


use app\models\GoodsType;

class AttributeController extends BaseController{

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
} 