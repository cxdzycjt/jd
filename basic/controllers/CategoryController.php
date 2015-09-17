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
        $parent_id     =   $data['parent_id'];
        $transaction   = Yii::$app->db->beginTransaction();
        try {
            if(!empty($data['id'])){        //修改分类
                $nodeId        = $data['id'];      //得到移动节点的ID,并计算出移动几个节点
                $nodeOffset    = Category::find()->where(['id'=>$nodeId])->one();
                $nodeRight     = $nodeOffset->attributes['rght'];   //移动的右节点 16
                $nodeLeft      = $nodeOffset->attributes['lft'];    //移动的左节点 11
                $offsetNumber  = $nodeRight-$nodeLeft+1;              //得到移动的节点数 16-11+1==(6)
                $parentNode    = Category::find()->select(['lft','rght'])->where(['id'=>$parent_id])->one();  //得到父节点的左右节点
                $parentLeft    = $parentNode->attributes['lft'];        //得到移动父节点的左边界边界(2)
                $parentRight   = $parentNode->attributes['rght'];       //得到移动父节点的右边边界边界(9)
                //UPDATE `jd_Category` SET lft=lft+4 WHERE lft<11 and lft >9
                //UPDATE `jd_Category` SET rght=rght+4 WHERE rght<11 and rght >=9
                Category::updateAllCounters(['lft'=>+$offsetNumber],"lft<$nodeLeft AND lft>$parentRight");    //修改左边界+4
                Category::updateAllCounters(['rght'=>+$offsetNumber],"lft<$nodeLeft AND lft>=$parentRight");    //修改右边界+4
                //调整移动的节点左右数字,父节点的右边界9和自己的边界右边界16-1作为边界值
                $info['rght']  = $parentRight;
                $info['lft']   = $nodeRight-2;
                var_dump($info);
                Category::updateAll($info,'id=:id',array(':id'=>$nodeId));
                #Category::findBySql("UPDATE jd_category SET lft=$parentRight,rght=$nodeRight-1 where id=$nodeId");
                //
                die;
                //完成一张小题单,做山村一课的生字卡片,读小熊过桥14首,数学一张
            }else{        //添加分类

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