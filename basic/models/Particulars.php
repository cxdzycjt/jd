<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-24
 * Time: 下午10:48
 */

namespace app\models;


use yii\db\ActiveRecord;

class Particulars extends ActiveRecord{

    public static function tableName(){
        return '{{%Particulars}}';
    }

    public function rules()
    {
        return [
            [['goods_id','attribute_id','value'], 'integer'],

        ];
    }
} 