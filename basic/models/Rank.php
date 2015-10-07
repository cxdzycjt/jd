<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-20
 * Time: 下午7:37
 */

namespace app\models;


use yii\db\ActiveRecord;

class Rank extends ActiveRecord{

    public static function tableName(){
        return '{{%Rank}}';
    }
    public function rules()
    {
        return [
            [['name','score_bottom','score_top','discount','status','createTime'], 'integer'],

        ];
    }
} 