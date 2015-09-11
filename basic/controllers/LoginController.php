<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-9-11
 * Time: 下午3:28
 */

namespace app\controllers;


use yii\base\Controller;

class LoginController extends Controller{

    public function actionLogin(){
        return $this->renderPartial('login');
    }
}
/* 语文
  * 读语文书5-10页的生字和儿歌3遍,
  * 读小熊过桥第7页3次,
  * 读国学第16页内容3次,
  * 要求学生都要指着字读书.
  * 提示:下昼体育课要跳绳,请家长给孩子准备一根便宜的跳绳(2-3元)带到学校,最好贴上班级和姓名.
  * 检查素材客户端详情页面功能.模拟数据,添加新闻详情页面及数据.
  * 等待数据素材客户端数据.
  * 数学:
 *    写数字1和2(一个数字写2排),
  */