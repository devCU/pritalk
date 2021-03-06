<?php
/**
 * @brief		Front Navigation Extension: DCUdash
 * @package		DCU Dashboard
 * @author		Gary Cornell for devCU Software Open Source Projects
 * @copyright		(c) 2018 devCU Software
 * @contact		gary@devcu.com
 * @site		https://www.devcu.com
 * @Source		https://github.com/devCU/DCU-Dashboard 
 * @subpackage		Dashboard Content
 * @base		IPS 4 CMS
 * @since		13 JAN 2019
 * @version		1.0.0
 */

/* This file has been removed in 4.1 but we do not want the 4.0 extension to load */
namespace IPS\dcudash\extensions\core\FrontNavigation;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Front Navigation Extension: Dashes
 */
class _Dcudash
{
	/**
	 * @deprecated
	 *
	 * @return	bool
	 */
	final public function deprecated()
	{
		return TRUE;
	}
}