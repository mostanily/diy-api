<?php
/**
 * Created by PhpStorm.
 * User: K0241222
 * Date: 2020/7/26
 * Time: 11:15
 */

namespace Library;

use Library\Tools\File;

/**
 * 公共Config类
 * Class Config
 * @package Library
 */
class Config
{
    protected $config_array = [];

    /**
     * @var Config
     */
    protected static $instance;

    /**
     * @return Config
     */
    public static function getInstance()
    {
        if (!isset( static::$instance ))
        {
            static::$instance = new static();
        }
        return static::$instance;
    }

    /**
     * @param string $key
     * @param null   $default
     * @return array|mixed|null
     */
    public function get( string $key , $default = null )
    {
        return array_get( $this->config_array , $key , $default );
    }

    /**
     * @param array $key
     */
    public function set( $key )
    {
        if (is_array( $key ))
        {
            foreach ( $key as $innerKey => $innerValue )
            {
                array_set( $this->config_array , $innerKey , $innerValue );
            }
        }
    }

    /**
     * 加载所有配置信息
     * @param string $configDir
     */
    public static function loadConf( string $configDir ): void
    {
        $scanRes = File::scanDirectory( $configDir );
        if (array_key_exists( 'files' , $scanRes ))
        {
            $files = $scanRes['files'];
            foreach ( $files as $file )
            {
                require_once $file;
            }
        }
    }
}