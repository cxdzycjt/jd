<?php
namespace app\controllers;

use yii;
use yii\base\Controller;
use UploadFile;

class UploadController extends Controller {

   public function actionAdd(){
       $httpHost = dirname($_SERVER['SCRIPT_FILENAME']);
       //传至此文件夹
       $config =   array(
           'int_max_size'           =>  3145728,    // 上传文件的最大值
           'arr_allow_exts'         =>  array('jpg', 'gif', 'png', 'jpeg'),    // 允许上传的文件后缀 留空不作后缀检查
           'str_save_path'          =>  $httpHost.'/uploads/',// 上传文件保存路径
       );
       $upload = new UploadFile($config);
       $arr_rs = $upload->upload($_FILES['Filedata']);
       $arr_rs = $arr_rs['arr_data']['arr_data'];
       $str_save_url = '/uploads/'.$arr_rs[0]['savename'];
       $arr_datas = array(
              'status' =>1,
              'info'   =>'上传成功能',
               'save_url' =>$str_save_url,
       );
       echo json_encode($arr_datas);
   }




}
