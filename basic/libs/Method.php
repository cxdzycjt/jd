<?php

class Method
{
/**
 * 字符串到数组
 */
    public static function str2arr($str,$delimiter=","){
        return explode($delimiter,$str);
    }
/**
 * 数组到字符串
 */
    public static function arr2str($arr,$delimiter=","){
        return implode($delimiter,$arr);
    }
/**
 * 生成guid
 * @return string
 */
    public static function guid()
    {
        mt_srand((double)microtime() * 10000);
        $charid = strtolower(md5(uniqid(rand(), true)));
        $uuid = substr($charid, 0, 8) . substr($charid, 8, 4) . substr($charid, 12, 4) . substr($charid, 16, 4) . substr($charid, 20, 12);
        return $uuid;
    }

/**
 * 格式化输出
 * @param string $str
 * @param string $e
 */
    public static function pre($str, $e = true)
    {
        echo "<pre>";
        print_r($str);
        echo "</pre>";

        if ($e) {
            exit;
        }
    }

/**
 * 调试日志记录
 * @param unknown $message
 */
    public static function debug_log($message)
    {
        $logfile = Yii::$app->basePath . '/runtime/' . date("Ymd") . ".log";
        $time = date("Y-m-d H:i:s", time());
        $fp = @fopen($logfile, 'a');
        @fwrite($fp, $time . "\r\n");
        @fwrite($fp, var_export($message, true) . "\r\n" . "\r\n");
        @fclose($fp);
    }

/**
 * 系统提示
 * @param string $msg
 * @param int $type
 * @param string $url
 */
    public static function alert($msg = 'null', $type = 1, $url = 'null')
    {
        echo '<script>';
        echo 'alert("' . $msg . '");';
        if ($type == 1) {
            echo 'location.href="' . $url . '"';
        } elseif ($type == 2) {
            echo 'history.back();';
        }
        echo '</script>';
    }

/**
 * 处理json返回
 * @param number $status
 * @param string $message
 * @param array $params
 */
    public static function exit_json( $status = 0, $message = null,$url = null, $params = array() ){
        exit(json_encode(array('status'=>$status, 'message'=>$message,'url'=>$url, 'params'=>$params)));
    }

/**
 * 处理dwz返回数据格式
 * @param number $code
 * @param string $message
 * @param string $message
 * @param string $type
 * @param string $rel
 * @param string $callback
 * @param string $reload
 */
    public static function dwz_json( $code = 300, $message = '系统错误!', $type = '', $rel = '', $callback = 'closeCurrent', $reload = '' ){
        $array = ["statusCode"=>$code, "message"=>$message, "navTabId"=>$type, "rel"=>$rel, "callbackType"=>$callback, "forwardUrl"=>$reload];
        exit(json_encode($array));
    }

/**
 * 生成（服务F，流水L，充值C，月帐Y，退款T）单ID，并发每百万才可能出现重复
 * @param string $type
 * @return string $number_sn
 */
    public static function _setNumberId( $type = 'MG'){
        $year_code = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        $number_sn = $type.$year_code[intval(date('Y'))-2015].
        strtoupper(dechex(date('m'))).date('d').
        substr(time(),-5).substr(microtime(),2,5).sprintf('%02d',rand(0,99));
        return  $number_sn;  
    }
}