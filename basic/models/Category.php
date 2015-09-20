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
use yii\db\Expression;

class Category  extends ActiveRecord{

    public static function tableName(){
        return '{{%Category}}';
    }
    public function rules()
    {
        return [
            [['name','parent_id','lft','rght','status','createTime'], 'required'],

        ];
    }
    public  function getJsonTree($parent_id=false){
        if($parent_id){
            $parent = " AND parent_id>0 ";
        }else{
            $parent = '';
        }
        $app = \Yii::$app->db;
        $sql = "SELECT id,name,parent_id FROM {{%Category}} WHERE status>0 {$parent} ORDER BY lft";
        $result = $app->createCommand($sql)->queryAll();
        return json_encode($result);
    }

    public static function getMinus($counters, $condition = '', $params = [])
    {
        $n = 0;
        foreach ($counters as $name => $value) {
           // $counters[$name] = new Expression("[[$name]]+:bp{$n}", [":bp{$n}" => $value]);
            $counters[$name] = new Expression("[[$name]]-:bp{$n}", [":bp{$n}" => $value]);
            $n++;
        }
        $command = static::getDb()->createCommand();
        $command->update(static::tableName(), $counters, $condition, $params);

        return $command->execute();
    }
}