<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-20
 * Time: 下午8:44
 */

namespace app\models;


use yii\db\ActiveRecord;

class GoodsMemberPrice extends ActiveRecord{

    public static function tableName(){
        return '{{%GoodsMemberPrice}}';
    }
} 