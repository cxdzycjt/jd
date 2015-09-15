<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-11
 * Time: 上午10:52
 */

namespace app\controllers;

use app\models\Brand;
use Method;
use yii;
use yii\base\Controller;
use yii\data\Pagination;
class BrandController extends BaseController{

    protected $model_class = 'app\models\Brand';
    protected $location_url = "brand";
    protected $title = '品牌';
} 