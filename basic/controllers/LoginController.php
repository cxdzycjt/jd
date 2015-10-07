<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-11
 * Time: 下午3:28
 */

namespace app\controllers;

use app\models\Admin;
use app\models\LoginForm;
use yii;
use yii\base\Controller;
use yii\web\Cookie;
use Method;
class LoginController extends Controller{

    public function actionLogin(){
        $cookies = Yii::$app->response->cookies;

        $app  =  Yii::$app->request;
        if($app->isPost){
            $info  =  $app->bodyParams;
            if(!empty($info['username']) && !empty($info['password'])){
                $result = Admin::find()->where(['username'=>$info['username']])->one();
                if(!empty($result)){
                    $pass = md5($info['password'].$result->attributes['auth_key']);
                    if($pass == $result->attributes['password']){
                        $data = ['last_login_time'=>time(),'last_login_ip'=>ip2long(Method::get_clink_ip())];
                        Admin::updateAll($data,'id=:id',array(':id'=>$result->attributes['id']));
                        $cookies->add(new Cookie([
                            'name' => 'username',
                            'value' => $info['username'],
                            'expire'=>time()+3600*24*7,
                        ]));
                        $cookies->add(new Cookie([
                            'name' => 'user_id',
                            'value' => $result->attributes['id'],
                            'expire'=>time()+3600*24*7,
                        ]));
                        Method::exit_json(1,'操作成功','/index/index');
                    }else{
                        Method::exit_json(4,'密码不正确');
                    }
                }else{
                    Method::exit_json(3,'用户名不存在');
                }
            }else{
                Method::exit_json(2,'用户名和密码不能为空');
        }
        }else{
            return $this->renderPartial('login');
        }
    }

    public function actionSecede(){
        $cookies    = Yii::$app->response->cookies;
        $cookies->remove('username');
        $cookies->remove('user_id');
        return $this->renderPartial('/login/login');
    }
}