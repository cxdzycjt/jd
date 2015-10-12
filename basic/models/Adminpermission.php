<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jd_adminpermission".
 *
 * @property integer $admin_id
 * @property integer $permission_id
 */
class Adminpermission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jd_adminpermission';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_id', 'permission_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'admin_id' => 'Admin ID',
            'permission_id' => 'Permission ID',
        ];
    }

    public static function AdminPermission($id){
        $app = Yii::$app->db;
        $sql = "SELECT permission_id FROM {{%adminPermission}} where admin_id='{$id}'";
        $result = $app->createCommand($sql)->queryAll();
        $roles = array();
        foreach($result as $row){
            $roles[] = $row['permission_id'];
        }
        return json_encode($roles);
    }
}
