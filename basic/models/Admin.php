<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jd_admin".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $createTime
 * @property string $last_login_time
 * @property string $last_login_ip
 * @property string $auth_key
 * @property integer $status
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%Admin}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['createTime', 'last_login_time', 'last_login_ip', 'status'], 'integer'],
            [['username', 'email'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 32],
            [['auth_key'], 'string', 'max' => 6]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'createTime' => 'Create Time',
            'last_login_time' => 'Last Login Time',
            'last_login_ip' => 'Last Login Ip',
            'auth_key' => 'Auth Key',
            'status' => 'Status',
        ];
    }
    /*
     * 公共验证
     */
    public static function getCheckUser($username,$password){
        $result = Admin::find()->where(['username'=>$username])->all();
        if(count($result)<1){

        }else{
            return -1;
        }
    }
}
