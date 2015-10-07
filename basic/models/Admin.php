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
            'username' => '管理员姓名',
            'password' => '管理员密码',
        ];
    }
    /*
     * 公共验证
     */
    public static function getCheckUser($username,$password){
        //当前位置需要修改查询方法,暂留
        $result = Admin::find()->where(['username'=>$username])->one();
        if(count($result)<=1){
            $password_auth_key = md5(($password.$result->attributes['auth_key']));
             if($result->attributes['password']== $password_auth_key){
                 return array('status'=>1,'auth_key'=>$result->attributes['auth_key']);
             }else{
                 return array('status'=>-2,'msg'=>'输入的旧密码不正确!');
             }
        }else{
            return array('status'=>-1,'msg'=>'用户名已经存在!');
        }
    }
}
