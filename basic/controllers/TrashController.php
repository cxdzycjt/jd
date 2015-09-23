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

class TrashController extends GoodsController{
    protected $model_class  = 'app\models\Trash';
    protected $location_url = "trash";
    protected $title        = '商品';
    protected $sql           = ' where gos.status<1 ';

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