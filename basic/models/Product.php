<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-26
 * Time: 下午9:14
 */

namespace app\models;
use Method;
use yii;
use yii\db\ActiveRecord;

class Product extends ActiveRecord{

    public static function tableName(){
        return '{{%Product}}';
    }

    public function rules()
    {
        return [
            [['goods_id','goods_attribute_ids','price','stock'], 'integer'],

        ];
    }
    public static function getListAdd($data){
        Product::deleteAll(['goods_id'=>$data['goods_id']]);
        $goods_id = $data['goods_id'];
        $stock = $data['stock'];
        $price = $data['price'];
        $arrProduct = array();
        foreach($data['id'] as $ids){
            $arrProduct[] = array('goods_id'=>$goods_id,'goods_attribute_ids'=>$ids,'stock'=>$stock[$ids],'price'=>$price[$ids]);
        }
        foreach($arrProduct as $row){
            $model = new Product();
            $model->setAttributes($row);
            $result = $model->save();
        }
        return $result?true:false;
    }
    public static function getSelectData($goods_id){
        $app = yii::$app->db;
        $sql1 = "select jae.name,jae.id from jd_particulars as jps
                JOIN jd_attribute as jae on jps.attribute_id=jae.id
                where jps.goods_id={$goods_id} and jae.type=2
                GROUP BY jae.name
                ORDER BY  jae.id ";
        $rows = $app->createCommand($sql1)->queryAll();
        return !empty($rows)?1:0;
    }
    public static function getProductList($goods_id){
        $app = yii::$app->db;
        $sql1 = "select jae.name,jae.id from jd_particulars as jps
                JOIN jd_attribute as jae on jps.attribute_id=jae.id
                where jps.goods_id={$goods_id} and jae.type=2
                GROUP BY jae.name
                ORDER BY  jae.id ";
        $rows = $app->createCommand($sql1)->queryAll();
        if(!empty($rows)){
            $sql2 = "select CONCAT(";
            $tid = array();
            $tValue = array();
            $tTbale1 = array();
            foreach($rows as $k=>$v){
                $tid[] = "t{$k}.id";
                $tValue[] = "t{$k}.value as value{$k}";
                $tTbale1[] = "(SELECT id,value from jd_particulars as jps where jps.attribute_id={$v['id']} and jps.goods_id={$goods_id}) as t{$k}";
            }
            $sql2 .= Method::arr2str($tid,",',',").') as ids ,' ;
            $sql2 .= Method::arr2str($tValue).' from ';
            $sql2 .= Method::arr2str($tTbale1).' order by ';
            $sql2 .= Method::arr2str($tid);
            $result  = $app->createCommand($sql2)->queryAll();
            $selectProduct = "select * from {{%Product}} where goods_id={$goods_id}";
            $selectAddData = $app->createCommand($selectProduct)->queryAll();
            $keyGoods = array_column($selectAddData,'goods_attribute_ids');
            $arrProduct = array_combine($keyGoods,$selectAddData);
            return array(
                'rows'=>$rows,
                'result'=>$result,
                'arrProduct'=>$arrProduct,
            );
        }else{
            Method::exit_json(0,'该商品没有添加商品属性');
        }

    }
} 