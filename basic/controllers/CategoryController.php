<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-11
 * Time: 上午11:09
 */

namespace app\controllers;

use app\models\Category;
use Yii;

class CategoryController extends BaseController{

    protected $model_class  = 'app\models\Category';
    protected $location_url = "category";
    protected $title = '分类';

    protected function edit_view_before(){
        $data = new Category();
        $result = $data->getJsonTree();
        return $result;
    }
} 