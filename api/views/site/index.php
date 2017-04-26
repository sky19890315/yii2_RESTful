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
    <style>
        .nav {
          background-color: #ffffcc;
          width: 1240px;
        }
        .box {
            background-color: #f0f0f1;
            width: 1240px;
            border: 1px solid;
        }
        
        .test {
            background-color: #00a7d0;
        }
    </style>
    
</head>
<body>

    <h1 class="nav"><?= Html::encode($this->title) ?></h1>

    <p >Version:v1 time:<?php echo date("北京时间Y年m月d日H:i:s");?></p>
    <div>
        <pre>
认证方式： HTTPBASICAUTH
请求注册地址：<a href="site/signup">api.prmeasure.com/site/signup</a>
测试登录：<a href="site/login">api.prmeasure.com/site/login</a>
        </pre>
    </div>
    <h3 >请求示例</h3>
    <p ><b>请求：</b>api.prmeasure\v1\stations &nbsp;&nbsp;&nbsp;&nbsp;<b>返回：</b>stations资源</p>
    <p ><b>请求：</b>api.prmeasure\v1\stations\1 &nbsp;&nbsp;&nbsp;&nbsp;<b>返回：</b>stations中id为1的资源</p>
    <p ><b>请求：</b>api.prmeasure\v1\users &nbsp;&nbsp;&nbsp;&nbsp;<b>返回：</b>users资源</p>
    <p ><b>请求：</b>api.prmeasure\v1\users\1 &nbsp;&nbsp;&nbsp;&nbsp;<b>返回：</b>users中id为1的资源</p>
    <p ><b>请求：<u>GET</u></b>&nbsp;&nbsp;api.prmeasure\v1\users\{id} &nbsp;&nbsp;&nbsp;&nbsp;<b>获取：</b>users中id为{id}的资源</p>
    <p ><b>请求：<u>POST</u></b>&nbsp;&nbsp;api.prmeasure\v1\users\{id} &nbsp;&nbsp;&nbsp;&nbsp;<b>创建：</b>users中id为{id}的资源</p>
    <p ><b>请求：<u>UPDATE</u></b>&nbsp;&nbsp;api.prmeasure\v1\users\{id} &nbsp;&nbsp;&nbsp;&nbsp;<b>更新：</b>users中id为{id}的资源</p>
    <p ><b>请求：<u>DELETE</u></b>&nbsp;&nbsp;api.prmeasure\v1\users\{id} &nbsp;&nbsp;&nbsp;&nbsp;<b>删除：</b>users中id为{id}的资源</p>
    <h3>服务器资源列表</h3>
    <div class="box">
        <pre>
        上传提交网址       http://api.prmeasure.com/upload/index          //暂时与版本无关
        模拟上传网址       http://api.prmeasure.com/v1/file/upload
        下载请求网址       http://api.prmeasure.com/download/index        //暂时与版本无关
        试验台信息集       http://api.prmeasure.com/v1/stations
        普通用户信息       http://api.prmeasure.com/v1/users
        管理员信息集       http://api.prmeasure.com/v1/admins
        模拟订单信息       http://api.prmeasure.com/v1/testorders
        </pre>
    </div>
    <h3>响应码一览表</h3>
    <div class="box">
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
    </div>
    <h3>错误码速查表</h3>
    <div class="box">
        <pre>
        200: OK。一切正常。
        201: 响应 POST 请求时成功创建一个资源。Location header 包含的URL指向新创建的资源。
        204: 该请求被成功处理，响应不包含正文内容 (类似 DELETE 请求)。
        304: 资源没有被修改。可以使用缓存的版本。
        400: 错误的请求。可能通过用户方面的多种原因引起的，例如在请求体内有无效的JSON 数据，无效的操作参数，等等。
        401: 验证失败。
        403: 已经经过身份验证的用户不允许访问指定的 API 末端。
        404: 所请求的资源不存在。
        405: 不被允许的方法。 请检查 Allow header 允许的HTTP方法。
        415: 不支持的媒体类型。 所请求的内容类型或版本号是无效的。
        422: 数据验证失败 (例如，响应一个 POST 请求)。 请检查响应体内详细的错误消息。
        429: 请求过多。 由于限速请求被拒绝。
        500: 内部服务器错误。 这可能是由于内部程序错误引起的。
        </pre>
    </div>
   
</body>
</html>