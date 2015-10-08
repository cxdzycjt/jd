<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-27
 * Time: 下午9:21
 */

namespace app\controllers;
use app\models\Admin;
use Yii;
use Method;
class AdminController extends BaseController{

    protected $model_class = 'app\models\Admin';
    protected $location_url = "admin";
    protected $title = '管理员';

    public function actionEdit(){
        $model_class   =    $this->model_class;
        $app           =    Yii::$app->request;
        $AdminModel =    new Admin();
        $info          =    $app->bodyParams;

        if($app->isPost){
            if(!empty($info['password']) && $info['password']===$info['repassword']){
                if(!empty($info['id'])){
                    if(empty($info['password'])){
                        unset($info['oldpassword']);
                        unset($info['repassword']);
                        unset($info['password']);
                    }else{
                        if(!empty($info['oldpassword'])){
                            $result = Admin::getCheckUser($info['username'],$info['oldpassword']);
                            if($result['status']==-1){
                                Method::exit_json(0,$result['msg']);
                            }elseif($result['status']==-2){
                                Method::exit_json(0,$result['msg']);
                            }
                        }else{
                            Method::exit_json(0,'操作失败,旧密码不能为空!!');
                        }
                    }

                    unset($info['oldpassword']);
                    unset($info['repassword']);
                    $info['password'] = md5($info['password'].$result['auth_key']);
                    $AdminModel->setAttributes($info);
                    if($model_class::updateAll($info,'id=:id',array(':id'=>$info['id']))){
                        Method::exit_json(1,'操作成功','/'.$this->location_url.'/index');
                    }else{
                        Method::exit_json(0,'操作失败,或者没有修改任何内容!!');
                    }
                }else{
                    $info['createTime'] = time();
                    $info['auth_key'] = Method::randString();
                    $info['password'] =  md5($info['password'].$info['auth_key']);
                    $AdminModel->setAttributes($info);
                    if($AdminModel->save()){
                        Method::exit_json(1,'操作成功','/'.$this->location_url.'/index');
                    }else{
                        Method::exit_json(0,'操作失败');
                    }
                }
            }else{
                Method::exit_json(0,'两次密码不相同,请重新输入!');
            }
        }else{
            $id          = $app->get('id');
            $commonData  = $model_class::find()->where(['id'=>$id])->one();
            $view        = Yii::$app->view;
            $view->params['layoutData'] =  $this->title.'列表';
            $view->params['controller'] =  $this->location_url;
            $view->params['action']     =  'index';
            return $this->render('edit',['commonData'=>$commonData]);
        }
    }

} 