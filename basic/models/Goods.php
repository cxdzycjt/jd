<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-11
 * Time: 下午2:43
 */

namespace app\models;


use yii\db\ActiveRecord;

class Goods extends ActiveRecord{

    public static function tableName(){
        return '{{%Goods}}';
    }
    public function rules()
    {
        return [
            [['name','sn','logo','category_id','brand_id','supplier_id','market_price','shop_price','store_type','store_num','is_on_sale','goods_status','intro','goods_type_id','status','createTime'], 'safe'],

        ];
    }
    public static  function getGoodsList($page,$limit,$sql=''){
        $app = \Yii::$app->db;
        $sql = "select gos.*, cgy.name as category_name,cgy.id as category_id,
                bad.name as brand_name,bad.id as brand_id,
                sper.name as supplier_name,sper.id as supplier_id
                from jd_goods as gos
                JOIN jd_category as cgy on cgy.id=gos.category_id
                JOIN jd_brand as bad on bad.id=gos.brand_id
                JOIN jd_supplier as sper on sper.id=gos.supplier_id
                {$sql}
                ORDER BY gos.createTime
                limit {$page},{$limit} ";
        $result = $app->createCommand($sql)->queryAll();
        return $result;
    }
}
