<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-22
 * Time: 下午9:41
 */

namespace app\models;


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
}