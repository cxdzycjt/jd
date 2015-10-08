<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jd_role".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property string $intro
 * @property string $createTime
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jd_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'createTime'], 'integer'],
            [['intro'], 'string'],
            [['name'], 'string', 'max' => 100]
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
            'status' => 'Status',
            'intro' => 'Intro',
            'createTime' => 'Create Time',
        ];
    }
    public static function primaryKey(){
        return 'your primary key';
    }
    public static  function getJsonTree($parent_id=false){
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
