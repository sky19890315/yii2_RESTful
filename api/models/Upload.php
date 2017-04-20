<?php

	namespace api\models;
	
	use yii\base\Model;
	
	/**
	 * Class Upload
	 * @package api\models
	 */
	class Upload extends Model
	{
		/**
		 * @var 属性
		 */
		public $file;
		
		/**
		 * @return array
		 * 验证规则
		 *
		 * , 'extensions' => 'jpg, png, jpeg', 'mimeTypes' => 'image/jpeg, image/png'
		 */
		public function rules ()
		{
			return [
				[['file'], 'file'],
			];
		}
		
		/**
		 * @param $url
		 * @param $data
		 * @return mixed
		 */
		public static function curlPost($url, $data)
		{
			/**
			 * 初始化新的会话，返回 cURL 句柄，供curl_setopt()、 curl_exec() 和 curl_close() 函数使用。
			 * 如果提供了该参数，CURLOPT_URL 选项将会被设置成这个值。你也可以使用curl_setopt()函数手动地设置这个值
			 * 如果成功，返回 cURL 句柄，出错返回 FALSE。
			 */
			$ch = curl_init();
			
			/**
			 * curl_setopt — 设置 cURL 传输选项
			 * 为 cURL 会话句柄设置选项。
			 * option 需要设置的CURLOPT_XXX选项。
			 * value 将设置在option选项上的值。
			 * @string  CURLOPT_URL	需要获取的 URL 地址，也可以在curl_init() 初始化会话的时候。
			 */
			
			curl_setopt($ch, CURLOPT_URL, $url);
			/**
			 * @bool CURLOPT_RETURNTRANSFER  TRUE 将curl_exec()获取的信息以字符串返回，而不是直接输出。
			 */
			
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			/**
			 * CURLOPT_POST TRUE 时会发送 POST 请求，类型为：application/x-www-form-urlencoded，是 HTML 表单提交时最常见的一种。
			 */
			curl_setopt($ch, CURLOPT_POST, 1);
			
			/**
			 * 全部数据使用HTTP协议中的 "POST" 操作来发送。
			 * 要发送文件，在文件名前面加上@前缀并使用完整路径。
			 * 文件类型可在文件名后以 ';type=mimetype' 的格式指定。
			 * 这个参数可以是 urlencoded 后的字符串，类似'para1=val1&para2=val2&...'，也可以使用一个以字段名为键值，
			 * 字段数据为值的数组。 如果value是一个数组，Content-Type头将会被设置成multipart/form-data。
			 * 从 PHP 5.2.0 开始，使用 @ 前缀传递文件时，value 必须是个数组。 从 PHP 5.5.0 开始,
			 * @ 前缀已被废弃，文件可通过 CURLFile 发送。 设置 CURLOPT_SAFE_UPLOAD 为 TRUE 可禁用 @ 前缀发送文件，以增加安全性。
			 */
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			
			/**
			 * curl_exec — 执行 cURL 会话
			 * 执行给定的 cURL 会话。
			 * 这个函数应该在初始化一个 cURL 会话并且全部的选项都被设置后被调用。
			 * @return boolean
			 */
			$output = curl_exec($ch);
			
			//关闭curl释放资源
			curl_close($ch);
			
			return $output;
		}
		
		
		
	}