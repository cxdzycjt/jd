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

        $sql = "parent_id>0 and status>0";
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
            $parent_id     =   $data['parent_id'];
            $transaction   = Yii::$app->db->beginTransaction();
            try {
                if(!empty($data['id'])){        //修改分类
                    $nodeId        = $data['id'];      //得到移动节点的ID,并计算出移动几个节点
                    $nodeOffset    = Category::find()->where(['id'=>$nodeId])->one();
                    $nodeRight     = $nodeOffset->attributes['rght'];   //移动的右节点 14
                    $nodeLeft      = $nodeOffset->attributes['lft'];    //移动的左节点 11
                    $offsetNumber  = $nodeRight-$nodeLeft+1;              //得到移动的节点数 16-11+1== 4
                    $parentNode    = Category::find()->select(['lft','rght'])->where(['id'=>$parent_id])->one();  //得到父节点的左右节点
                    $parentRight   = $parentNode->attributes['rght'];       //得到移动父节点的右边边界边界(9)
                    if($nodeRight<$parentRight){
                        Category::getMinus(['lft'  =>$offsetNumber],"lft>$nodeLeft AND lft<$parentRight");
                        Category::getMinus(['rght' =>$offsetNumber],"rght>$nodeLeft AND rght<$parentRight");
                        $data['parent_id']   = $parent_id;
                        $data['rght']         = $parentRight-1;
                        $data['lft']          = $parentRight-$offsetNumber;
                        //查询该分类是否存在子分类
                        $categoryInfo       = Category::find()->where(['parent_id'=>$nodeId])->all();
                        $i = $data['lft']+1;
                        if(!empty($categoryInfo)){
                            foreach($categoryInfo  as  $category){
                                if($i<$data['rght'] || $i>$data['rght']){
                                    Category::updateAll(['lft'=>$i,'rght'=>$i+1],'id=:id',array(':id'=>$category['id']));
                                }
                                $i=$i+2;
                            }
                        }
                        $result = Category::updateAll($data,'id=:id',array(':id'=>$nodeId));
                    }else{
                        Category::updateAllCounters(['lft'=>+$offsetNumber],"lft<$nodeLeft AND lft>$parentRight");     // 9+4 =13
                        Category::updateAllCounters(['rght'=>+$offsetNumber],"rght<$nodeLeft AND rght>=$parentRight"); //10+4 =14
                        //调整移动的节点左右数字,父节点的右边界9和自己的边界右边界16-1作为边界值
                        $data['parent_id'] = $parent_id;
                        $data['rght']      = $parentRight+$offsetNumber-1;   //由于包括了父右边界,所以,减一得到移动的宽度
                        $data['lft']       =  $parentRight;
                        //查询该分类是否存在子分类
                        $categoryInfo       = Category::find()->where(['parent_id'=>$nodeId])->all();
                        $i = $parentRight+1;
                        if(!empty($categoryInfo)){
                            foreach($categoryInfo  as  $category){
                                if($i<$data['lft'] || $i>$data['lft']){
                                    Category::updateAll(['lft'=>$i,'rght'=>$i+1],'id=:id',array(':id'=>$category['id']));
                                }
                                $i=$i+2;
                            }
                        }
                        $result    = Category::updateAll($data,'id=:id',array(':id'=>$nodeId));
                    }
                }else{        //添加分类
                    $categoryRow   =   Category::find()->select(array('rght'))->where(array('id'=>$parent_id))->one();
                    $rght          =   $categoryRow->attributes['rght'];
                    Category::updateAllCounters(['lft'=>+2],"lft>$rght");
                    Category::updateAllCounters(['rght'=>+2],"rght>=$rght");
                    $data['lft']   = $rght;
                    $data['rght']  = $rght +1;
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

    public function actionDel(){
        $app  =  Yii::$app->request;
        $id   =  $app->get('id');
        $info['status'] = 0;
        $transaction     = Yii::$app->db->beginTransaction();
        try {
            $categoryInfo       = Category::find()->where(['parent_id'=>$id])->all();
            foreach($categoryInfo as $cate){
                Category::updateAll($info,'id=:id',array(':id'=>$cate['id']));
            }
            $result = Category::updateAll($info,'id=:id',array(':id'=>$id));
            $transaction->commit();
            if($result){
                Method::exit_json(1,'操作成功','/'.$this->location_url.'/index');
            }else{
                Method::exit_json(0,'操作失败');
            }
        } catch (Exception $e) {
            $transaction->rollBack();
        }

    }

    //覆盖父类方法,并传给父类ztree的格式数据
    protected function edit_view_before(){
        $data = new Category();
        $result = $data->getJsonTree();
        return $result;
    }
} 