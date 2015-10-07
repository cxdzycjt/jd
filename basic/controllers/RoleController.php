<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-10-7
 * Time: 下午9:35
 */

namespace app\controllers;
use app\models\RolePermission;
use Method;
use Yii;
use app\models\Role;
use yii\base\Exception;

class RoleController extends BaseController{

    protected $model_class = 'app\models\role';
    protected $location_url = "role";
    protected $title = '角色';

//    public function actionEdit(){
//        $app = Yii::$app->request;
//        $transaction = Yii::$app->db->beginTransaction();
//        try{
//            parent::actionEdit();
//            $transaction->commit();
//        }catch (Exception $e){
//            $transaction->rollBack();
//        }
//
//    }

    public function actionEdit(){
        $model_class   =    $this->model_class;
        $app           =    Yii::$app->request;
        $supplierModel =    new $model_class();
        $info          =    $app->bodyParams;
        if($app->isPost){
            if(!empty($info['id'])){
                $info['createTime'] = time();
                $supplierModel->setAttributes($info);
                if($model_class::updateAll($info,'id=:id',array(':id'=>$info['id']))){
                    Method::exit_json(1,'操作成功','/'.$this->location_url.'/index');
                }else{
                    Method::exit_json(0,'操作失败');
                }
            }else{
                $info['createTime'] = time();
                $result = $this->addRole($info);
                if($result){
                    Method::exit_json(1,'操作成功','/'.$this->location_url.'/index');
                }else{
                    Method::exit_json(0,'操作失败');
                }
            }

        }else{
            $id          = $app->get('id');
            $commonData  = $model_class::find()->where(['id'=>$id])->one();
            $view        = Yii::$app->view;
            $view->params['layoutData'] =  $this->title.'列表';
            $view->params['controller'] =  $this->location_url;
            $view->params['action']     =  'index';
            $data                         =  $this->edit_view_before();
            return $this->render('edit',
                ['commonData'=>$commonData,
                    'tree'   =>isset($data['tree'])?$data['tree']:'',
                    'brand'  =>isset($data['brand'])?$data['brand']:'',
                    'supplier'=>isset($data['supplier'])?$data['supplier']:'',
                    'rank'    =>isset($data['rank'])?$data['rank']:'',
                    'goodsType' =>isset($data['goodsType'])?$data['goodsType']:'',
                ]
            );
        }
    }

    private function addRole($info){
        $permissions = Method::str2arr($info['permission_ids']);
      //  unset($info['permission_ids']);
        $supplierModel =    new Role();
        $transaction = Yii::$app->db->beginTransaction();
        try{
            $supplierModel->setAttributes($info);

            $supplierModel->save($info);
            $roleId = $supplierModel->id;
            $permissionRows = array();
            foreach($permissions as $permission){
                $permissionRows[] = array('role_id'=>$roleId,'permission_id'=>$permission);
            }
            foreach($permissionRows as $row){
                $RolePermissionModel = new RolePermission();
                $RolePermissionModel->setAttributes($row);
                $RolePermissionModel->save();
            }
            $transaction->commit();
            return true;
        }catch (Exception $e){
            $transaction->rollBack();
            return false;
        }

    }
    //覆盖父类方法,并传给父类ztree的格式数据
    protected function edit_view_before(){
        $data = new Role();
        $result = $data->getJsonTree(true);
        return array(
            'tree'=>$result
        );
    }

} 