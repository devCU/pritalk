<?php
/**
 * @brief		Revisions Model
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

namespace IPS\dcudash\Records;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * @brief Records Model
 */
class _Revisions extends \IPS\Patterns\ActiveRecord
{
	/**
	 * @brief	Multiton Store
	 */
	protected static $multitons = array();
	
	/**
	 * @brief	[ActiveRecord] Database Table
	 */
	public static $databaseTable = 'dcudash_database_revisions';
	
	/**
	 * @brief	[ActiveRecord] ID Database Column
	 */
	public static $databaseColumnId = 'id';
	
	/**
	 * @brief	Database Prefix
	 */
	public static $databasePrefix = 'revision_';

	/**
	 * @brief	Unpacked data
	 */
	protected $_dataJson = NULL;
	
	/**
	 * Constructor - Create a blank object with default values
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
		if ( $this->_new )
		{
			$this->member_id = \IPS\Member::loggedIn()->member_id;
			$this->date      = time();
		}
	}
	
	/**
	 * Get a value by key
	 * 
	 * @param   string $key	Key of value to return
	 * @return	mixed
	 */
	public function get( $key )
	{
		if ( $this->_dataJson === NULL )
		{
			$this->_dataJson = $this->data;
		}
		
		if ( isset( $this->_dataJson[ $key ] ) )
		{
			return $this->_dataJson[ $key ];
		}
		
		return NULL;
	}

	/**
	 *  Compute differences
	 *
	 * @param   int                 $databaseId     Database ID
	 * @param   \IPS\dcudash\Records    $record         Record
	 * @param   boolean             $justChanged    Get changed only
	 * @return array
	 */
	public function getDiffHtmlTables( $databaseId, $record, $justChanged=FALSE )
	{
		$fieldsClass  = 'IPS\dcudash\Fields' .  $databaseId;
		$customFields = $fieldsClass::data( 'view' );
		$conflicts    = array();

		/* Build up our data set */
		foreach( $customFields as $id => $field )
		{
			$key = 'field_' . $field->id;

			if( $justChanged === FALSE OR !\IPS\Login::compareHashes( md5( $record->$key ), md5( $this->get( $key ) ) ) )
			{
				$conflicts[] = array( 'original' => $this->get( $key ), 'current' => $record->$key, 'field' => $field );
			}
		}

		return $conflicts;
	}

	/**
	 * Set the "data" field
	 *
	 * @param string|array $value
	 * @return void
	 */
	public function set_data( $value )
	{
		$this->_data['data'] = ( is_array( $value ) ? json_encode( $value ) : $value );
	}
	
	/**
	 * Get the "data" field
	 *
	 * @return array
	 */
	public function get_data()
	{
		return json_decode( $this->_data['data'], TRUE );
	}
	
	
}