<?php
/**
 * Class UrlService
 */

namespace backend\services;


use yii\helpers\Url;

/**
 * Class UrlService
 * @package backend\services
 * 统一管理链接 并规范书写
 */
class UrlService{
	
	/**
	 * @param       $uri
	 * @param array $params
	 * @return string
	 * 返回一个 内部链接
	 */
	public static function buildUrl( $uri,$params = [] ){
		return Url::toRoute( array_merge( [ $uri ] ,$params) );
	}

	/**
	 * @return string
	 * 返回一个空链接
	 */
	public static function buildNullUrl(){
		return "javascript:void(0);";
	}
}