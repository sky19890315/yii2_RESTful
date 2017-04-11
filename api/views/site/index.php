<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	
	/* @var $this yii\web\View */
	/* @var $form yii\widgets\ActiveForm */
	
	
	$this->title = '欢迎登录PRMEASURE-API首页';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PRMEASURE-API</title>
</head>
<body>

    <h1 ><?= Html::encode($this->title) ?></h1>

    <p >Version:v1 time:<?php echo date("北京时间Y年m月d日H:i:s");?></p>
    
    <h3 >请求示例</h3>
    <p ><b>请求：</b>api.com\v1\stations &nbsp;&nbsp;&nbsp;&nbsp;<b>返回：</b>stations资源</p>
    <p ><b>请求：</b>api.com\v1\stations\1 &nbsp;&nbsp;&nbsp;&nbsp;<b>返回：</b>stations中id为1的资源</p>
    <p ><b>请求：</b>api.com\v1\users &nbsp;&nbsp;&nbsp;&nbsp;<b>返回：</b>users资源</p>
    <p ><b>请求：</b>api.com\v1\users\1 &nbsp;&nbsp;&nbsp;&nbsp;<b>返回：</b>users中id为1的资源</p>
    <p ><b>请求：<u>GET</u></b>&nbsp;&nbsp;api.com\v1\users\{id} &nbsp;&nbsp;&nbsp;&nbsp;<b>获取：</b>users中id为{id}的资源</p>
    <p ><b>请求：<u>POST</u></b>&nbsp;&nbsp;api.com\v1\users\{id} &nbsp;&nbsp;&nbsp;&nbsp;<b>创建：</b>users中id为{id}的资源</p>
    <p ><b>请求：<u>UPDATE</u></b>&nbsp;&nbsp;api.com\v1\users\{id} &nbsp;&nbsp;&nbsp;&nbsp;<b>更新：</b>users中id为{id}的资源</p>
    <p ><b>请求：<u>DELETE</u></b>&nbsp;&nbsp;api.com\v1\users\{id} &nbsp;&nbsp;&nbsp;&nbsp;<b>删除：</b>users中id为{id}的资源</p>
    <h3>响应码一览表</h3>
    <pre>
    100 => 'Continue',              101 => 'Switching Protocols',           102 => 'Processing',                118 => 'Connection timed out',
    200 => 'OK',                    201 => 'Created',                       202 => 'Accepted',                  203 => 'Non-Authoritative',
    204 => 'No Content',            205 => 'Reset Content',                 206 => 'Partial Content',           207 => 'Multi-Status',
    208 => 'Already Reported',      210 => 'Content Different',             226 => 'IM Used',                   300 => 'Multiple Choices',
    301 => 'Moved Permanently',     302 => 'Found',                         303 => 'See Other',                 304 => 'Not Modified',
    305 => 'Use Proxy',             306 => 'Reserved',                      307 => 'Temporary Redirect',        308 => 'Permanent Redirect',
    310 => 'Too many Redirect',     400 => 'Bad Request',                   401 => 'Unauthorized',              402 => 'Payment Required',
    403 => 'Forbidden',             404 => 'Not Found',                     405 => 'Method Not Allowed',        406 => 'Not Acceptable',
    407 => 'Proxy Authentication Required',                                 408 => 'Request Time-out',          409 => 'Conflict', 410 => 'Gone',
    411 => 'Length Required',       412 => 'Precondition Failed',           413 => 'Request Entity Too Large',  414 => 'Request-URI Too Long',
    415 => 'Unsupported Media Type',416 => 'Requested range unsatisfiable',                                     417 => 'Expectation failed',
    418 => 'I\'m a teapot',         421 => 'Misdirected Request',           422 => 'Unprocessable entity',      423 => 'Locked',
    424 => 'Method failure',        425 => 'Unordered Collection',          426 => 'Upgrade Required',
    428 => 'Precondition Required', 429 => 'Too Many Requests',             431 => 'Request Header Fields Too Large',
    449 => 'Retry With',            450 => 'Blocked by Windows Parental Controls',                              500 => 'Internal Server Error',
    501 => 'Not Implemented',       502 => 'Bad Gateway or Proxy Error',    503 => 'Service Unavailable',
    504 => 'Gateway Time-out',      505 => 'HTTP Version not supported',    507 => 'Insufficient storage',
    508 => 'Loop Detected',         509 => 'Bandwidth Limit Exceeded',      510 => 'Not Extended',              511 => 'Network Authentication Required',
    </pre>
    <h3>文件上传下载</h3>
    <a href="http://api.com/v1/file/upload">UpLoad</a>
    <br/>
    <br/>
    <br/>
    <br/>
    <a href="http://api.com/v1/file/download">DownLoad</a>
    <p>文件上传，只接受post方式，与版本无关，请求URL = http://api.prmeasure.com/upload/index </p>
    <p>即请求upload控制器的index动作，返回状态码</p>
    <p>服务区文件文件信息，与版本无关，请求URL = http://api.prmeasure.com/Download/index </p>
    <p>即请求download控制器的index动作，返回状态码</p>
</body>
</html>