<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-11
 * Time: 下午2:52
 */

namespace app\models;


use yii\db\ActiveRecord;

class Supplier extends ActiveRecord{

    public static function tableName(){
        return '{{%Supplier}}';
    }

} 