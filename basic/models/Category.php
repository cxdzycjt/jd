<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-11
 * Time: 下午2:43
 */

namespace app\models;


use yii\db\ActiveRecord;

class Category  extends ActiveRecord{

    public static function tableName(){
        return '{{%Category}}';
    }
}