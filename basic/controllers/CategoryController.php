<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-11
 * Time: 上午11:09
 */

namespace app\controllers;
use Method;
use app\models\Category;
use Yii;

class CategoryController extends BaseController{

    protected $model_class  = 'app\models\Category';
    protected $location_url = "category";
    protected $title = '分类';

    public function actionIndex(){
        $view = Yii::$app->view;
        $view->params['layoutData'] = '添加'.$this->title;
        $view->params['controller'] = $this->location_url;
        $view->params['action']      = 'edit';

        $sql = "parent_id>0";
        $models = Category::find()->andWhere($sql)->orderBy('lft')->all();
        $data = ['models'=>$models];
        return $this->render('index',$data);
    }

    public function actionEdit(){
        $app     =  Yii::$app->request;
        $data    =  $app->bodyParams;
        $categoryModel = new Category();
        $data['createTime']  = time();
        if($app->isPost){
        $transaction   = Yii::$app->db->beginTransaction();
        try {
            if(!empty($data['id'])){  //修改分类



            }else{        //添加分类
                $parent_id     =   $data['parent_id'];
                $categoryRow   =   Category::find()->select(array('rght'))->where(array('id'=>$parent_id))->one();
                $rght          =   $categoryRow->attributes['rght'];
                Category::updateAllCounters(['lft'=>+2],"lft>$rght");
                Category::updateAllCounters(['rght'=>+2],"rght>=$rght");
                $data['lft']         = $rght;
                $data['rght']        = $rght +1;
                $categoryModel->setAttributes($data);
                $result = $categoryModel->save();
            }
            $transaction->commit();
            if($result){
                Method::exit_json(1,'操作成功','/'.$this->location_url.'/index');
            }else{
                Method::exit_json(0,'操作失败');
            }
        } catch (Exception $e) {
            $transaction->rollBack();

        }

        }else{
            $id          = $app->get('id');
            $commonData  = Category::find()->where(['id'=>$id])->one();
            $view        = Yii::$app->view;
            $view->params['layoutData'] =  $this->title.'列表';
            $view->params['controller'] =  $this->location_url;
            $view->params['action']     =  'index';
            $tree                         =  $this->edit_view_before();
            return $this->render('edit',['commonData'=>$commonData,'tree'=>$tree]);
        }
    }
    //覆盖父类方法,并传给父类ztree的格式数据
    protected function edit_view_before(){
        $data = new Category();
        $result = $data->getJsonTree();
        return $result;
    }
} 