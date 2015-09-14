<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-11
 * Time: 下午2:53
 */

namespace app\controllers;

use app\models\Supplier;
use yii;
use Method;
use yii\base\Controller;
use yii\data\Pagination;
class SupplierController extends BaseController{

    protected $model_class  = "app\models\Supplier";
    protected $location_url = "supplier";

}
