<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-11
 * Time: 下午2:43
 */

namespace app\models;


use yii\db\ActiveRecord;

class Brand  extends ActiveRecord{

    public static function tableName(){
        return '{{%Brand}}';
    }

    public function rules()
    {
        return [
            [['name','logo','sort','status','intro','createTime'], 'integer'],

        ];
    }
} 