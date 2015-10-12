<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jd_adminrole".
 *
 * @property integer $admin_id
 * @property integer $role_id
 */
class Adminrole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jd_adminrole';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_id', 'role_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'admin_id' => 'Admin ID',
            'role_id' => 'Role ID',
        ];
    }
}
