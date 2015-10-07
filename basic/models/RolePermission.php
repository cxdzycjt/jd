<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jd_rolePermission".
 *
 * @property integer $role_id
 * @property integer $permission_id
 * @property string $createTime
 */
class RolePermission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jd_rolePermission';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'permission_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'role_id' => 'Role ID',
            'permission_id' => 'Permission ID',
        ];
    }
    public static function primaryKey(){
        return 'your primary key';
    }
}
