<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-22
 * Time: 下午9:19
 */

namespace app\models;
use yii\db\ActiveRecord;

class GoodsType extends ActiveRecord{

    public static function tableName(){
        return '{{%GoodsType}}';
    }

    public function rules()
    {
        return [
            [['name','sort','status','intro','createTime'], 'integer'],

        ];
    }
}