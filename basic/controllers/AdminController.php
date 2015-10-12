<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-27
 * Time: 下午9:21
 */

namespace app\controllers;
use app\models\Admin;
use app\models\Adminpermission;
use app\models\Adminrole;
use app\models\Role;
use Yii;
use Method;
use yii\base\Exception;

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
            $transaction   = Yii::$app->db->beginTransaction();

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
                    try{
                        $roleIds = $info['role_ids'];
                        Adminrole::deleteAll(['admin_id'=>$info['id']]);
                        $AdminModel->setAttributes($info);
                        $permission_ids = $info['permission_ids'];
                        unset($info['role_ids']);
                        unset($info['permission_ids']);
                        Admin::updateAll($info,'id=:id',array(':id'=>$info['id']));
                        $roleAdminData = array();
                        foreach($roleIds as $role_id){
                            $roleAdminData[] =  array('role_id'=>$role_id,'admin_id'=>$info['id']);
                        }
                        foreach($roleAdminData as $data){
                            $adminRoleModel = new Adminrole();
                            $adminRoleModel->setAttributes($data);
                            $adminRoleModel->save();
                        }
                        if(!empty($permission_ids)){
                            $this->editRole($info,$permission_ids);
                        }
                        $transaction->commit();
                        Method::exit_json(1,'操作成功','/'.$this->location_url.'/index');
                    }catch (Exception $e){
                        $transaction->rollBack();
                        Method::exit_json(0,'操作失败,或者没有修改任何内容!!');
                    }

                }else{
                    $info['createTime'] = time();
                    $info['auth_key'] = Method::randString();
                    $info['password'] =  md5($info['password'].$info['auth_key']);
                    try{
                        $AdminModel->setAttributes($info);
                        $AdminModel->save();
                        $adminId = $AdminModel->id;
                        $roleIds = $info['role_ids'];
                        $roleAdminData = array();
                        foreach($roleIds as $role_id){
                            $roleAdminData[] =  array('role_id'=>$role_id,'admin_id'=>$adminId);
                        }
                        foreach($roleAdminData as $data){
                            $adminRoleModel = new Adminrole();
                            $adminRoleModel->setAttributes($data);
                            $adminRoleModel->save();
                        }
                        $this->addRole($adminId,$info);
                        $transaction->commit();
                        Method::exit_json(1,'操作成功','/'.$this->location_url.'/index');
                    }catch (Exception $e){
                        $transaction->rollBack();
                        Method::exit_json(0,'操作失败');
                    }
                }
            }else{
                Method::exit_json(0,'两次密码不相同,请重新输入!');
            }
        }else{
            $id          = $app->get('id');
            $commonData  = $model_class::find()->where(['id'=>$id])->one();
            $roleRows = Role::find()->where('status>0')->all();
            $adminRoleData = Adminrole::find()->where(['admin_id'=>$id])->all();
            $tree = Admin::getJsonTree(true);
            $admin_permission = Adminpermission::AdminPermission($id);
            $view        = Yii::$app->view;
            $view->params['layoutData'] =  $this->title.'列表';
            $view->params['controller'] =  $this->location_url;
            $view->params['action']     =  'index';
            return $this->render('edit',
                ['commonData'=>$commonData,'roleRows'=>$roleRows,'adminRoleData'=>$adminRoleData,'tree'=>$tree,'admin_permission'=>$admin_permission]
            );
        }
    }

    private function addRole($adminId,$info){
        $permissions = Method::str2arr($info['permission_ids']);

        $permissionRows = array();
        foreach($permissions as $permission){
            $permissionRows[] = array('admin_id'=>$adminId,'permission_id'=>$permission);
        }
        foreach($permissionRows as $row){
            $RolePermissionModel = new Adminpermission();
            $RolePermissionModel->setAttributes($row);
            $RolePermissionModel->save();
        }
    }

    private function editRole($info,$permission_ids){
        $permissions = Method::str2arr($permission_ids);
        unset($info['permission_ids']);
        Adminpermission::deleteAll(['admin_id'=>$info['id']]);
        $permissionRows = array();
        foreach($permissions as $permission){
            $permissionRows[] = array('admin_id'=>$info['id'],'permission_id'=>$permission);
        }
        foreach($permissionRows as $row){
            $RolePermissionModel = new Adminpermission();
            $RolePermissionModel->setAttributes($row);
            $RolePermissionModel->save();
        }

    }

} 