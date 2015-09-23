<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-22
 * Time: 下午9:41
 */

namespace app\models;
use Method;
use yii;
use yii\db\ActiveRecord;

class Attribute extends ActiveRecord{

    public static function tableName(){
        return '{{%Attribute}}';
    }

    public function rules()
    {
        return [
            [['goodsType_id','name','type','input_type','value','sort','status','intro','createTime'], 'required'],

        ];
    }
    public static function getAttributeList($id){
        $app = Yii::$app->db;
        $sql = "select * from {{%Attribute}} where status>0";
        $rows = $app->createCommand($sql)->queryAll();

        foreach($rows as &$row){
            if(!empty($row['value'])){
                $row['value'] = Method::str2arr($row['value'],',');
            }
        }
        return $rows;
    }
}