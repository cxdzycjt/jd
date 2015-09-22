<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-22
 * Time: 上午11:54
 */

namespace app\models;


use yii\db\ActiveRecord;

class GoodsGallery extends ActiveRecord{

    public static function tableName(){
        return '{{%GoodsGallery}}';
    }
    public function rules()
    {
        return [
            [['goods_id','pic'], 'required'],

        ];
    }
} 