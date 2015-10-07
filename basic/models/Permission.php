<?php

namespace app\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "jd_permission".
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property integer $parent_id
 * @property integer $lft
 * @property integer $rght
 * @property integer $level
 * @property integer $status
 * @property integer $createTime
 */
class Permission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jd_permission';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'lft', 'rght', 'level', 'status', 'createTime'], 'integer'],
            [['name', 'url'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'url' => 'Url',
            'parent_id' => 'Parent ID',
            'lft' => 'Lft',
            'rght' => 'Rght',
            'level' => 'Level',
            'status' => 'Status',
            'createTime' => 'Create Time',
        ];
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
    public  function getJsonTree($parent_id=false){
        if($parent_id){
            $parent = " AND parent_id>0 ";
        }else{
            $parent = '';
        }
        $app = \Yii::$app->db;
        $sql = "SELECT id,name,parent_id FROM {{%Permission}} WHERE status>0 {$parent} ORDER BY lft";
        $result = $app->createCommand($sql)->queryAll();
        return json_encode($result);
    }

}
