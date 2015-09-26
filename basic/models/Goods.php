<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-11
 * Time: 下午2:43
 */

namespace app\models;
use Method;
use Yii;
use yii\db\ActiveRecord;

class Goods extends ActiveRecord{

    public static function tableName(){
        return '{{%Goods}}';
    }
    public function rules()
    {
        return [
            [['name','sn','logo','category_id','brand_id','supplier_id','market_price','shop_price','store_type','store_num','is_on_sale','goods_status','intro','status','createTime'], 'safe'],

        ];
    }

    public static  function getGoodsList($page,$limit,$sql=''){
        $app = Yii::$app->db;
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
    public static function getAttrList($id){
        $where = 'jae.status>0';
        if(!empty($id)){
            $where .= " AND jps.id=$id ";
        }
        $app = Yii::$app->db;
        $sql = "SELECT jae.* from jd_goods as jps
                JOIN jd_attribute as jae on jae.goodsType_id=jps.goodsType_id
                where $where";
        //这里报错,没有找到原因
        #var_dump($sql);die;
        $rows = $app->createCommand($sql)->queryAll();
        foreach($rows as &$row){
            if(!empty($row['value'])){
                $row['value'] = Method::str2arr($row['value']);
            }
        }
        return $rows;
    }

    public static function getGoodsAttrList($id){
        $where = 'att.status>0';
        if(!empty($id)){
            $where .= " AND pas.goods_id=$id";
        }
        $app = Yii::$app->db;
        $sql = "SELECT att.id,att.type,pas.* FROM {{%Particulars}} as pas
                join {{%attribute}} as att on att.id=pas.attribute_id
                where $where ";
        #var_dump($sql);die;
        $rows = $app->createCommand($sql)->queryAll();
        $attrArr = array();
        foreach($rows as $row){
            if($row['type']==1){
                $attrArr[$row['attribute_id']] = $row['value'];
            }else{
                $attrArr[$row['attribute_id']][] =$row['value'];
            }
        }
        return $attrArr;
    }
}
