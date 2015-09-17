<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-11
 * Time: 下午2:43
 */

namespace app\models;

use Method;
use yii\db\ActiveRecord;

class Category  extends ActiveRecord{

    public static function tableName(){
        return '{{%Category}}';
    }
    public function rules()
    {
        return [
            [['name','parent_id','lft','rght','status','intro','createTime'], 'required'],

        ];
    }
    public  function getJsonTree(){
        $app = \Yii::$app->db;
        $sql = "SELECT id,name,parent_id FROM {{%Category}} WHERE status>0 AND parent_id>0 ORDER BY lft";
        $result = $app->createCommand($sql)->queryAll();
        return json_encode($result);
    }
}